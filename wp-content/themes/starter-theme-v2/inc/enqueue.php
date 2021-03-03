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
	wp_enqueue_style( 'vendor', get_template_directory_uri() . '/assets/css/vendor.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/vendor.css' ) );
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/css/main.css', array( 'google' ), filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );
	wp_enqueue_script( 'vendor', get_template_directory_uri() . '/assets/js/vendor.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/vendor.js' ), true );
	wp_enqueue_script( 'theme', get_template_directory_uri() . '/assets/js/main.js', array( 'vendor' ), filemtime( get_stylesheet_directory() . '/assets/js/main.js' ), true );
}

add_action( 'wp_enqueue_scripts', 'hb_enqueue_scripts' );

/**
 * Enqueue scripts and styles for Block Editor
 */
function hb_enqueue_block_scripts() {
	wp_enqueue_style( 'theme-editor', get_template_directory_uri() . '/assets/css/editor.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/editor.css' ) );
}

add_action( 'enqueue_block_editor_assets', 'hb_enqueue_block_scripts' );
