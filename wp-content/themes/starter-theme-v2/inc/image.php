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
 * @return String svg file text
 */
function hb_svg( $filename ) {
	$file = get_stylesheet_directory() . '/assets/images/' . $filename . '.svg';
	return file_exists( $file ) ? file_get_contents( $file ) : false;
}
