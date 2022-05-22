<?php
get_header();

get_template_part('parts/banners/banner');
?>
<main class="section grid-container">
    <div class="grid-x grid-margin-x grid-padding-y">
        <div class="cell">
            <?php get_template_part('parts/page/breadcrumbs'); ?>
        </div>
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('parts/loop/loop', get_post_type());
            }
        } else {
            echo '<div class="cell"><h4>' . __('No posts found.', 'squareeue') . '</h4></div>';
        }
        echo paginate_links();
        ?>
    </div>
</main>
<?php
get_footer();
?>