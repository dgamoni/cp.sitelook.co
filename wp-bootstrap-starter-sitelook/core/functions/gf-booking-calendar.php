<?php

add_filter( 'gform_pre_render_1', 'custom_date_list' );
function custom_date_list( $form ) {

	foreach( $form['fields'] as &$field ) {
	 

		if ( $field->type == 'appointment_services' )  {
			//echo "<pre>", var_dump($field), "</pre>"; 
		}
 
	}
 
 return $form;
}