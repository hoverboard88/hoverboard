<?php
/**
 * Images
 *
 * @package Hoverboard
 */

/**
 * SVG
 *
 * @param string $filename file name without .svg.
 * @return Boolean svg file text
 */
function hb_the_svg( $filename ) {
	$file = get_stylesheet_directory() . '/images/' . $filename . '.svg';
	// @codingStandardsIgnoreStart
	echo file_get_contents( $file );
	// @codingStandardsIgnoreEnd

	return file_exists( $file );
}

/**
 * Register Image Sizes
 */
function hb_register_image_sizes() {
	add_image_size( 'card', 800, 450, true );
	add_image_size( 'hero', 1440 );
}

add_action( 'init', 'hb_register_image_sizes' );
