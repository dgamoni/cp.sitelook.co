<?php 

add_shortcode( 'messages', 'therapist_messages_func' );
function therapist_messages_func( $atts ){

	$out = '';

	$has_notifications = UM()->Notifications_API()->api()->get_notifications( 1 );
	if ( !$has_notifications ) {
		$template = 'no-notifications';
	} else {
		$notifications = UM()->Notifications_API()->api()->get_notifications( 50 );
		$template = 'notifications';
	}

	ob_start();

	//var_dump($notifications);
	//[ultimatemember_messages]


	$conversation_id_array = array();

	$out .= '<div class="appointments-table">';
		
		foreach ($notifications as $key => $notification) {

				$querystring = parse_url($notification->url);
				parse_str(html_entity_decode($querystring['query']), $queryarray);
				//var_dump( $queryarray['conversation_id'] );
				$conversation_id = $queryarray['conversation_id'];
				array_push($conversation_id_array, $conversation_id);
				$user_id = $notification->user;
				//var_dump( unread_conversation_custom($conversation_id, $user_id) );
				$conversation = unread_conversation_custom($conversation_id, $user_id);
				$user_author = get_user_by( 'id', $conversation );
				//var_dump($user_author->data->display_name);

				$out .= '<div class="client_list_wrap">';
						$out .= '<div class=" client_list">';
								$out .= '<span class="client_data">'. date("d/m/Y", strtotime($notification->time)) .'</span>';
								$out .= '<span class="client_time">'.date("g:ia", strtotime($notification->time)).'</span>';
								$out .= '<span class="client_name"><a href="javascript:void(0);" class="um-message-btn read_message" data-id="'.$conversation.'" data-message_to="'.$conversation.'" data-conversation_id="'.$conversation_id.'">'.$user_author->data->display_name.'</a></span>';
								if($notification->status == 'unread'){
									$out .= '<span class="unread">Unread Message</span>';
								} else {
									$out .= '<span class="close"><a href="#"><i class="um-icon-android-close"></i></a></span>';
								}
								//$out .= '<a class="client_note btn btn-primary button_message"  href="'.home_url() .'/therapist-home/patient-details/new-note/?patient_id='. $client_id.'" ><span>Add Note</span></a>';
						$out .= '</div>';
				$out .= '</div>';
		}


	//var_dump($conversation_id_array);
	$conversations = UM()->Messaging_API()->api()->get_conversations( get_current_user_id() );
	//var_dump($conversations);

	foreach ($conversations as $key => $conversation) {
			//var_dump($conversation->conversation_id);
			//$id = $conversation->conversation_id;
			if( !in_array($conversation->conversation_id, $conversation_id_array) ) {
				$user_author = get_user_by( 'id', $conversation->user_a );
				$out .= '<div class="client_list_wrap">';
						$out .= '<div class=" client_list">';
								$out .= '<span class="client_data">'. date("d/m/Y", strtotime($conversation->last_updated)) .'</span>';
								$out .= '<span class="client_time">'.date("g:ia", strtotime($conversation->last_updated)).'</span>';
								$out .= '<span class="client_name"><a href="javascript:void(0);" class="um-message-btn read_message" data-id="'.$conversation->user_a.'" data-message_to="'.$conversation->user_a.'" data-conversation_id="'.$conversation->conversation_id.'">'.$user_author->data->display_name.'</a></span>';
								$out .= '<span class="close"><a href="#"><i class="um-icon-android-close"></i></a></span>';
						$out .= '</div>';
				$out .= '</div>';
			}
	}

	$out .= '</div>';

	$out .= ob_get_contents();
	ob_end_clean();

	return $out;
}


function unread_conversation_custom( $conversation_id, $user_id ) {
	global $wpdb;

	$count = $wpdb->get_var( $wpdb->prepare(
		"SELECT author
		FROM {$wpdb->prefix}um_messages
		WHERE conversation_id = %d AND 
			  recipient = %d 
		",
		$conversation_id,
		$user_id
	) );


	return $count;
}	 