<?php
/**
 * Shortcodes
 */

function hb_shortcode_year( $atts ){
	return date('Y');
}
add_shortcode( 'year', 'hb_shortcode_year' );

function hb_shortcode_site_name( $atts ){
	return get_bloginfo('name');
}
add_shortcode( 'site_name', 'hb_shortcode_site_name' );