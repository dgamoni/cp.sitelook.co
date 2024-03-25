<?php

if ( ! function_exists('bgt_cpt_messages') ) {

// Register Custom Post Type
function bgt_cpt_messages() {

	$labels = array(
		'name'                  => _x( 'Messages', 'Messages', 'wp-bootstrap-starter-sitelook' ),
		'singular_name'         => _x( 'Messages', 'Messages', 'wp-bootstrap-starter-sitelook' ),
		'menu_name'             => __( 'Messages', 'wp-bootstrap-starter-sitelook' ),
		'name_admin_bar'        => __( 'Messages', 'wp-bootstrap-starter-sitelook' ),
		'archives'              => __( 'Item Archives', 'wp-bootstrap-starter-sitelook' ),
		'attributes'            => __( 'Item Attributes', 'wp-bootstrap-starter-sitelook' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wp-bootstrap-starter-sitelook' ),
		'all_items'             => __( 'All Items', 'wp-bootstrap-starter-sitelook' ),
		'add_new_item'          => __( 'Add New Item', 'wp-bootstrap-starter-sitelook' ),
		'add_new'               => __( 'Add New', 'wp-bootstrap-starter-sitelook' ),
		'new_item'              => __( 'New Item', 'wp-bootstrap-starter-sitelook' ),
		'edit_item'             => __( 'Edit Item', 'wp-bootstrap-starter-sitelook' ),
		'update_item'           => __( 'Update Item', 'wp-bootstrap-starter-sitelook' ),
		'view_item'             => __( 'View Item', 'wp-bootstrap-starter-sitelook' ),
		'view_items'            => __( 'View Items', 'wp-bootstrap-starter-sitelook' ),
		'search_items'          => __( 'Search Item', 'wp-bootstrap-starter-sitelook' ),
		'not_found'             => __( 'Not found', 'wp-bootstrap-starter-sitelook' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wp-bootstrap-starter-sitelook' ),
		'featured_image'        => __( 'Featured Image', 'wp-bootstrap-starter-sitelook' ),
		'set_featured_image'    => __( 'Set featured image', 'wp-bootstrap-starter-sitelook' ),
		'remove_featured_image' => __( 'Remove featured image', 'wp-bootstrap-starter-sitelook' ),
		'use_featured_image'    => __( 'Use as featured image', 'wp-bootstrap-starter-sitelook' ),
		'insert_into_item'      => __( 'Insert into item', 'wp-bootstrap-starter-sitelook' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wp-bootstrap-starter-sitelook' ),
		'items_list'            => __( 'Items list', 'wp-bootstrap-starter-sitelook' ),
		'items_list_navigation' => __( 'Items list navigation', 'wp-bootstrap-starter-sitelook' ),
		'filter_items_list'     => __( 'Filter items list', 'wp-bootstrap-starter-sitelook' ),
	);
	$args = array(
		'label'                 => __( 'Messages', 'wp-bootstrap-starter-sitelook' ),
		'description'           => __( 'Messages', 'wp-bootstrap-starter-sitelook' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 'comments' ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'menu_icon'   			=> 'dashicons-format-aside',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'messages', $args );

}
//add_action( 'init', 'bgt_cpt_messages', 0 );

}