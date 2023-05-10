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
	hb_register_block(
		array(
			'name'        => 'slider',
			'title'       => __( 'Slider' ),
			'description' => __( 'A slider to move content from one section to another.' ),
			'category'    => 'formatting',
			'icon'        => 'slides',
			'keywords'    => array( 'slider', 'carousel', 'gallery' ),
		)
	);

	register_block_type( get_template_directory() . '/blocks/accordion' );
	register_block_type( get_template_directory() . '/blocks/dialog' );

	// hb_register_block(
	// 	array(
	// 		'name'        => 'popup',
	// 		'title'       => __( 'Popup' ),
	// 		'description' => __( 'Button with popup.' ),
	// 		'category'    => 'formatting',
	// 		'icon'        => 'admin-comments',
	// 		'keywords'    => array( 'popup', 'lightbox' ),
	// 		'supports'    => array(
	// 			'align' => false,
	// 		),
	// 	)
	// );

	hb_register_block(
		array(
			'name'        => 'staff-members',
			'title'       => __( 'Staff Members' ),
			'description' => __( 'List staff members, optionally by group.' ),
			'category'    => 'formatting',
			'icon'        => 'groups',
			'keywords'    => array( 'groups', 'members' ),
		)
	);

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
