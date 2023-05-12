<?php
/**
 * Enqueuing Scripts/Styles
 *
 * @package Hoverboard
 */

/**
 * Enqueue scripts and styles
 */
function hb_enqueue_scripts() {
	wp_enqueue_style( 'google', '//fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&display=swap', array(), '1.0.0' );
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/css/main.css', array( 'google' ), filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );
	wp_enqueue_script( 'theme', get_template_directory_uri() . '/assets/js/main.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/main.js' ), true );
}

add_action( 'wp_enqueue_scripts', 'hb_enqueue_scripts' );

/**
 * Enqueue scripts and styles for Block Editor
 */
function hb_enqueue_block_scripts() {
	wp_enqueue_style( 'theme-editor', get_template_directory_uri() . '/assets/css/editor.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/editor.css' ) );
}

add_action( 'enqueue_block_editor_assets', 'hb_enqueue_block_scripts' );

/**
 * Enqueue block script if block is present on page
 */
function hb_enqueue_block_script() {
	$block_types = acf_get_block_types();

	foreach ( $block_types as $block_type ) {
		$block_acf_name = $block_type['name'];
		$block_name     = explode( '/', $block_acf_name )[1];
		$script_handles = $block_type['script_handles'] ?? false;

		// TODO: There might be a better way to do this.
		if ( has_block( $block_acf_name ) && $script_handles ) {
			$vendor = $script_handles[1] ?? false;

			if ( $vendor ) {
				wp_enqueue_script( $vendor, get_template_directory_uri() . "/blocks/{$block_name}/vendor.js", array(), filemtime( get_stylesheet_directory() . "/blocks/{$block_name}/vendor.js" ), true );
				wp_register_script( $script_handles[0], get_template_directory_uri() . "/blocks/{$block_name}/{$block_name}.js", array( $vendor ), filemtime( get_stylesheet_directory() . "/blocks/{$block_name}/{$block_name}.js" ), true );
			} else {
				wp_register_script( $script_handles[0], get_template_directory_uri() . "/blocks/{$block_name}/{$block_name}.js", array(), filemtime( get_stylesheet_directory() . "/blocks/{$block_name}/{$block_name}.js" ), true );
			}
		}
	}
}
add_action( 'enqueue_block_assets', 'hb_enqueue_block_script' );
