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

$class_names = 'dialog';

if ( ! empty( $block['align'] ) ) {
	$class_names .= ' align' . $block['align'];
}

if ( ! empty( $block['className'] ) ) {
	$class_names .= ' ' . $block['className'];
}

$button_text = get_field( 'button_text' );
$content     = get_field( 'content' );
$slug        = get_field( 'slug' );
?>
<dialog class="<?php echo esc_attr( $class_names ); ?>" data-block="dialog" id="<?php echo esc_attr( $block['id'] ); ?>">
	<div class="dialog__content">
		<?php echo wp_kses_post( $content ); ?>
		<InnerBlocks />
	</div>
	<form class="dialog__form" method="dialog">
		<button class="dialog__btn btn">Close</button>
	</form>
</dialog>

<button class="dialog-btn btn" data-block="dialog-btn">
	<?php echo esc_html( $button_text ); ?>
</button>
