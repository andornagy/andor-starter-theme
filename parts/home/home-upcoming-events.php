<?php
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

?>

<section class="section home-upcoming_events padding-vertical-3">
   <div class="grid-container">
      <h2 class="separator-left">Upcoming events</h2>
      <div class="grid-x grid-margin-x grid-padding-y">
         <?php
         if ($future_events->have_posts()) {
            while ($future_events->have_posts()) {
               $future_events->the_post();
               $args = array(
                  'excerpt' => true,
                  'columns' => 4,
               );
               get_template_part('parts/loop/loop', get_post_type(), $args);
            }
         } else {
            echo '<div class="cell"><h2>' . __('No upcoming events found.', 'squareeye') . '</h2></div>';
         }
         wp_reset_postdata();

         ?>
      </div>
   </div>
</section>