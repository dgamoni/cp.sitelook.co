<?php 

// ga_provider_appointments_custom.php

// add_action( 'wp_ajax_appointment_update_note', 'appointment_update_note' );
// add_action( 'wp_ajax_nopriv_appointment_update_note', 'appointment_update_note' );

// function appointment_update_note() {

// 	if ( $_POST['note_id'] && $_POST['note_text']) {
// 		$note_id = intval( $_POST['note_id'] );
// 		$note_text = $_POST['note_text'];
		
// 		update_field( 'sitelook_appointment_note', $note_text, $note_id);
// 		$res['note'] = $note_text;
// 		echo json_encode( $res );
// 		exit;
// 	} else if ( $_POST['note_id'] && !$_POST['note_text']) {
// 		update_field( 'sitelook_appointment_note', '', $note_id);
// 		$res['note'] = '';
// 		echo json_encode( $res );
// 		exit;		
// 	}
// } 


add_action( 'wp_ajax_save_patinet_data', 'save_patinet_data' );
add_action( 'wp_ajax_nopriv_save_patinet_data', 'save_patinet_data' );
function save_patinet_data() {
		
	$user_id = $_POST['user_id'];

	if (!$_POST['address'] ||  !$_POST['state'] || !$_POST['phone'] || !$_POST['user_id']) {
		wp_send_json_error();
	}

	if ($_POST['address'] && $_POST['user_id']) {
		update_field('sitelook_user_address', $_POST['address'], 'user_'.$_POST['user_id']);
	}
	if ($_POST['state'] && $_POST['user_id']) {
		update_field('sitelook_user_state', $_POST['state'], 'user_'.$_POST['user_id']);
	}
	if ($_POST['phone'] && $_POST['user_id']) {
		update_user_meta( $_POST['user_id'], 'phone', $_POST['phone'] );
	}

		$res['address'] = $_POST['address'];
		$res['state'] = $_POST['state'];
		$res['phone'] = $_POST['phone'];
		$res['user_id'] = $_POST['user_id'];

		wp_send_json_success($res);
		//echo json_encode( $res );
		exit;

}

// add_action( 'admin_post_nopriv_save_user_data_form', 'save_patinet_data_form' );
// add_action( 'admin_post_save_user_data_form', 'save_patinet_data_form' );
// function save_patinet_data_form() {

// }