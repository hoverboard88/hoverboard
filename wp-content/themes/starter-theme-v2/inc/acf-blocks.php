<?php
/**
 * ACF Blocks
 *
 * @package Hoverboard
 */

/**
 * Register ACF Blocks
 */
function hb_register_acf_blocks() {
	register_block_type( get_template_directory() . '/blocks/accordion' );
	register_block_type( get_template_directory() . '/blocks/dialog' );
	register_block_type( get_template_directory() . '/blocks/slider' );
	register_block_type( get_template_directory() . '/blocks/team' );

	// hb_register_block(
	// 	array(
	// 		'name'        => 'staff-members',
	// 		'title'       => __( 'Staff Members' ),
	// 		'description' => __( 'List staff members, optionally by group.' ),
	// 		'category'    => 'formatting',
	// 		'icon'        => 'groups',
	// 		'keywords'    => array( 'groups', 'members' ),
	// 	)
	// );

	hb_register_block(
		array(
			'name'        => 'wrapper',
			'title'       => __( 'Wrapper' ),
			'description' => __( 'Wraps block in colored background and padding.' ),
			'category'    => 'formatting',
			'icon'        => 'list-view',
			'keywords'    => array( 'wrap', 'container' ),
		)
	);
}

add_action( 'init', 'hb_register_acf_blocks' );
