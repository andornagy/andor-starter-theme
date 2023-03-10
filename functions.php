<?php

define('WEBSITE_NAME', 'Theme Settings');
define('WEBSITE_SLUG', 'theme-name');

require_once(get_theme_file_path('/functions/_init.php'));
require_once(get_theme_file_path('/functions/foundation.php'));
require_once(get_theme_file_path('/functions/enqueue-scripts.php'));
require_once(get_theme_file_path('/functions/helpers.php'));

require_once(get_theme_file_path('/functions/acf.php'));
require_once(get_theme_file_path('/functions/login.php'));

require_once(get_theme_file_path('/functions/query.php'));
require_once(get_theme_file_path('/functions/shortcodes.php'));
require_once(get_theme_file_path('/functions/navigation.php'));
require_once(get_theme_file_path('/functions/ajax.php'));
require_once(get_theme_file_path('/functions/images.php'));
// require_once(get_theme_file_path('/functions/icons.php'));

require_once(get_theme_file_path('/functions/wordpress.php'));



/* Custom templates for certain post categories  ________________________________________________________ */

add_filter( 'single_template', function ( $single_template ) {

    // $parent     = '21'; //Change to your category ID
    // $categories = get_categories( 'child_of=' . $parent );
    // $cat_names  = wp_list_pluck( $categories, 'name' );

    // if ( has_category( 'movies' ) || has_category( $cat_names ) ) {
	 if ( has_category( 'publications' )) {  
        $single_template = dirname( __FILE__ ) . '/single-post-publication.php';
    }
    return $single_template;
     
}, PHP_INT_MAX, 2 );
