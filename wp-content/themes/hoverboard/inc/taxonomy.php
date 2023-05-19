<?php
/**
 * Taxonomies
 *
 * @package Hoverboard
 */

/**
 * Register taxonomy
 *
 * @param array  $args       - 'name': Taxonomy name.
 *                          - 'plural': Plural form for title.
 *                          - 'singular': Singular form for title.
 *                          - 'slug': Slug used for permalink rewrite.
 * @param string $post_type Post type associated with this taxonomy.
 */
function hb_add_taxonomy( $args, $post_type ) {
	$defaults = array(
		'rewrite' => true,
		'slug'    => $args['name'],
	);

	$plural   = $args['plural'];
	$singular = $args['singular'];

	$labels = array(
		'name'              => $plural,
		'singular_name'     => $singular,
		'search_items'      => "Search $plural",
		'all_items'         => "All $plural",
		'parent_item'       => "Parent $singular",
		'parent_item_colon' => "Parent $singular:",
		'edit_item'         => "Edit $singular",
		'update_item'       => "Update $singular",
		'add_new_item'      => "Add New $singular",
		'new_item_name'     => "New $singular Name",
		'menu_name'         => $singular,
	);

	$tax = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => $args['rewrite'] ? $args['rewrite'] : array(
			'slug' => $args['slug'],
		),
	);

	register_taxonomy( $args['name'], $post_type, $tax );
}
