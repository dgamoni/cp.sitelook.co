<?php 

add_shortcode( 'patient_info_header', 'patient_info_header_func' );
function patient_info_header_func( $atts ){

	$atts = shortcode_atts( array(
		'title' => '[patient name]',
		'patient_id' => ''
	), $atts );

	$html = '';
	ob_start();


	if ( isset($_GET['patient_id']) )  {
		$id = $_GET['patient_id'];
		$user = get_user_by('id', $id );
		//var_dump($user->data);
		$name = $user->data->display_name;
	} else {
		$name = $atts['title'];
	}

	?> 


		<div class="patient_info_header">
			<h2><?php echo $name; ?></h2>
			<div class="patient_button">
				<a href="javascript:void(0);" class="um-message-btn btn btn-primary button_message" data-message_to="<?php echo $id; ?>">Message</a>
				<!-- <button type="button" class="btn btn-primary button_message">Message</button> -->
				<button type="button" class="btn btn-danger button_edit">Edit</button>
			</div>
		</div>
	<?php
	$html .= ob_get_contents();
	ob_end_clean();

	return $html;
}