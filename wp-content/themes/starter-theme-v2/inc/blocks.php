<?php
/**
 * Native Blocks
 *
 * @package Hoverboard
 */

/**
 * Register Block Styles
 */
function hb_register_block_styles() {
	wp_register_style( 'hb-blocks', get_template_directory_uri() . '/assets/css/blocks.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/blocks.css' ) );

	register_block_style(
		'core/columns',
		array(
			'name'         => 'even-height',
			'label'        => 'Even Height',
			'style_handle' => 'hb-blocks',
		)
	);
}



add_action( 'init', 'hb_register_block_styles' );

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
function tabor_gutenberg_color_palette() {
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
add_action( 'after_setup_theme', 'tabor_gutenberg_color_palette' );
