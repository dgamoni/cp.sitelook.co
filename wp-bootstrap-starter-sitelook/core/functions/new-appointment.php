<?php

add_action('wp_footer', 'add_custom_css');
function add_custom_css() { 
	global $post;

	if($post->post_name == 'new-appointment'):
		$user_id = ga_appointment_shortcodes::get_user_id();
		$providers = ga_provider_query( $user_id );
		if( $providers->post_count == 1 ) {
			$provider_id = $providers->post->ID;

			if($provider_id) { ?>
				<script>

					jQuery(document).ready(function($) {
						 $('#gform_1 #input_1_10').val(<?php echo $provider_id; ?>);
						 $('#gform_1 #input_1_10').addClass('selectt');
						 //$('#gform_1 #input_1_10').addClass('chosen-select');
						 //$('#gform_1 #input_1_10').trigger("chosen:updated");
						 //$('#gform_1 #input_1_10').trigger("change");


					});
				</script>
			<?php }
		}
	endif;
} 