<?php

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page([
    'page_title' => 'Theme Options',
    'parent_slug' => 'themes.php',
  ]);
}

function hb_blocks_init() {
  hb_register_block( [
    'name'        => 'slider',
    'title'       => __( 'Slider' ),
    'description' => __( 'A slider to move content from one section to another.' ),
    'category'    => 'formatting',
    'icon'        => 'slides',
    'keywords'    => [ 'slider', 'carousel', 'gallery' ],
  ] );

  hb_register_block( [
    'name'        => 'accordion',
    'title'       => __( 'Accordion' ),
    'description' => __( 'An accordion that can hide or show content.' ),
    'category'    => 'formatting',
    'icon'        => 'list-view',
    'keywords'    => [ 'faq', 'accordion' ],
  ] );

  hb_register_block( [
    'name'        => 'address',
    'title'       => __( 'Address' ),
    'description' => __( 'Physical address.' ),
    'category'    => 'formatting',
    'icon'        => 'location',
    'keywords'    => [ 'location', 'address' ],
    'supports'    => [
      'align' => false,
    ],
  ] );
}

add_action( 'acf/init', 'hb_blocks_init' );

function hb_register_block( $args ) {
  if( ! function_exists('acf_register_block') ) {
    return false;
  }

  $slug = $args['name'];

  $defaults = [
    'name'            => 'block-' . $slug,
    'render_callback' => 'hb_render_block',
    'supports'        => [
      'align' => [ 'wide', 'full' ],
    ],
  ];

  $options = array_merge( $defaults, $args );

  // Only register if the template file exists
  if ( file_exists( get_template_directory() . "/modules/$slug/$slug.php" ) ) {
    return acf_register_block( $options );
  } else {
    return false;
  }
}

function hb_render_block( $block ) {
  // convert name ("acf/testimonial") into path friendly slug ("testimonial")
  $slug = str_replace( 'acf/', '', $block['name'] );

  the_module( 'block-' . $slug, [
    'fields'      => get_fields(),
    'align_style' => $block['align'] ? $block['align'] : 'none'
  ] );
}

function hb_google_maps_api() {
  acf_update_setting( 'google_api_key', get_field( 'google_maps_api_key', 'options' ) );
}

add_action( 'acf/init', 'hb_google_maps_api' );

function hb_blocks_editor_enqueue() {
  wp_enqueue_style(
    'editor_css',
    get_template_directory_uri() . "/assets/css/editor.css",
    false,
    false,
  );
}

add_action( 'enqueue_block_editor_assets', 'hb_blocks_editor_enqueue' );
