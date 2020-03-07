<?php
function hb_enqueue_scripts() {
	wp_enqueue_style( 'google', '//fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&display=swap', array() );
  wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/css/main.css', array() );
  wp_enqueue_script( 'theme', get_template_directory_uri() . '/assets/js/main.js', [ 'jquery' ], false, true );
}

add_action( 'wp_enqueue_scripts', 'hb_enqueue_scripts' );
