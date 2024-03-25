<?php


// Redirect Registration Page
add_filter( 'init', 'my_registration_page_redirect' );
function my_registration_page_redirect() {
    global $pagenow;
    if ( strtolower($pagenow) == 'wp-login.php') {
    	//var_dump($_POST);
    }
    if ( ( strtolower($pagenow) == 'wp-login.php') && ( strtolower( $_GET['action']) == 'resetpass' ) ) {

    	$user = get_user_by('login', $_POST['custom_login']);
    	//var_dump($user->data->ID);
    	nocache_headers();
		wp_clear_auth_cookie();

		wp_set_current_user ( $user->data->ID );
		wp_set_auth_cookie( $user->data->ID );
        //wp_redirect( home_url('/registration-complete/?patient='.$_POST['user_login']));
        //wp_redirect( home_url('/registration-complete/'));
	    $redirect_to = home_url('/registration-complete/');
	    wp_safe_redirect( $redirect_to );
	    exit();
    }
}


add_action( 'login_enqueue_scripts', 'enqueue_my_login_script' );
function enqueue_my_login_script( $page ) {

       	wp_enqueue_script(
    	    'custom_loigin_js',
    	    CORE_URL . '/js/custom_loigin.js',
            array('jquery'), 
            '1', // no ver
            true  
    	);

}
