<?php 

add_shortcode( 'patient_reg_complete', 'patient_reg_complete_func' );
function patient_reg_complete_func( $atts ){


	ob_start();
	//echo "<pre>", var_dump(wp_get_current_user()), "</pre>";
	$user = wp_get_current_user();
	$usermeta = get_user_meta( $user->data->ID);
	//var_dump($usermeta);

	//object(WP_User)#1024 (8) { ["data"]=> object(stdClass)#991 (10) { ["ID"]=> string(2) "36" ["user_login"]=> string(13) "sava-pronin11" ["user_pass"]=> string(34) "$P$BCov7EfvjWIfANT7L1./GtHrwcn7ue." ["user_nicename"]=> string(13) "sava-pronin11" ["user_email"]=> string(17) "dgamoni@gmail.com" ["user_url"]=> string(0) "" ["user_registered"]=> string(19) "2018-09-11 08:15:40" ["user_activation_key"]=> string(45) "1536653740:$P$Bk4grNZ3oe6nDy1RT.NagAiHzinJGi1" ["user_status"]=> string(1) "0" ["display_name"]=> string(13) "Sava Pronin11" } ["ID"]=> int(36) ["caps"]=> array(1) { ["um_patient"]=> bool(true) } ["cap_key"]=> string(15) "wp_capabilities" ["roles"]=> array(1) { [0]=> string(10) "um_patient" } ["allcaps"]=> array(2) { ["read"]=> bool(true) ["um_patient"]=> bool(true) } ["filter"]=> NULL ["site_id":"WP_User":private]=> int(1) } 

	if ( is_user_logged_in() && $user->roles[0] == 'um_patient') :
		//echo do_shortcode('[vc_row][vc_column]');
		//echo do_shortcode('[vc_wp_text title="Welcome '. $user->data->display_name .'! Please complete the following to fully setup your patient account." el_id="new_patient_block" el_class="notifications_style"]');

	?>
	<div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12">
		<div class="vc_column-inner ">
			<div class="wpb_wrapper">
				<div id="new_patient_block" class="vc_wp_text wpb_content_element notifications_style">
					<div class="widget widget_text">
						<h2 class="widgettitle">Welcome <?php echo $user->data->display_name; ?>! Please complete the following to fully setup your patient account.</h2>			
							<div class="textwidget">		

								<form id="update_user_data" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
								    <div class="acf-field acf-field-text"  data-width="50">
										<div class="acf-label">
											<label for="">Billing Address <span class="acf-required">*</span></label>
										</div>
										<div class="acf-input">
											<div class="acf-input-wrap">
												<input type="text" id="sitelook_user_address" name="sitelook_user_address" required="required" >
											</div>
										</div>
									</div>

									<div class="acf-field acf-field-text"  data-width="50">
										<div class="acf-label">
											<label for="">City, State, etc <span class="acf-required">*</span></label>
										</div>
										<div class="acf-input">
											<div class="acf-input-wrap">
												<input type="text" id="sitelook_user_state" name="sitelook_user_state" required="required" >
											</div>
										</div>
									</div>

									<div class="acf-field acf-field-text" data-width="100">
										<div class="acf-label">
											<label for="">Phone Number <span class="acf-required">*</span></label>
										</div>
										<div class="acf-input">
											<div class="acf-input-wrap">
												<input type="text" id="user_meta_phone" name="user_meta_phone" required="required" >
											</div>
										</div>
									</div>

									<p>Forms to complete and sign</p>
								    
								    <?php //var_dump( check_form_status($user->data->ID, 2) ); ?>

								    <?php echo generate_patient_status_form($usermeta,'sitelook_intake_form_front', check_form_status($user->data->ID, 2) ); ?>
								    <?php echo generate_patient_status_form($usermeta,'sitelook_privacy_form_front' ); ?>
								    <?php echo generate_patient_status_form($usermeta,'sitelook_informed_consent_form_front', check_form_status($user->data->ID, 3) ); ?>

								    
							    	

								    <p>
								    	<input type="hidden" name="action" value="save_user_data_form">
								    	<input type="hidden" id="user_id" name="user_id" value="<?php echo $user->data->ID; ?>">
								    	<input type="submit" id="save_user_data" class="button button-primary button-large" name="save_user_data" value="Save & Continue" />
										<span id="message" style="display:none;"></span>
									</p>
								</form>
							</div>
					</div> 
				</div> 
			</div>
		</div>
	</div>
	<?php endif;    
	$html = ob_get_contents();
	ob_end_clean();

    return $html;

} 

function check_form_status($user_id, $form_id) {
 	//echo "<pre>", var_dump(GFAPI::get_entries( $form_id, $search_criteria = array(), $sorting = null, $paging = null, $total_count = null )), "</pre>"; 

 	$entries = GFAPI::get_entries( $form_id, $search_criteria = array(), $sorting = null, $paging = null, $total_count = null );
 	foreach ($entries as $key => $entrie) {
 		if($entrie['created_by'] == $user_id && $entrie['status'] == 'active') {
 			return true;
 		} else {
 			return false;
 		}
 	}
}

function generate_patient_status_form($usermeta, $field = '', $status = false) {
	ob_start();

    if ( $field == 'sitelook_intake_form_front') {
    	$label = 'Intake form';
    	$link = '/notice-of-privacy-practices/';
    } else if ( $field == 'sitelook_privacy_form_front') {
    	$label = 'Patient Privacy';
    	$link = '/notice-of-patient-privace/';
    } else if ( $field == 'sitelook_informed_consent_form_front') {
    	$label = 'Informed Consent';
    	$link = '/informed-consent/';
    }

    if ($usermeta[$field][0] == 0 && !$status) { 
    	$class_form = 'not_required';
    	$link_pdf_begin = '';
    	$link_pdf_end = '';
    	$fvalue = '';
    } else if ($usermeta[$field][0] == 1  && !$status) { 
    	$class_form = 'not_complete';
    	$link_pdf_begin = '<a href="'.home_url( $link ).'" target="_blank">';
    	$link_pdf_end = '</a>';
    	$fvalue = 'Click to complete';
    	$znak = '<span class="znak">!</span>';
    } else if ( $status) { 
    	$class_form = 'completed';
    	$link_pdf_begin = '';
    	$link_pdf_end = '';
    	$fvalue = 'Completed';
    	$znak = '<span class="znak"><i class="fa fa-check" aria-hidden="true"></i></span>';
    } ?>
	    <?php //echo $link_pdf_begin; ?>
		    <div class="acf-field acf-field-text patientform <?php echo $class_form; ?>" data-width="20">
		     	<label>
		     		<?php echo $link_pdf_begin; ?>
				     	<span></span><?php echo $label; ?></span>
				     	<input type="text"  class="applay_<?php echo $field; ?>"  placeholder="" name="sitelook_intake_form_front" value="<?php echo $fvalue; ?>" readonly />
			     		<?php echo $znak; ?>
		     		<?php echo $link_pdf_end; ?>
		     	</label>
		     </div>
		<?php //echo $link_pdf_end; ?>


	<?php 
	$html = ob_get_contents();
	ob_end_clean();

    return $html;

}