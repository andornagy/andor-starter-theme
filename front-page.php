<?php get_header(); ?>
<main class="section grid-container">

   <?php get_template_part('parts/layout/slides') ?>
   <?php // get_template_part('parts/home/home', 'intro') 
   ?>
   <?php get_template_part('parts/home/home', 'featured-news') ?>
   <?php get_template_part('parts/home/home', 'upcoming-events') ?>

</main>
<?php get_footer(); ?>