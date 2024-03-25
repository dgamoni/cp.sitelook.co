<?php
//add_filter( 'gform_pre_render_4', 'diagnosis_list' );
function diagnosis_list( $form ){
 
	foreach( $form['fields'] as &$field ) { 
		if ( $field->id == 3 ) {

			$choices = array();

			// $testfile = CORE_PATH."/doc/diagnosis_json.json";
			// $listener = new \JsonStreamingParser\Listener\InMemoryListener();
			// $stream = fopen($testfile, 'r');
			// try {
			//     $parser = new \JsonStreamingParser\Parser($stream, $listener);
			//     $parser->parse();
			//     fclose($stream);
			// } catch (Exception $e) {
			//     fclose($stream);
			//     throw $e;
			// }

			// foreach ($listener->getJson() as $key => $code_array) {
			// 	//var_dump($code_array['code']);
			// 	//$choices[] = array( 'text' => $code_array['code'], 'value' => $code_array['code'] );
			// }

	        $field->placeholder = 'Select';
	        $field->choices = $choices;

		}
	}
 	return $form;
}

add_shortcode( 'giagnosis_list', 'giagnosis_list_func' );
function giagnosis_list_func( $atts ){
	ob_start();

	//$string = file_get_contents(CORE_PATH."/doc/diagnosis_json.json");
	//$json = json_decode($string, true);
	//var_dump(json_decode($string));

	// $testfile = CORE_PATH."/doc/diagnosis_json.json";
	// $listener = new \JsonStreamingParser\Listener\InMemoryListener();
	// $stream = fopen($testfile, 'r');
	// try {
	//     $parser = new \JsonStreamingParser\Parser($stream, $listener);
	//     $parser->parse();
	//     fclose($stream);
	// } catch (Exception $e) {
	//     fclose($stream);
	//     throw $e;
	// }
	//var_dump($listener->getJson());
	//$code_arrays = $listener->getJson();
	$code = array();
	// foreach ($listener->getJson() as $key => $code_array) {
	// 	//var_dump($code_array['code']);
	// 	//array_push($code, $code_array['code']);

	// 	//wp_insert_term( $code_array['code'], 'icd_codes');


	// 	if($key%10 == 0) {
	// 		 wp_cache_flush();
	// 	}
	// }

	//var_dump($code);
	// foreach ($code as $key => $value) {
	// 	wp_insert_term( $value, 'icd_codes');
	// }

	//$name = 'A000 Cholera due to Vibrio cholerae 01, biovar cholerae';
	//wp_insert_term( $name, 'icd_codes');


	$html = ob_get_contents();
	ob_end_clean();
    return $html;
}


	