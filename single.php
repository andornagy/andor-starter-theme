<?php

$id = get_the_ID();

get_header(); ?>

<?php get_template_part('parts/title/title'); ?>

<main class="section grid-container">


   <?php get_template_part('parts/layout/breadcrumbs'); ?>

   <section class="grid-x grid-padding-x grid-padding-y main">

      <div class="cell small-12 medium-2 large-3">
         <?php get_sidebar('left'); ?>
      </div>

      <div class="cell small-12 medium-8 large-6 content">

         <?php the_post_thumbnail('landscape'); ?>

         <div class="cell meta">
            <span class="date"><?php echo get_the_time(get_option('date_format'), $id); ?></span>
         </div>

         <?php the_content(); ?>

         <?php get_template_part('parts/layout/share'); ?>
         
         <?php get_template_part('parts/layout/cta'); ?>

      </div>

      <div class="cell small-12 medium-2 large-3">
         <?php get_sidebar('right'); ?>
      </div>

   </section>

</main>

<?php get_footer(); ?>