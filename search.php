<?php
get_header();

get_template_part('parts/banners/banner');
?>
<main class="section grid-container">
    <div class="grid-x grid-margin-x grid-margin-y">
        <div class="cell">
            <?php get_search_form(); ?>
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    get_template_part('parts/search-loop/search', $type);
                }
            } else {
                echo '<h2>' . __('No results match that search.', 'squareeue') . '</h2>';
            }
            ?>
        </div>
    </div>
</main>
<?php
get_footer();
?>