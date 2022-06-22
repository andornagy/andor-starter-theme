<?php
/*
* Template name: Contact
*/
get_header();

get_template_part('parts/banners/banner');
?>
<main class="section grid-container">
    <div class="grid-x grid-margin-x grid-padding-y">
        <div class="cell">
            <?php get_template_part('parts/page/breadcrumbs'); ?>
        </div>
        <div class="cell">
            <?php the_content(); ?>
        </div>
    </div>
</main>
<?php
get_footer();
?>