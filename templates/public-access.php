<?php
/*
* Template name: Public Access
*/

$barristers = new WP_Query(array(
   'post_type' => 'barrister',
   'posts_per_page' => '-1',
   'orderby' => 'menu_order',
   'order' => 'ASC',
   'tax_query' => array(
      array(
         'taxonomy' => 'barrister_category',
         'field' => 'slug',
         'terms' => 'public-access'
      )
   )
));

?>

<?php get_header(); ?>

<?php get_template_part('parts/titles/title'); ?>

<main class="section">
   <div class="grid-container">
      <?php get_template_part('parts/layout/breadcrumbs'); ?>
      <section class="grid-x grid-padding-x grid-padding-y main">

         <div class="cell">
            <?php the_content() ?>
         </div>
         <h3> Our Public Access barristers. </h3>
         <div class="cell">
            <div id="response" class="grid-x grid-padding-x grid-margin-y">
               <?php

               if ($barristers->have_posts()) {
                  while ($barristers->have_posts()) {
                     $barristers->the_post();

                     get_template_part('parts/loop/loop', 'barrister');
                  }
               }

               wp_reset_postdata();

               ?>
            </div>
         </div>
      </section>
   </div>
</main>


<?php get_footer(); ?>