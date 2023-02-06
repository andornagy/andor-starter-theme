<?php
/*
* Template name: Landing page
*/
get_header();

get_template_part('parts/titles/title');
?>

<main class="section grid-container-narrow main">
   <div class="grid-x grid-padding-x grid-padding-y">
      <div class="cell">

         <h1><?php the_title(); ?></h1>

         <?php get_template_part('parts/layout/breadcrumbs'); ?>

         <?php the_content(); ?>



      </div>
   </div>

   <?php get_template_part('parts/layout/featured-boxes'); ?>
</main>

<?php get_footer(); ?>