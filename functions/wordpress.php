<?php
	
function enable_svg_upload( $upload_mimes ) {
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}
add_filter( 'upload_mimes', 'enable_svg_upload', 10, 1 );



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