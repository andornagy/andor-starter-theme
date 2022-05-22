<?php
/*
* ENQUEUE JS AND CSS
*/
add_action('wp_enqueue_scripts', 'sqe_enqueue_scripts');

function sqe_enqueue_scripts()
{
    wp_enqueue_style('theme-fonts', get_theme_file_uri('/assets/theme-fonts.css'), array(), filemtime(get_theme_file_path('/assets/theme-fonts.css')), 'all');

    wp_enqueue_style('theme-css', get_theme_file_uri('/dist/main.css'), array(), filemtime(get_theme_file_path('/dist/main.css')), 'all');

    wp_enqueue_style('sqe-custom-css', get_theme_file_uri('/assets/sqe-custom.css'), array(), filemtime(get_theme_file_path('/assets/sqe-custom.css')), 'all');

    wp_enqueue_style('print-css', get_theme_file_uri('/assets/print.css'), array(), filemtime(get_theme_file_path('/assets/print.css')), 'print');

    wp_register_script('theme-js', get_theme_file_uri('/dist/bundle.js'), array('jquery'), filemtime(get_theme_file_path('/dist/bundle.js')), true);

    wp_localize_script('theme-js', 'themeData', array(
        'root_url' => get_site_url(),
        'rest_nonce' => wp_create_nonce('wp_rest'),
        'ajax_nonce' => wp_create_nonce('ajax-nonce')
    ));

    wp_enqueue_script('theme-js');
}

/*
* PRELOAD CUSTOM FONTS FOR BETTER CLS
*/
function sqe_preload_fonts()
{
    // echo '<link rel="preload" as="font" href="' . get_theme_file_uri('/assets/fonts/FuturaPT-Book.woff') . '" type="font/woff2" crossorigin="anonymous">
    // <link rel="preload" as="font" href="' . get_theme_file_uri('/assets/fonts/FuturaPT-Book.woff2') . '" type="font/woff2" crossorigin="anonymous">';

}
add_action('wp_head', 'sqe_preload_fonts', 1);
