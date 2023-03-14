<?php get_header();
/*
* Template name: Events
*/

$id = get_the_id();

$today = date('Y-m-d H:i:s');
$future_events = new WP_Query(array(
   'post_type'    => 'event',
   'meta_key'     => 'start_date',
   'meta_query'   =>
   array(
      'key'           => 'start_date',
      'compare'       => '>=',
      'value'         => $today,
      'type'          => 'DATETIME',
   )
));

$past_events = new WP_Query(array(
   'post_type'    => 'event',
   'meta_key'     => 'start_date',
   'meta_query'   =>
   array(
      'key'           => 'start_date',
      'compare'       => '<',
      'value'         => $today,
      'type'          => 'DATETIME',
   )
));
?>

<?php get_template_part('parts/title/title'); ?>

<main class="section">
   <div class="grid-container">
      <?php get_template_part('parts/layout/breadcrumbs'); ?>
      <section class="grid-x grid-padding-x grid-padding-y main">
         <div class="cell">
            <?php ajaxFilters('event'); ?>
         </div>
         <div class="cell small-12 content">
            <div class="cell small-12">
               <h2>Future events</h2>
            </div>
            <div class="cell small-12 grid-x grid-padding-x grid-padding-y">
               <?php
               if ($future_events->have_posts()) {
                  while ($future_events->have_posts()) {
                     $future_events->the_post();

                     $args = array(
                        'excerpt' => true,
                        'columns' => 3,
                     );

                     get_template_part('parts/loop/loop', 'event', $args);
                  }
                  wp_reset_postdata();
               } else {
                  echo '<div class="cell"><h4>' . __('No posts found.', 'albion') . '</h4></div>';
               }; ?>
            </div>
            <div class="cell small-12">
               <h2>Past events</h2>
            </div>
            <div class="cell small-12 grid-x grid-padding-x grid-padding-y">
               <?php
               if ($past_events->have_posts()) {
                  while ($past_events->have_posts()) {
                     $past_events->the_post();

                     $args = array(
                        'excerpt' => true,
                        'columns' => 3
                     );

                     get_template_part('parts/loop/loop', 'event', $args);
                  }
                  wp_reset_postdata();
               } else {
                  echo '<div class="cell"><h4>' . __('No posts found.', 'albion') . '</h4></div>';
               }
               echo ajaxPagination('event');
               ?>
            </div>
         </div>
      </section>
   </div>
</main>

<?php get_footer(); ?>