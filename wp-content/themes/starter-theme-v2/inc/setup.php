<?php
/**
 * Setup functions and definitions
 *
 * @package Hoverboard
 */

if ( ! function_exists( 'acf_add_options_page' ) ) {
	add_action(
		'admin_notices',
		function () {
			echo '<div class="error"><p>Advanced Custom Fields PRO not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#acf' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	echo '<p>Advanced Custom Fields PRO not activated</p>';

	return;
}

/**
 * Theme Setup
 */
function hb_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'hb_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'hb_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hb_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hb_content_width', 640 );
}
add_action( 'after_setup_theme', 'hb_content_width', 0 );

/**
 * Register support for Gutenberg wide images in your theme
 */
function hb_theme_setup() {
	// Gives theme ability to add "full width" and "Wide Width" option to any block. Comment out if your theme's content area can't go full browser width.
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'hb_theme_setup' );
