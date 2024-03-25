<?php 

add_shortcode( 'billing_list', 'billing_list_func' );
function billing_list_func( $atts ){ 
	$out = '';
	ob_start();
		if ( isset($_GET['patient_id']) )  {
		$id = $_GET['patient_id'];
		$out .= ga_provider_appointments_custom_func_($id);
	}
	?>


	<?php
	$out .= ob_get_contents();
	ob_end_clean();

	return $out;
} 

function ga_provider_appointments_custom_func_($id){

		if( !is_user_logged_in() ) {
			return;
		}	
		
		$user_id = ga_appointment_shortcodes::get_user_id();
		$out = '';
		$providers = ga_provider_query( $user_id );
		if( $providers->post_count == 1 ) {
			$provider_id = $providers->post->ID;

			//$out .= '<div class="avatar-circle-wrapper"><div class="avatar-circle"><span class="initials">'. ga_appointment_shortcodes::ga_provider_initials( $provider_id ) .'</span></div><div class="provider-name">'. ga_appointment_shortcodes::ga_provider_name( $provider_id ). '</div></div>';		
			//$out .= '<div id="provider-schedule">' . ga_appointment_shortcodes::ga_provider_schedule( $provider_id ) . '</div>'; // Provider Schedule Edit
		
			$appointments = ga_query_appointments_child_( 'ga_appointment_provider', $provider_id );
			if ( $appointments->have_posts() ) {
				$out .= '<div class="appointments-table">';

					while ( $appointments->have_posts() ) : $appointments->the_post();

						// Provider id & name
						$provider_id = ga_appointment_shortcodes::ga_provider_id( get_the_id() );	
						$provider_name = ga_appointment_shortcodes::ga_provider_name( $provider_id );	
						
						// Service id & name
						$service_id = ga_appointment_shortcodes::ga_service_id( get_the_id() );
						$service_name  = ga_appointment_shortcodes::ga_service_name( $service_id );

						// Client id & name
						$client_id = ga_appointment_shortcodes::ga_client_id( get_the_id() );
						
						// Client Name
						$client_name  = ga_appointment_shortcodes::ga_client_name(get_the_id(), $client_id);
						
						// Client Email
						$client_email = ga_appointment_shortcodes::ga_client_email( get_the_id(), $client_id );
						$client_email = !empty($client_email) ? '<div class="appointment-email"><i class="dashicons dashicons-email"></i> '. strtolower($client_email) .'</div>' : '';
						$client = get_user_by('id', $client_id);
						//var_dump($client->data->display_name);

						// Client Phone
						$client_phone = ga_appointment_shortcodes::ga_client_phone( get_the_id(), $client_id );	
						$client_phone = !empty($client_phone) ? '<div class="appointment-phone"><i class="dashicons dashicons-phone"></i> '. strtolower($client_phone) .'</div>' : '';	
						
						
						// Duration
						$duration = ga_appointment_shortcodes::ga_duration( get_the_id() );
						
						// Appointment title
						$appointment_title = ga_get_translated_provider_service($form = false, ucfirst($service_name), $client_name);
						
						// Gcal link
						//$cal_links =  $this->show_links() ? $this->generate_calendar_links( get_the_id(), $appointment_title ) : '';					
						
						// Date & Time
						$app_date = ga_appointment_shortcodes::ga_date( get_the_id() );
						$app_date_ = (string) get_post_meta(  get_the_id(), 'ga_appointment_date', true );
						$app_date__format = date("d/m/Y", strtotime($app_date_)); 
						$app_time = ga_appointment_shortcodes::ga_time( get_the_id() );
						

						// Date Slots Mode
						// if( $available_times_mode = (string) get_post_meta($service_id, 'ga_service_available_times_mode', true) == 'no_slots' ) {
						// 	$app_time = ga_get_translated_data('bookable_date');
						// }				
						
						// Post Status
						$post_status = get_post_status( get_the_id() );
						$app_status = array_key_exists($post_status, ga_appointment_shortcodes::ga_upcoming_statuses() ) ? $post_status : 'failed';
						$app_status_name = array_key_exists($post_status, ga_appointment_shortcodes::ga_upcoming_statuses() ) ? ga_get_translated_data('status_' . $post_status) : ga_get_translated_data('status_failed');		
									
						
						// Status Class
						//$class = $this->ga_status_class( $post_status );
						$sitelook_appointment_note = get_field('sitelook_appointment_note', get_the_id());
						if( $post_status == 'pending') {
							$pending_class = 'pending_class';
						} else {
							$pending_class = '';
						}

						if($client_id == $id):

							$out .= '<div class="client_list_wrap">';
									
									$out .= '<div class=" client_list '.$class.' '.$pending_class.'">';
											$out .= '<span class="client_data">'.$app_date__format.'</span>';
											$out .= '<span class="client_time">'.$app_time.'</span>';
											$out .= '<span class="client_name"><a href="'.home_url() .'/therapist-home/patient-details/?patient_id='. $client_id.'" >'.$client->data->display_name.'</a></span>';
											//$out .= var_dump($post_status);
											if( $post_status == 'pending') {
												$out .= '<span class="status_pending">Overdue bill</span>';
											} else {
												$out .= '<span class="status_publish">$'. get_field("sitelook_appointment_fee", "user_".$client_id) .'</span>';
											}
											//$out .= 
											//$out .= '<span class="client_servise">'. $service_name . '</span>';
											//$out .= '<a class="client_note collapse_note_'.get_the_id().'" data-toggle="collapse" href="#collapse_client_note_'. get_the_id().'" role="button" aria-expanded="false" aria-controls="collapse_client_note_'. get_the_id().'"><span>Add Note</span></a>';
											//$out .= '<a class="client_note btn btn-primary button_message"  href="'.home_url() .'/therapist-home/patient-details/new-note/?patient_id='. $client_id.'" ><span>Add Note</span></a>';
									$out .= '</div>';

										$note_class ='';
										if ( !$sitelook_appointment_note ) {
											$note_class = 'note_hide';
										} 
											//$out .= '<span class="'.$note_class.' appointment_note appointment_note_'. get_the_id().'"><i>*</i> '.$sitelook_appointment_note.'</span>';
										
										

							$out .= '</div>';			

						endif;

						//$out .= '<div class="add_note collapse" id="collapse_client_note_'. get_the_id().'">';
							//$out .= '<textarea class="update_note_text_'.get_the_id().'" name="add_note" data-id="'.get_the_id().'">'.$sitelook_appointment_note.'</textarea><a href="#" id="update_note" class="update_note btn btn-primary button_message" data-note_to="'.get_the_id().'">Submit</a>';
						//$out .= '</div>';

					endwhile;
					wp_reset_postdata();	
				$out .= '</div>';		
			}


		}


		ob_start();



		$out .= ob_get_contents();
		ob_end_clean();

		return $out;
}

function ga_query_appointments_child_($meta_key, $meta_value) {
	$appointments = new WP_QUERY(
		array(
			'post_type'         => 'ga_appointments',
			//'posts_per_page'    => $this->perPage,
			//'offset'            => $this->offset,
			'post_status'       => array('publish', 'payment', 'pending'),					
			'meta_query'        => array( 'relation' => 'AND',
				array( 'key' => $meta_key, 'value' => $meta_value ),				
				'date'   => array( 'key' => 'ga_appointment_date', 'type' => 'DATE' ),				
				'time'   => array( 'key' => 'ga_appointment_time', 'compare' => 'BETWEEN', 'type' => 'TIME'  ), // This array needs to be first to displaying the correct order
			),
			'orderby'    => array( 
				'date'   => 'ASC',
				'time'   => 'ASC',
			),
			
			
		)	
	);		
	
	return $appointments;
}