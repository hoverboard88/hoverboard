<?php
/**
 * Blocks
 *
 * @package Hoverboard
 */

/**
 * Register Block Patterns
 */
function hb_register_block_patterns() {
	register_block_pattern_category(
		'hoverboard',
		array(
			'label' => __( 'Hoverboard', 'hb' ),
		)
	);
}
add_action( 'init', 'hb_register_block_patterns' );

/**
 * Register support for Gutenberg wide images in your theme
 */
function hb_theme_setup() {
	add_theme_support( 'custom-spacing' );
}
add_action( 'after_setup_theme', 'hb_theme_setup' );

/**
 * Filters allowed blocks
 *
 * @param Array $allowed_blocks Allowed blocks.
 *
 * @return Array $allowed_blocks Allowed blocks.
 */
function hb_allowed_block_types( $allowed_blocks ) {
	// To see all available blocks, run `wp.blocks.getBlockTypes()` in the Browser Console when editing a post/page.
	return array(
		'acf/accordion',
		'acf/card',
		'acf/cards',
		'acf/dialog',
		'acf/slider',
		'acf/team',
		'core/block',
		'core/buttons',
		'core/code',
		'core/column',
		'core/columns',
		'core/embed',
		'core/gallery',
		'core/group',
		'core/heading',
		'core/html',
		'core/image',
		'core/list',
		'core/paragraph',
		'core/quote',
		'core/separator',
		'core/shortcode',
		'core/spacer',
		'core/table',
		'gravityforms/form',
	);
}
add_filter( 'allowed_block_types_all', 'hb_allowed_block_types' );
