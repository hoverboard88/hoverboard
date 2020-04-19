<?php
/**
 * ACF Settings
 *
 * @package hoverboard
 */

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title'  => 'Theme Options',
			'parent_slug' => 'themes.php',
		)
	);
}

/**
 * Initialize Blocks
 */
function hb_blocks_init() {
	require get_template_directory() . '/inc/acf-blocks.php';
}

add_action( 'acf/init', 'hb_blocks_init' );

/**
 * Register Blocks
 *
 * @param Arguments $args Array.
 */
function hb_register_block( $args ) {
	if ( ! function_exists( 'acf_register_block' ) ) {
		return false;
	}

	$slug = $args['name'];

	$defaults = array(
		'name'            => $slug,
		'render_callback' => 'hb_render_block',
		'supports'        => array(
			'align' => array( 'wide', 'full' ),
		),
	);

	$options = array_merge( $defaults, $args );

	// Only register if the template file exists.
	if ( file_exists( get_template_directory() . "/modules/blocks/$slug.php" ) ) {
		return acf_register_block( $options );
	} else {
		return false;
	}
}

/**
 *  Render ACF Blocks
 *
 *  @param Block $block Array.
 */
function hb_render_block( $block ) {
	$block_name = str_replace( 'acf/', '', $block['name'] );
	$args       = array(
		'fields'      => get_fields(),
		'align_style' => $block['align'] ? $block['align'] : 'none',
	);

	if ( empty( $block_name ) ) {
		return;
	}

	extract( $args, EXTR_SKIP ); // phpcs:ignore

	include get_template_directory() . "/modules/blocks/$block_name.php";
}

/**
 * Set Google Maps API Key
 */
function hb_google_maps_api() {
	acf_update_setting( 'google_api_key', get_field( 'google_maps_api_key', 'options' ) );
}

add_action( 'acf/init', 'hb_google_maps_api' );
