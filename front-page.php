<?php get_header(); ?>



<main class="section grid-container">
    <div class="grid-x grid-margin-x grid-padding-y">
        <div class="cell content">
            <?php the_content(); ?>
        </div>
    </div>
</main>

<?php get_template_part('parts/layout/slider'); ?>

<?php get_template_part('parts/layout/featured-boxes'); ?>


<?php get_footer(); ?>