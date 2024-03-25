<?php
//remove_filter('widget_text_content', 'wpautop'); 

//add_filter( 'widget_display_callback', 'wpse8170_widget_display_callback', 10, 3 );
function wpse8170_widget_display_callback( $instance, $widget, $args ) {
    $instance['filter'] = false;
    return $instance;
}