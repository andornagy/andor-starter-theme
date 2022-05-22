<?php

define('WEBSITE_NAME', 'Theme settings');
define('WEBSITE_SLUG', 'theme-name');

require_once(get_theme_file_path('/functions/cleanup.php'));
require_once(get_theme_file_path('/functions/login.php'));
require_once(get_theme_file_path('/functions/foundation.php'));
require_once(get_theme_file_path('/functions/acf.php'));
require_once(get_theme_file_path('/functions/acf-options.php'));
require_once(get_theme_file_path('/functions/enqueue-scripts.php'));
require_once(get_theme_file_path('/functions/helpers.php'));
require_once(get_theme_file_path('/functions/query.php'));
require_once(get_theme_file_path('/functions/shortcodes.php'));
require_once(get_theme_file_path('/functions/menu-walker.php'));
require_once(get_theme_file_path('/functions/ajax.php'));
require_once(get_theme_file_path('/functions/icons.php'));


/*-------------------------------*/
/* THEME FEATURES */
/*-------------------------------*/

add_action('after_setup_theme', 'sqe_theme_features');

function sqe_theme_features()
{
    add_theme_support('title-tag');
    add_theme_support('responsive-embeds');
    add_theme_support('post-thumbnails');
    add_theme_support('editor-styles');

    register_nav_menus(array(
        'main-menu' => 'Main menu',
        'top-menu' => 'Top menu',
        'footer-menu' => 'Footer menu'
    ));

    //add_image_size('banner', 1600, 900);
    //add_image_size('landscape', 600, 400, true);
    //add_image_size('avatar', 256, 256, true);
}
