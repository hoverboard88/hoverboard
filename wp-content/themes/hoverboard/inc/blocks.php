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
 * Filters allowed blocks
 *
 * @return Array $allowed_blocks Allowed blocks.
 */
function hb_allowed_block_types() {
	// To see all available blocks, run `wp.blocks.getBlockTypes()` in the Browser Console when editing a post/page.
	return array(
		'acf/accordion',
		'acf/brand-colors',
		'acf/card',
		'acf/cards',
		'acf/dialog',
		'acf/slider',
		'acf/team',
		'core/block',
		'core/buttons',
		'core/button',
		'core/code',
		'core/cover',
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
		'core/pullquote',
		'core/quote',
		'core/separator',
		'core/shortcode',
		'core/spacer',
		'core/table',
		'esab/accordion',
		'esab/accordion-child',
		'gravityforms/form',
	);
}
add_filter( 'allowed_block_types_all', 'hb_allowed_block_types' );
