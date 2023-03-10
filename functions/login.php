<?php
/*-------------------------------*/
/* CUSTOMIZE LOGIN SCREEN */
/*-------------------------------*/

function loginHeaderUrl()
{
    return esc_url(site_url('/'));
}

add_filter('login_headerurl', 'loginHeaderUrl');

function loginEnqueueScripts()
{
    wp_enqueue_style('login-css', get_theme_file_uri('/assets/css/login.css'));
}

add_action('login_enqueue_scripts', 'loginEnqueueScripts');


add_action('login_headertext', function () {
    return get_bloginfo('name');
});
