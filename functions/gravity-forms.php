<?php
	
	/* Set default "From Email" for Gravity Forms notifications, if client forgets.
		Credit: Tim Priebe in The Admin Bar */
		

function override_gravityforms_from_email( $email, $notification ) {
    // Get the WordPress site URL and extract the domain.
    $site_url = get_site_url();
    $parsed_url = parse_url( $site_url );
    $domain = isset( $parsed_url['host'] ) ? $parsed_url['host'] : '';
    if ( isset( $email['from'] ) && $email['from'] === '{admin_email}' ) {
        $email['from'] = 'website@' . $domain;
    }
    return $email;
}
add_filter( 'gform_notification', 'override_gravityforms_from_email', 10, 2 );