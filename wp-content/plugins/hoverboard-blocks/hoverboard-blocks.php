<?php
/**
 * Plugin Name:       Hoverboard Blocks
 * Description:       A Gutenberg block plugins for the Hoverboard Theme.
 * Version:           0.1.0
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Author:            Hoverboard
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hoverboard-blocks
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function hoverboard_blocks_block_init() {
	foreach( glob( __DIR__ . '/build/*/' ) as $directory ) {
		register_block_type( $directory );
	}
}
add_action( 'init', 'hoverboard_blocks_block_init' );
