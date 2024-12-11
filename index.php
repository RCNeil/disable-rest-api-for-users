<?php
/*
Plugin Name: Disable REST API for Users
Plugin URI: https://squatch.us
Description: This plugin disables REST API endpoints for non-admin users.
Author: Squatch Creative
Version: 1.001
Author URI: https://squatch.us
*/

function disable_rest_api_error_messaging( $access ) { 
	return new WP_Error( 'rest_disabled', __('Not authorized.'), array( 'status' => rest_authorization_required_code())); 
}

function disable_rest_api_for_users() {
    if ( ! current_user_can( 'manage_options' ) ) {
        // Disable REST API for users
        add_filter( 'rest_authentication_errors', 'disable_rest_api_error_messaging' ); 
    }
}
add_action( 'rest_api_init', 'disable_rest_api_for_users' );

?>