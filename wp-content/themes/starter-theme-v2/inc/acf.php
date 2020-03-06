<?php

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

function hb_starter_blocks_init() {
  hb_starter_register_block( [
    'name'        => 'hero',
    'title'       => __( 'Hero' ),
    'description' => __( 'A large section at top of the page that uses an image or video.' ),
    'category'    => 'formatting',
    'icon'        => 'format-image',
    'keywords'    => [ 'hero', 'image', 'banner' ],
    'supports'    => [
      'align' => [ 'wide', 'full' ],
    ],
  ] );

  hb_starter_register_block( [
    'name'        => 'slider',
    'title'       => __( 'Slider' ),
    'description' => __( 'A slider to move content from one section to another.' ),
    'category'    => 'formatting',
    'icon'        => 'slides',
    'keywords'    => [ 'slider', 'carousel', 'gallery' ],
  ] );

  hb_starter_register_block( [
    'name'        => 'accordion',
    'title'       => __( 'Accordion' ),
    'description' => __( 'An accordion that can hide or show content.' ),
    'category'    => 'formatting',
    'icon'        => 'list-view',
    'keywords'    => [ 'faq', 'accordion' ],
  ] );

  hb_starter_register_block( [
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

add_action( 'acf/init', 'hb_starter_blocks_init' );

function hb_starter_register_block( $args ) {
  if( ! function_exists('acf_register_block') ) {
    return false;
  }

  $slug = $args['name'];

  $defaults = [
    'name'            => $slug,
    'render_callback' => 'hb_starter_render_block',
    'supports'        => [
      'align' => [ 'wide', 'full' ],
    ],
  ];

  $options = array_merge( $defaults, $args );

  // Only register if the template file exists
  if ( file_exists( get_template_directory() . "/modules/blocks/$slug/$slug.php" ) ) {
    return acf_register_block( $options );
  } else {
    return false;
  }
}

function hb_starter_render_block( $block ) {
  // convert name ("acf/testimonial") into path friendly slug ("testimonial")
  $slug = str_replace( 'acf/', '', $block['name'] );
  // TODO: get or the_module?
  get_module( $slug, [
    'fields'      => get_fields(),
    'align_style' => $block['align'] ? $block['align'] : 'none'
  ] );
}

function hb_starter_google_maps_api() {
  acf_update_setting( 'google_api_key', get_field( 'google_maps_api_key', 'options' ) );
}

add_action( 'acf/init', 'hb_starter_google_maps_api' );

function hb_starter_blocks_editor_enqueue() {
  wp_enqueue_style(
    'editor_css',
    get_template_directory_uri() . "/assets/css/editor.css",
    false,
    false,
  );
}

add_action( 'enqueue_block_editor_assets', 'hb_starter_blocks_editor_enqueue' );
