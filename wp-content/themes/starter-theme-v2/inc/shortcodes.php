<?php
/**
 * Shortcodes
 *
 * @package Hoverboard
 */

/**
 * Year Shortcode
 *
 * @param array $atts Attributes passed in from Shortcode.
 *
 * @return string
 */
function hb_shortcode_year( $atts ) {
	return gmdate( 'Y' );
}
add_shortcode( 'year', 'hb_shortcode_year' );

/**
 * Site Name Shortcode
 *
 * @param array $atts Attributes passed in from Shortcode.
 *
 * @return string
 */
function hb_shortcode_site_name( $atts ) {
	return get_bloginfo( 'name' );
}
add_shortcode( 'site_name', 'hb_shortcode_site_name' );
