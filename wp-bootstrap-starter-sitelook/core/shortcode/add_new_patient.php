<?php


function my_acf_user_form_func( $atts ) {
 
		  $a = shortcode_atts( array(
		    'field_group' => ''
		  ), $atts );
 

		$html  = '<input type="hidden" name="action_form" value="register_new_pacient"/>';
		$args = array(
			'post_id' => 'new',
			'html_before_fields' => $html,
			'field_groups' => array(3932),
			//'form' => true, 
			'submit_value' => __('Add New Patient', ''),
			'return' => home_url('therapist-home/#patients'),
		);


	    ob_start();
	    
	    acf_form( $args );
	    $form = ob_get_contents();
	    
	    ob_end_clean();

    return $form;
}
 
add_shortcode( 'add_new_patient', 'my_acf_user_form_func' );

//adding AFC form head
function add_acf_form_head(){
    global $post;
    
  if ( !empty($post) && has_shortcode( $post->post_content, 'add_new_patient' ) ) {
        acf_form_head();
    }
}
add_action( 'wp_head', 'add_acf_form_head', 7 ); 

function register_accueilli($post_id) {
	
	$action  = $_POST['action_form'];

    	if ( $action == "register_new_pacient" ) {
    
        $f      = $_POST['acf'];
        $prenom = $f['field_5b893feb58538'];
        $nom    = $f['field_5b89408758539'];
        $email  = $f['field_5b8940af5853a'];
        $pseudo = sanitize_title($prenom." ".$nom);
        $form_intake  = $f['field_5b8e8959a35a9'];
        $form_privacy  = $f['field_5b8e89b3a35aa'];
        $form_info  = $f['field_5b8e89e6a35ab'];

        if ( !username_exists($pseudo) && !email_exists($email) ) {

            $random_password = wp_generate_password( $length = 8, false );
            $key_active      = wp_generate_password( $length = 20, false );

            $user_id         = wp_create_user( $pseudo, $random_password, $email );
            $user_id_role    = new WP_User($user_id);
            $user_id_role->set_role('um_patient');

            update_user_meta($user_id, 'pseudo', $pseudo );
            update_user_meta($user_id, 'key_new', $key_active );

            $test_inscription = wp_update_user( array(
                'ID'            => $user_id,
                'first_name'    => $prenom,
                'last_name'     => $nom,
                'user_login'    => $pseudo,
                'user_nicename' => $prenom . " " . $nom,
                'display_name'  => $prenom . " " . $nom
            ));

            $values_emails = array(
                'prenom'      => $prenom,
                'nom'         => $nom,
                'pseudo'      => $pseudo,
                'mdp'         => $random_password,
                'url_activer' => get_bloginfo('url')."/inscription/activer-votre-compte/?key=".$key_active
            );

            //envoyer_mail($email,232, $values_emails);
            $attachments = array();

            if ($form_intake) {
                $form_intake_attachments = CORE_PATH . '/doc/IntakeForm.docx';
                array_push($attachments, $form_intake_attachments);
                //update_user_meta($user_id, 'form_intake', 'no complete' );
            } 

            if ($form_privacy) {
                $form_privacy_attachments = CORE_PATH . '/doc/NoticeofPrivacyPractices.docx';
                array_push($attachments, $form_privacy_attachments);
                //update_user_meta($user_id, 'form_privacy', 'no complete' );
            }            

            if ($form_info) {
                $form_info_attachments = CORE_PATH . '/doc/InformedConsent.doc';
                array_push($attachments, $form_info_attachments);
                //update_user_meta($user_id, 'form_info', 'no complete' );
            }

            //$attachments = array($form_intake_attachments, $form_privacy_attachments, $form_info_attachments);
            $attachments = '';

            wp_new_user_notification_custom( $user_id, null, 'user', $attachments );

            /* ------  ADD THE DO_ACTION SAVE POST ------ */
            do_action('acf/save_post', "user_".$user_id);

        }
        
    }

}

add_filter('acf/pre_save_post' , 'register_accueilli' );
