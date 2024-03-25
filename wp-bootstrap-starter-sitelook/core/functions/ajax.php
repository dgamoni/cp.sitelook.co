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

add_action( 'wp_ajax_ga_calendar_time_slots_custom', 'ga_calendar_time_slots_custom' );
add_action( 'wp_ajax_nopriv_ga_calendar_time_slots_custom', 'ga_calendar_time_slots_custom' );
function ga_calendar_time_slots_custom() {
	// Timezone
	$timezone = ga_time_zone();
	
	// Service & Provider ID
	$current_date = isset( $_POST['current_month'] ) ? esc_html($_POST['current_month']) : '';
	$service_id   = isset( $_POST['service_id'] )    ? (int) $_POST['service_id']        : 0;
	$provider_id  = isset( $_POST['provider_id'] ) && 'ga_providers' == get_post_type($_POST['provider_id']) ? (int) $_POST['provider_id'] : 0;
	$form_id = isset( $_POST['form_id'] ) ? (int) $_POST['form_id'] : 0;		
	
	// if( 'ga_services' == get_post_type($service_id) && ga_valid_date_format( $current_date ) ) {
	// 	# ok
	// } else {
	// 	wp_die('Something went wrong.');
	// }
	
	// Date Caption
	$date = new DateTime( $current_date, new DateTimeZone( $timezone ) );
	
	// Generate Slots
	$ga_calendar = new GA_Calendar_custom( $form_id, $date->format('n'), $date->format('Y'), $service_id, $provider_id );
	//echo $ga_calendar->calendar_time_slots($date);

		$res['current_month'] = $_POST['current_month'];
		$res['service_id'] =$_POST['service_id'];
		$res['provider_id'] = $_POST['provider_id'];
		$res['form_id'] = $_POST['form_id'];
		$res['date'] = $date;
		$res['timezone'] = $timezone;
		$res['ga_calendar'] = $ga_calendar->calendar_time_slots($date);
		$res['time_array'] = explode(";", $ga_calendar->calendar_time_slots($date));

		wp_send_json_success($res);

	wp_die();
}

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