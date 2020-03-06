<?php
/**
 * Foo Bar functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hb_starter
 */

function hb_starter_setup() {
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
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  // TODO: What does this do?
  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'hb_starter_custom_background_args', [
    'default-color' => 'ffffff',
    'default-image' => '',
  ] ) );

  // Add theme support for selective refresh for widgets.
  add_theme_support( 'customize-selective-refresh-widgets' );

  /**
   * Add support for core custom logo.
   *
   * @link https://codex.wordpress.org/Theme_Logo
   */
  // TODO: What does this do?
  add_theme_support( 'custom-logo', array(
    'height'      => 250,
    'width'       => 250,
    'flex-width'  => true,
    'flex-height' => true,
  ) );
}
add_action( 'after_setup_theme', 'hb_starter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hb_starter_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hb_starter_content_width', 640 );
}
add_action( 'after_setup_theme', 'hb_starter_content_width', 0 );

/**
 * Register support for Gutenberg wide images in your theme
 */
function hb_starter_theme_setup() {
  // Gives theme ability to add "full width" and "Wide Width" option to any block. Comment out if your theme's content area can't go full browser width.
  add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'hb_starter_theme_setup');