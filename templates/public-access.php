<?php
/*
* Template name: Public Access
*/

$barristers = getQuery('barrister', 'public-access');

?>

<?php get_header(); ?>

<?php get_template_part('parts/banners/banner'); ?>

<main class="section">
   <div class="grid-container">

      <?php get_template_part('parts/page/breadcrumbs'); ?>

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