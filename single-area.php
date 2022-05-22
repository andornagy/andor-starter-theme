<?php
get_header();

get_template_part('parts/banners/banner', 'area');
?>
<main class="section">
    <div class="grid-container">
        <div class="grid-x grid-margin-x grid-margin-y">
            <div class="cell">
                <?php get_template_part('parts/page/breadcrumbs'); ?>
            </div>
            <div class="cell">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>