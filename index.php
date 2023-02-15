<?php get_header();

$posts = getQuery('post', '', 12);

?>

<?php get_template_part('parts/banners/banner'); ?>

<main class="section grid-container">

   <?php get_template_part('parts/layout/breadcrumbs'); ?>

   <section class="grid-x grid-padding-x grid-padding-y main">
      <div class="cell small-12">
         <?php ajaxFilters('post'); ?>
      </div>

      <div class="cell small-12 content">

         <div class="cell">
            <div id="response" class="grid-x grid-padding-x grid-padding-y">
               <?php
               if ($posts->have_posts()) {
                  while ($posts->have_posts()) {
                     $posts->the_post();
                     $args = array(
                        'excerpt' => true,
                        'columns' => 3,
                     );
                     get_template_part('parts/loop/loop', get_post_type(), $args);
                  }
               } else {
                  echo '<div class="cell"><h2>' . __('No posts found.', 'squareeye') . '</h2></div>';
               }
               wp_reset_postdata();
               echo ajaxPagination('post');
               ?>

            </div>
         </div>

      </div>

   </section>

</main>

<?php get_footer(); ?>