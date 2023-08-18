<?php
/**
 * Cards block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 *
 * @package  Hoverboard
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$allowed_blocks = array( 'acf/card' );
?>

<section <?php echo wp_kses_post( $block['block_wrapper_attributes'] ); ?>>
	<div class="wp-block-acf-cards__cards" style="--cards-gap: <?php echo esc_attr( $fields['gap'] ); ?>; --cards-columns: <?php echo esc_attr( $fields['columns'] ); ?>;">
		<InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" />
	</div>
</section>
