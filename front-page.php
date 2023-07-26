<?php get_header(); ?>
<main class="section">

   <?php get_template_part('parts/layout/slides') ?>
   <?php get_template_part('parts/home/home', 'intro') ?>
   <?php get_template_part('parts/home/home', 'slides-post') ?>
   <?php get_template_part('parts/home/home', 'featured-news') ?>
   <?php get_template_part('parts/home/home', 'upcoming-events') ?>

</main>
<?php get_footer(); ?>