<?php get_header();
/*
* Template name: Cases
*/

$cases = getQuery('case');

?>

<?php get_template_part('parts/titles/title'); ?>

<main class="section grid-container">

   <?php get_template_part('parts/layout/breadcrumbs'); ?>

   <section class="grid-x grid-padding-x grid-padding-y main">
      <div class="cell small-12">
         <?php ajaxFilters('case'); ?>
      </div>

      <div class="cell small-12 content">

         <div class="cell">
            <div id="response" class="grid-x grid-padding-x grid-padding-y">
               <?php
               if ($cases->have_posts()) {
                  while ($cases->have_posts()) {
                     $cases->the_post();
                     $args = array(
                        'excerpt' => true,
                        'columns' => 4,
                     );
                     get_template_part('parts/loop/loop', get_post_type(), $args);
                  }
                  wp_reset_query();
               } else {
                  echo '<div class="cell"><h2>' . __('No posts found.', 'squareeye') . '</h2></div>';
               }
               echo ajaxPagination('case');
               ?>

            </div>
         </div>

      </div>

   </section>

</main>

<?php get_footer(); ?>