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
	wp_enqueue_style( 'animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css', array(), '3.7.2' );
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/css/main.css', array( 'google' ), filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );
	wp_enqueue_script( 'vendor', get_template_directory_uri() . '/assets/js/vendor.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/vendor.js' ), true );
	wp_enqueue_script( 'theme', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery', 'vendor' ), filemtime( get_stylesheet_directory() . '/assets/js/main.js' ), true );
}

add_action( 'wp_enqueue_scripts', 'hb_enqueue_scripts' );
