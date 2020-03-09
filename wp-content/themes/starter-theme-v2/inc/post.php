<?php
/**
 * Post Types
 *
 * @package Hoverboard
 */

/**
 * Register post type
 *
 * @param array $args - 'name': Name of post type.
 *                    - 'plural': Plural form of the post type title.
 *                    - 'singular': Singular form of the post type title.
 *                    - 'slug': Slug used for permalink rewrite.
 *                    - 'icon': Name of icon class.
 */
function hb_add_post_type( $args ) {

	$defaults = array(
		'exclude_from_search' => false,
		'slug'                => $args['name'],
		'has_archive'         => true,
		'icon'                => null,
		'rewrite'             => false,
	);

	$args = array_merge( $defaults, $args );
	$plural = $args['plural'];
	$singular = $args['singular'];

	$labels = array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'menu_name'          => $plural,
		'name_admin_bar'     => $singular,
		'add_new'            => 'Add New',
		'add_new_item'       => "Add New $singular",
		'new_item'           => "Edit $singular",
		'view_item'          => "View $singular",
		'all_items'          => "All $plural",
		'search_items'       => "Search $plural",
		'parent_item_colon'  => "Parent $plural:",
		'not_found'          => "No $plural found.",
		'not_found_in_trash' => "No $plural found in Trash.",
	);

	$post_type = array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'exclude_from_search' => $args['exclude_from_search'],
		'query_var'           => true,
		'rewrite'             => $args['rewrite'] ? $args['rewrite'] : array(
			'slug'       => $args['slug'],
			'with_front' => false,
		),
		'capability_type'     => 'post',
		'has_archive'         => $args['has_archive'],
		'hierarchical'        => false,
		'menu_position'       => null,
		'menu_icon'           => $args['icon'],
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail' ),
	);

	register_post_type( $args['name'], $post_type );

}

/**
 * Register Post Types
 */
function register_post_types() {
	// Example
	// hb_add_post_type(array(
	//   'name' => 'members',
	//   'plural' => 'Team Members',
	//   'singular' => 'Team Member',
	//   'slug' => 'team',
	//   'icon' => 'dashicons-id',
	//   'has_archive' => true,
	//   'exclude_from_search' => false,
	// ) );
}
add_action( 'init', 'register_post_types' );
