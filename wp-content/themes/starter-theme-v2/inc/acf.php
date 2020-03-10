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
	hb_register_block(
		array(
			'name'        => 'slider',
			'title'       => __( 'Slider' ),
			'description' => __( 'A slider to move content from one section to another.' ),
			'category'    => 'formatting',
			'icon'        => 'slides',
			'keywords'    => array( 'slider', 'carousel', 'gallery' ),
		)
	);

	hb_register_block(
		array(
			'name'        => 'accordion',
			'title'       => __( 'Accordion' ),
			'description' => __( 'An accordion that can hide or show content.' ),
			'category'    => 'formatting',
			'icon'        => 'list-view',
			'keywords'    => array( 'faq', 'accordion' ),
		)
	);

	hb_register_block(
		array(
			'name'        => 'address',
			'title'       => __( 'Address' ),
			'description' => __( 'Physical address.' ),
			'category'    => 'formatting',
			'icon'        => 'location',
			'keywords'    => array( 'location', 'address' ),
			'supports'    => array(
				'align' => false,
			),
		)
	);

	hb_register_block(
		array(
			'name'        => 'popup',
			'title'       => __( 'Popup' ),
			'description' => __( 'Button with popup.' ),
			'category'    => 'formatting',
			'icon'        => 'admin-comments',
			'keywords'    => array( 'popup', 'lightbox' ),
			'supports'    => array(
				'align' => false,
			),
		)
	);
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

	$slug = 'block-' . $args['name'];

	$defaults = array(
		'name'            => $slug,
		'render_callback' => 'hb_render_block',
		'supports'        => array(
			'align' => array( 'wide', 'full' ),
		),
	);

	$options = array_merge( $defaults, $args );

	// Only register if the template file exists.
	if ( file_exists( get_template_directory() . "/modules/$slug/$slug.php" ) ) {
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
	// convert name ("acf/testimonial") into path friendly slug ("testimonial").
	$slug = str_replace( 'acf/', '', $block['name'] );

	the_module(
		'block-' . $slug,
		array(
			'fields'      => get_fields(),
			'align_style' => $block['align'] ? $block['align'] : 'none',
		)
	);
}

/**
 * Set Google Maps API Key
 */
function hb_google_maps_api() {
	acf_update_setting( 'google_api_key', get_field( 'google_maps_api_key', 'options' ) );
}

add_action( 'acf/init', 'hb_google_maps_api' );
