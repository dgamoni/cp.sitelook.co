<?php
/**
 * Template Name: notes edit
 */
//link on a page to edit an entry: <a href="http://domain.com/edit-page/?entry=1">Edit</a>


get_header(); ?>

  <section id="primary" class="content-area col-sm-12 col-lg-8">
    <main id="main" class="site-main" role="main">





<?php 
//page template for "edit-page"

  //grab entry id from query parameter in link above
  $entry_id=$_GET['entry'];
  //var_dump($entry_id);
  
  //grab the entry values via the GF API
  $entry = GFAPI::get_entry($entry_id);

  //var_dump($entry);

  if ( is_wp_error( $entry ) ) {
       echo "Error"; 
  } else {
      
    //list field, example how to unserialize
     $clist = maybe_unserialize($entry);
     $cvalue = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($clist)), FALSE);
     //var_dump($cvalue);
    
    // //embed new form and populate the form with normal field and list field
     gravity_form(4, false, false, false, array( 'input_4_6' => $cvalue[24]), true);
  
  } 












//function.php - GF action hook - edit isntead of submitting if the request comes from edit-page

//add_action("gform_pre_submission_1", "pre_submission_handler");
function pre_submission_handler($form){
  
  if($_SERVER["REDIRECT_URL"]=="/edit-page/"){
    
    //submitted new values that need to be used to update the original entry via $success = GFAPI::update_entry( $entry );
    //var_dump($_POST);
    
    //Get original entry id
    parse_str($_SERVER["QUERY_STRING"]); //will be stored in $entry
    
    //get the actual entry we want to edit
    $editentry = GFAPI::get_entry($entry);
    
    //make changes to it from new values in $_POST, this shows only the first field update
    $editentry[1]=$_POST["input_1"];
    
    //update it
    $updateit = GFAPI::update_entry($editentry);
    
    if ( is_wp_error( $updateit ) ) {
      echo "Error."; 
    } else {
      //success, so redirect
      header("Location: http://domain.com/confirmation/");
    }

    //dont process and create new entry
    die();
    
  } else {
    //any other code you want in this hook for regular entry submit
  }
  
} ?>

    </main><!-- #main -->
  </section><!-- #primary -->

<?php
get_footer();
