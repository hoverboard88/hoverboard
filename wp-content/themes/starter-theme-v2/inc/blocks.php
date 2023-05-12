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

	register_block_pattern(
		'hb/colored-background',
		array(
			'title'       => __( 'Colored Background Section', 'textdomain' ),
			'categories'  => array(
				'hoverboard',
			),
			'description' => _x( 'A group with a background color that spans the width of the page.', 'Block pattern description', 'textdomain' ),
			'content'     => '<!-- wp:group {"align":"full","backgroundColor":"gray-light"} --> <div class="wp-block-group alignfull has-gray-light-background-color has-background"><!-- wp:heading --> <h2>Title</h2> <!-- /wp:heading --> <!-- wp:paragraph --> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit…</p> <!-- /wp:paragraph --></div> <!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'hb_register_block_patterns' );

/**
 * Register support for Gutenberg wide images in your theme
 */
function hb_theme_setup() {
	 // Gives theme ability to add "full width" and "Wide Width" option to any block. Comment out if your theme's content area can't go full browser width.
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'hb_theme_setup' );

/**
 * Add support for custom color palettes in Gutenberg.
 */
function hb_gutenberg_color_palette() {
	 add_theme_support( 'disable-custom-colors' );

	// Make sure to add Block classes in wordpress.css:
	// .has-COLOR-color and .has-COLOR-background-color.

	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Black', '@@textdomain' ),
				'slug'  => 'black',
				'color' => '#000',
			),
			array(
				'name'  => esc_html__( 'Gray', '@@textdomain' ),
				'slug'  => 'gray',
				'color' => '#2D2D2D',
			),
			array(
				'name'  => esc_html__( 'Gray (light)', '@@textdomain' ),
				'slug'  => 'gray-light',
				'color' => '#EEE',
			),
			array(
				'name'  => esc_html__( 'White', '@@textdomain' ),
				'slug'  => 'gray',
				'color' => '#fff',
			),
		)
	);
}
add_action( 'after_setup_theme', 'hb_gutenberg_color_palette' );

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
