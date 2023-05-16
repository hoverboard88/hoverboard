<?php
/**
 * Dialog block template.
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

?>
<dialog class="wp-block-dialog <?php echo esc_attr( $block['className'] ); ?>" data-block="dialog">
	<div class="dialog__content">
		<?php echo wp_kses_post( $fields['content'] ); ?>
		<InnerBlocks />
	</div>
	<form class="dialog__form" method="dialog">
		<button class="dialog__btn btn">Close</button>
	</form>
</dialog>

<button class="dialog-btn btn" data-block="dialog-btn">
	<?php echo esc_html( $fields['button_text'] ); ?>
</button>
