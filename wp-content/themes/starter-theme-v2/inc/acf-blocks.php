<?php
/**
 * ACF Blocks
 *
 * @package Hoverboard
 */

/**
 * Register ACF Blocks
 */
function hb_register_acf_blocks() {
	register_block_type( get_template_directory() . '/blocks/accordion' );
	register_block_type( get_template_directory() . '/blocks/dialog' );
	register_block_type( get_template_directory() . '/blocks/slider' );
	register_block_type( get_template_directory() . '/blocks/team' );
	register_block_type( get_template_directory() . '/blocks/wrapper' );
}

add_action( 'init', 'hb_register_acf_blocks' );
