<?php get_header(); ?>
<main class="section grid-container">

   <?php get_template_part('parts/layout/home', 'featured-content') ?>
   <?php get_template_part('parts/layout/home', 'intro') ?>
   <?php get_template_part('parts/layout/home', 'featured-news') ?>
   <?php get_template_part('parts/layout/home', 'upcoming-events') ?>

</main>
<?php get_footer(); ?>