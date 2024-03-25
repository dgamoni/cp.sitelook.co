<?php 

add_shortcode( 'billing_set_fee', 'billing_set_fee_func' );
function billing_set_fee_func( $atts ){ 
	$out = '';
	ob_start();

	if ( isset($_GET['patient_id']) )  {
		$id = $_GET['patient_id'];
		$user = get_user_by('id', $id );
		$sitelook_appointment_fee = get_field('sitelook_appointment_fee', 'user_'.$id );
	}

		 ?>

	<div class="appointment_fee_wrap">
		<div class="appointment_fee_label"><label>Therapy Appointment fee</label></div>
		<span class="doll_wrap"><label class="doll"></label><input class="sitelook_appointment_fee" type="number" size="10" value="<?php echo $sitelook_appointment_fee; ?>"></span>
		<a href="#" class="btn btn-primary button_message appointment_fee_save" data-patientid="<?php echo $id; ?>" >Save</a>
		<a href="javascript:void(0);" class="btn btn-primary button_message appointment_fee_charge">Charge Card Now</a>
	</div>

	<?php
	$out .= ob_get_contents();
	ob_end_clean();

	return $out;
}