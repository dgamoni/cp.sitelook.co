<?php

add_filter("login_redirect", "admin_login_redirect", 10, 3);
function admin_login_redirect( $redirect_to, $request, $user ) {
	global $user;
	if( isset( $user->roles ) && is_array( $user->roles ) ) {
		if( in_array( "um_therapist", $user->roles ) ) {
			return home_url('/therapist-home/');
		} else if( in_array( "um_patient", $user->roles ) ) {
			return home_url('/patient-home/');
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}


add_action('login_head', 'my_login_head'); 
function my_login_head() {
	remove_action('login_head', 'wp_shake_js', 12);
}
