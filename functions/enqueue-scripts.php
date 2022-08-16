<?php
/*
* ENQUEUE JS AND CSS
*/
add_action('wp_enqueue_scripts', 'sqe_enqueue_scripts');

function sqe_enqueue_scripts()
{
    wp_enqueue_style('theme-fonts', get_theme_file_uri('/assets/css/theme-fonts.css'), array(), filemtime(get_theme_file_path('/assets/css/theme-fonts.css')), 'all');

    wp_enqueue_style('theme-css', get_theme_file_uri('/dist/main.css'), array(), filemtime(get_theme_file_path('/dist/main.css')), 'all');
    
    // TODO: Replace clientcode in the line below

    wp_enqueue_style('sqe-custom-css', get_theme_file_uri('/assets/css/clientcode.css'), array(), filemtime(get_theme_file_path('/assets/css/clientcode.css')), 'all');

    wp_enqueue_style('print-css', get_theme_file_uri('/assets/css/print.css'), array(), filemtime(get_theme_file_path('/assets/css/print.css')), 'print');
    
//     wp_enqueue_style('font-awesome', get_theme_file_uri('/assets/fonts/fontawesome/css/all.css'), array(), filemtime(get_theme_file_path('/assets/fonts/fontawesome/css/all.css')), 'all');

    wp_enqueue_script('theme-js', get_theme_file_uri('/dist/bundle.js'), array('jquery'), filemtime(get_theme_file_path('/dist/bundle.js')), true);

    wp_register_script('custom-vars', '',);
    wp_enqueue_script('custom-vars');
    $data = "
    window.themeData = {
        root_url: '" . site_url('/') . "',
        ajax_url: '" . site_url() . "/wp-admin/admin-ajax.php',
        rest_nonce: '" . wp_create_nonce('wp_rest') . "',
        ajax_nonce: '" . wp_create_nonce('ajax-nonce')  . "',
    }
    ";

    wp_add_inline_script('custom-vars', $data);
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
