<?php

$form_id = 1;

//NOTE: update the '221' to the ID of your form
// add_filter( 'gform_pre_render_1', 'populate_checkbox' );
// add_filter( 'gform_pre_validation_1', 'populate_checkbox' );
// add_filter( 'gform_pre_submission_filter_1', 'populate_checkbox' );
// add_filter( 'gform_admin_pre_render_1', 'populate_checkbox' );
function populate_checkbox( $form ) {
 
    foreach( $form['fields'] as &$field )  {
 
        //NOTE: replace 3 with your checkbox field id
        $field_id = 2;
        // if ( $field->id != $field_id ) {
        //     continue;
        // }
        if ( $field->id == 2 ) {
 
            // you can add additional parameters here to alter the posts that are retreieved
            // more info: http://codex.wordpress.org/Template_Tags/get_posts

            $args = array(
                'role'      => 'um_patient',
                'fields'    => 'all_with_meta'
            );
            $users = get_users( $args );
            foreach( $users as $key=> $user ){ 
            //$posts = get_posts( 'numberposts=-1&post_status=publish' );
            $input_id = 1;
            //foreach( $posts as $post ) {
     
                //skipping index that are multiples of 10 (multiples of 10 create problems as the input IDs)
                if ( $input_id % 10 == 0 ) {
                    $input_id++;
                }
     
                $choices[] = array( 'text' => $user->display_name, 'value' => $user->ID );
                $inputs[] = array( 'label' => $user->display_name, 'id' => "{$field_id}.{$input_id}" );
     
                $input_id++;
            }
     
            $field->choices = $choices;
            $field->inputs = $inputs;
        }
 
    }
 
    return $form;
}

/**
 * Populate the drop-down menu with users
 *
 * @author Joshua David Nelson, josh@joshuadnelson.com
 **/
// Gravity Forms User Populate, update the '1' to the ID of your form


add_filter( 'gform_pre_render_1', 'populate_user_email_list' );
function populate_user_email_list( $form ){
 
 // Add filter to fields, populate the list
 foreach( $form['fields'] as &$field ) {
 
 // If the field is not a dropdown and not the specific class, move onto the next one
 // This acts as a quick means to filter arguments until we find the one we want
 if( $field['type'] !== 'select' || strpos($field['cssClass'], 'user-emails') === false )
 continue;
 
 // The first, "select" option
 $choices = array( array( 'text' => 'Select a Pacient', 'value' => ' ' ) );
 
 // Collect user information
 // prepare arguments
 // $args = array(
 // // order results by user_nicename
 // 'orderby' => 'user_nicename',
 // // Return the fields we desire
 // 'fields' => array( 'id', 'display_name', 'user_email' ),
 // );
 // // Create the WP_User_Query object
 // $wp_user_query = new WP_User_Query( $args );
 // // Get the results
 // $users = $wp_user_query->get_results();
 //print_r( $users );

$args = array(
    'role'      => 'um_patient',
    'fields'    => 'all_with_meta'
);
$users = get_users( $args );
if ( !empty( $users ) ) {
foreach( $users as $key=> $user ){ 

 // Check for results
 // if ( !empty( $users ) ) {
 // foreach ( $users as $user ){

 // Make sure the user has an email address, safeguard against users can be imported without email addresses
 // Also, make sure the user is at least able to edit posts (i.e., not a subscriber). Look at: http://codex.wordpress.org/Roles_and_Capabilities for more ideas
 if( !empty( $user->user_email )  ) {
 // add users to select options
 $choices[] = array(
 'text' => $user->display_name,
 'value' => $user->id,
 );
 }
 }
 }
 
 $field['choices'] = $choices;
 
 }
 
 return $form;
}


// add_filter("gform_field_value_myfield", "populate_myfield");
// function populate_myfield($value){
//     return get_post_meta($GLOBALS['post']->ID, 'myfield', true);
// }