<?php

//add_filter( 'gform_pre_render_1', 'custom_date_list' );
function custom_date_list( $form ) {

	//echo "<pre>", var_dump($_POST), "</pre>"; 

	foreach( $form['fields'] as &$field ) {
	 

		if ( $field->type == 'appointment_services' )  {
			//echo "<pre>", var_dump($field), "</pre>"; 
		}
 
	}
 
 return $form;
}

// filter the Gravity Forms button type
//add_filter( 'gform_submit_button_1', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<button class='button' id='gform_submit_button_1'><span>Create Appointment</span></button>";
}


//add_filter( "gform_save_field_value_1", "set_field_value", 10, 4 ); 
function set_field_value( $value, $lead, $field, $form ){ 
    // var_dump($field['id']);
    // var_dump( $value);
    // if( $form['id'] != 1 || $field['id'] != 4 ) 
    //     return; 
    if ($field['id'] == 10 ){
        //var_dump($value);
        $value = "3888"; 
    }
    // $value = "3888"; 
    return $value; 
}

//add_filter('gform_post_data_1', 'gform_dynamic_post_status', 10, 3);
function gform_dynamic_post_status($post_data, $form, $entry) {
     // update "5" to the ID of your custom post status field
    var_dump($post_data);
     // if($entry[10]){
     //    var_dump($post_data);
     //    $post_data['provider'] = '3888';

     // }
 
 return $post_data;
}

//add_filter( 'gform_save_field_value_1', 'replace_entry_id', 10, 2 );
function replace_entry_id(  $value, $entry, $field ) {
    var_dump($entry['4']);
     //var_dump($value);
 
    return $value;
}

//NOTE: update the '221' to the ID of your form
// add_filter( 'gform_pre_render_1', 'populate_checkbox1' );
// add_filter( 'gform_pre_validation_1', 'populate_checkbox1' );
// add_filter( 'gform_pre_submission_filter_1', 'populate_checkbox1' );
// add_filter( 'gform_admin_pre_render_1', 'populate_checkbox1' );
function populate_checkbox1( $form ) {
 
    foreach( $form['fields'] as &$field )  {
 
        //NOTE: replace 3 with your checkbox field id
        $field_id = 10;
        if ( $field->id == $field_id ) {
            //var_dump($field['choices']);
            foreach ($field['choices'] as $key =>  $choices_) {
                //var_dump($choices_);
                if($choices_["value"] == 3888) {
                    var_dump($choices_["value"]);
                    $choices_["isSelected"] == true;
                } else {
                    $choices_["isSelected"] == false;
                } 
            }
            
        }
 

        //$input_id = 1;

        //var_dump($field);
        //$field->choices = '4014';

        // foreach( $posts as $post ) {
 
        //     //skipping index that are multiples of 10 (multiples of 10 create problems as the input IDs)
        //     if ( $input_id % 10 == 0 ) {
        //         $input_id++;
        //     }
 
        //     $choices[] = array( 'text' => $post->post_title, 'value' => $post->post_title );
        //     $inputs[] = array( 'label' => $post->post_title, 'id' => "{$field_id}.{$input_id}" );
 
        //     $input_id++;
        // }
 
         //$field->choices = '44';
        // $field->inputs = $inputs;
 
    }
 
    return $form;
}