<?php
/*
* Template name: Clerks
*/
get_header();

$clerks = getQuery('clerk');

get_template_part('parts/title/title');
?>
<main class="section">
   <div class="grid-container">
      <?php get_template_part('parts/layout/breadcrumbs'); ?>
      <section class="grid-x grid-padding-x grid-padding-y main">
         <div class="cell">
            <div id="response" class="grid-x grid-padding-x grid-margin-y">

               <?php
               if ($clerks->have_posts()) {
                  while ($clerks->have_posts()) {
                     $clerks->the_post();
                     $args = [
                        'columns' => 4
                     ];
                     get_template_part('parts/loop/loop', 'clerk', $args);
                  }
                  wp_reset_postdata();
               } else {
                  echo '<div class="cell"><h2>' . __('No clerks found.', 'squareeye') . '</h2></div>';
               }
               ?>
            </div>
         </div>
      </section>
   </div>
</main>
<?php
get_footer();
?>