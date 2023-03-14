<?php
/*
* Template name: _Blank
*/
get_header();

get_template_part('parts/titles/title');
?>

<main class="section grid-container-narrow main">
   <div class="grid-x grid-padding-x grid-padding-y">
      <div class="cell">

         <h1><?php the_title(); ?></h1>

         <?php get_template_part('parts/layout/breadcrumbs'); ?>

         <?php the_post_thumbnail('medium'); ?>

         <?php the_content(); ?>

         <?php get_template_part('/parts/layout/share'); ?>

      </div>
   </div>
</main>

<?php get_footer(); ?>