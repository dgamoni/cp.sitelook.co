<?php
if ( ! function_exists( 'icd_codes' ) ) {

// Register Custom Taxonomy
function icd_codes() {

	$labels = array(
		'name'                       => _x( 'ICD-10 codes', 'ICD-10 codes', 'sitelook' ),
		'singular_name'              => _x( 'ICD-10 codes', 'ICD-10 codes', 'sitelook' ),
		'menu_name'                  => __( 'ICD-10 codes', 'sitelook' ),
		'all_items'                  => __( 'All Items', 'sitelook' ),
		'parent_item'                => __( 'Parent Item', 'sitelook' ),
		'parent_item_colon'          => __( 'Parent Item:', 'sitelook' ),
		'new_item_name'              => __( 'New Item Name', 'sitelook' ),
		'add_new_item'               => __( 'Add New Item', 'sitelook' ),
		'edit_item'                  => __( 'Edit Item', 'sitelook' ),
		'update_item'                => __( 'Update Item', 'sitelook' ),
		'view_item'                  => __( 'View Item', 'sitelook' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'sitelook' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'sitelook' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'sitelook' ),
		'popular_items'              => __( 'Popular Items', 'sitelook' ),
		'search_items'               => __( 'Search Items', 'sitelook' ),
		'not_found'                  => __( 'Not Found', 'sitelook' ),
		'no_terms'                   => __( 'No items', 'sitelook' ),
		'items_list'                 => __( 'Items list', 'sitelook' ),
		'items_list_navigation'      => __( 'Items list navigation', 'sitelook' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'icd_codes', array( 'therapist' ), $args );

}
add_action( 'init', 'icd_codes', 0 );

}