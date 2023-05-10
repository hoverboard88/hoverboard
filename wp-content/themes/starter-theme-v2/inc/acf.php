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
 * Register ACF Blocks
 */
function hb_register_acf_blocks() {
	register_block_type( get_template_directory() . '/blocks/accordion' );
	register_block_type( get_template_directory() . '/blocks/card' );
	register_block_type( get_template_directory() . '/blocks/cards' );
	register_block_type( get_template_directory() . '/blocks/dialog' );
	register_block_type( get_template_directory() . '/blocks/slider' );
	register_block_type( get_template_directory() . '/blocks/team' );
	register_block_type( get_template_directory() . '/blocks/wrapper' );
}

add_action( 'init', 'hb_register_acf_blocks' );

/**
 * Set Google Maps API Key
 */
function hb_google_maps_api() {
	acf_update_setting( 'google_api_key', get_field( 'google_maps_api_key', 'options' ) );
}

add_action( 'acf/init', 'hb_google_maps_api' );
