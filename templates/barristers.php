<?php
/*
* Template name: Barristers
*/

get_header();

get_template_part('parts/banners/banner', 'barrister');

$barristers = getQuery('barrister');

$barristers_cats = [
    [
        'slug' => 'qcs',
        'title' => 'QCs',
    ],
    [
        'slug' => 'juniors',
        'title' => 'Junior Counsel',
    ],
    [
        'slug' => 'associate-members',
        'title' => 'Associate members'
    ],
    [
        'slug' => 'pupils',
        'title' => 'Pupils'
    ]
];
?>
<main class="section">
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell">
                <?php get_template_part('parts/page/breadcrumbs'); ?>
            </div>
            <div class="cell large-3">
                <?php
                ajaxFilters('barrister');
                ?>
            </div>
            <div class="cell large-9">
                <div id="response" class="grid-x grid-margin-x grid-margin-y">
                    <?php

                    if ($barristers->have_posts()) {
                        while ($barristers->have_posts()) {
                            $barristers->the_post();
                            foreach ($barristers_cats as $i => $cat) {
                                if (has_term($cat['slug'], 'barrister_category')) {
                                    ob_start();
                                    get_template_part('parts/loop/loop', 'barrister');
                                    $barristers_cats[$i]['output'][] = ob_get_contents();
                                    ob_end_clean();
                                }
                            }
                        }

                        wp_reset_postdata();

                        foreach ($barristers_cats as $cat) {
                            if (isset($cat['output']) && $cat['output']) {
                                echo '<div class="cell"><h3 class="margin-bottom-0"><strong>' . esc_html($cat['title']) . '</strong></h3></div>';
                                echo implode('', $cat['output']);
                            }
                        }
                    } else {
                        echo '<div class="cell"><h3>' . __('No barristers found.', 'squareeye') . '</h3></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>