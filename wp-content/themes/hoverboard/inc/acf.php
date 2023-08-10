<?php
/**
 * ACF Settings
 *
 * @package hoverboard
 */

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title'  => 'Global Options',
			'parent_slug' => 'themes.php',
		)
	);
}

/**
 * Add CSS to put icon on Global Options in Toolbar
 */
function hb_acf_admin_head() {
	?>
	<style type="text/css">
		#wp-admin-bar-acf-options-theme-options .ab-icon:before {
			content: "\f319";
			top: 3px;
		}
	</style>
	<?php
}
add_action( 'admin_head', 'hb_acf_admin_head' );
add_action( 'wp_head', 'hb_acf_admin_head' );

/**
 * Add ACF Options to Toolbar
 *
 * @param Object $wp_admin_bar WP Admin Bar.
 */
function hb_toolbar_link($wp_admin_bar) {
	$args = array(
		'id' => 'acf-options-theme-options',
		'title' => '<span class="ab-icon"></span><span class="ab-label">Global Options</span>',
		'href' => '/wp-admin/themes.php?page=acf-options-global-options',
		'meta' => array(
			'class' => 'acf-options-theme-options',
			'title' => 'Global Theme Options',
		),
	);

	$wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'hb_toolbar_link', 999);

/**
 * Register ACF Blocks
 */
function hb_register_acf_blocks() {
	$directories = glob( get_template_directory() . '/blocks/*' );
	foreach ( $directories as $directory ) {
		register_block_type( $directory, array( 'render_callback' => 'hb_render_block' ) );
	}
}

add_action( 'init', 'hb_register_acf_blocks' );

/**
 *  Render ACF Blocks
 *
 *  @param Block $block Array.
 */
function hb_render_block( $block ) {
	$block_name      = str_replace( 'acf/', '', $block['name'] );
	$block['fields'] = get_fields();

	if ( ! array_key_exists( 'className', $block ) ) {
		$block['className'] = '';
	}

	if ( ! empty( $block['align'] ) ) {
		$block['className'] .= ' align' . $block['align'];
	}

	$block['className'] = trim( $block['className'] );

	extract( $block, EXTR_SKIP ); // phpcs:ignore

	include get_template_directory() . "/blocks/$block_name/$block_name.php";
}

/**
 * Set Google Maps API Key
 */
function hb_google_maps_api() {
	acf_update_setting( 'google_api_key', get_field( 'google_maps_api_key', 'options' ) );
}

add_action( 'acf/init', 'hb_google_maps_api' );
