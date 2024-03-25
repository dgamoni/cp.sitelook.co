<?php 

add_shortcode( 'patient_jornal_info', 'patient_jornal_info_func' );
function patient_jornal_info_func( $atts ){

	$html = '';
	ob_start();


	if ( isset($_GET['patient_id']) )  {
		$id = $_GET['patient_id'];
		$user = get_user_by('id', $id );
		//var_dump($user->data);
		$name = $user->data->display_name;
		$email = $user->data->user_email;
		$user_meta =  get_user_meta($id);
		//echo '<pre>'.var_dump($user_meta).'</pre>';
		$phone = $user_meta['phone'][0];
		$sitelook_user_address = $user_meta['sitelook_user_address'][0];
		$user_registered = $user->user_registered;
	} else {
		$name = '';
		$email = '';
		$phone = '';
		$sitelook_user_address = '';
		$user_registered = '';
	}

	?> 
	<div class="patient_jornal_info">
		<div class="patient_jornal_info_string">
			<span class="patient_jornal_info_label">Name: </span>
			<span class="patient_jornal_info_name"><?php echo $name; ?></span>
		</div>
		<div class="patient_jornal_info_string">
			<span class="patient_jornal_info_label">Email: </span>
			<span class="patient_jornal_info_name"><?php echo $email; ?></span>
		</div>
		<div class="patient_jornal_info_string">
			<span class="patient_jornal_info_label">Phone: </span>
			<span class="patient_jornal_info_name"><?php echo $phone; ?></span>
		</div>
		<div class="patient_jornal_info_string">
			<span class="patient_jornal_info_label">Address: </span>
			<span class="patient_jornal_info_name"><?php echo $sitelook_user_address; ?></span>
		</div>
		<div class="patient_jornal_info_string">
			<span class="patient_jornal_info_label">Patient Since: </span>
			<span class="patient_jornal_info_name"><?php echo date( "F Y", strtotime( $user_registered) ); ?></span>
		</div>						
	</div>

	<?php
	$html .= ob_get_contents();
	ob_end_clean();

	return $html;
}