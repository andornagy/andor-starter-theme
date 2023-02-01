<?php get_header();
/*
* Template name: Cases
*/

$clerks = getQuery('case');

?>

<?php get_template_part('parts/banners/banner'); ?>

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
               if ($clerks->have_posts()) {
                  while ($clerks->have_posts()) {
                     $clerks->the_post();
                     $args = array(
                        'excerpt' => true,
                        'columns' => 4,
                     );
                     get_template_part('parts/loop/loop', get_post_type(), $args);
                  }
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