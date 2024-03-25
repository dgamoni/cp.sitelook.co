<?php 

add_shortcode( 'new_message', 'therapist_new_message_func' );
function therapist_new_message_func( $atts ){

	$out = ''; 
	ob_start();
	echo '<div class="message_sent">Your message has been sent</div>';
	echo do_shortcode("[gravityform id=5 title=false description=false ajax=true]");

	$out .= ob_get_contents();
	ob_end_clean();

	return $out;
}



add_filter( 'gform_pre_render_5', 'populate_user_email_list_' );
function populate_user_email_list_( $form ){
 
 	foreach( $form['fields'] as &$field ) {
 
		// if( $field['type'] !== 'select' || strpos($field['cssClass'], 'users_patient') === false )
		// continue;
	 	if ( $field->id == 7 ) {

			// $choices = array( array( 'text' => '', 'value' => '' ) );
			// $choices[0]['text'] =  'All';
			// $choices[0]['value'] =  'All';
		 

			$args = array(
			    'role'      => 'um_patient',
			    'fields'    => 'all_with_meta'
			);

			$users = get_users( $args );

			if ( !empty( $users ) ) {
				foreach( $users as $key=> $user ){ 

					if( !empty( $user->user_email )  ) {
						
						//array_push($choices[0]['value'], $user->ID)
						//$choices[0]['value'] .= $user->ID.',';
				 
						 $choices[] = array(
						 'text' => $user->display_name,
						 'value' => $user->ID,
						 );
					 }
				 }
			 }
			 
			 $field['choices'] = $choices;
		}
	 
	}
	 
	 return $form;
}
