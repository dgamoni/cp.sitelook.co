<?php
function custom_child_scripts() {

	wp_enqueue_style(
		'custom-style', 
		CORE_URL . '/css/custom-style.css'
	);

	wp_enqueue_script(
	    'custom_script',
	    CORE_URL . '/js/custom.js',
        array('jquery'), 
        '1', // no ver
        true  
	);

	wp_localize_script( 'custom_script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
}
add_action( 'wp_enqueue_scripts', 'custom_child_scripts' ); 

function custom_child_scripts_admin() {

	wp_enqueue_script(
	    'custom_admin_script',
	    CORE_URL . '/js/custom_admin.js',
        array('jquery'), 
        '1', 
        true 
	);
}
//add_action( 'admin_enqueue_scripts', 'custom_child_scripts_admin' ); 