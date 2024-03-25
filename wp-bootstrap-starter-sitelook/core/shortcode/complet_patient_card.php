<?php 

add_shortcode( 'complet_patient_card', 'complet_patient_card_func' );
function complet_patient_card_func( $atts ){  



var_dump($_GET);
var_dump($_POST);
// var_dump($ipn_data["auth"]);
// var_dump($ipn_data["rapidsState"]);
// var_dump($ipn_data["rapidsStateSignature"]);
// var_dump($ipn_data["form_charset"]);


	ob_start();
	?>






	<?php
	$out .= ob_get_contents();
	ob_end_clean();

	return $out;
}	
