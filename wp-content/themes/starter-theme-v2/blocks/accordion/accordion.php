<?php
/**
 * Accordion block.
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
<section class="wp-block-accordion <?php echo esc_attr( $block['className'] ); ?>" data-block="accordion" data-options='{"open": <?php echo esc_html( $fields['first_section'] ); ?>}'>
	<?php foreach ( $fields['sections'] as $section ) : ?>
		<div class="wp-block-accordion__item js-accordion-item">
			<button class="wp-block-accordion__button js-accordion-button">
				<h3 class="wp-block-accordion__subtitle">
					<?php echo esc_html( $section['title'] ); ?>
				</h3>
			</button>
			<div class="wp-block-accordion__text">
				<?php echo wp_kses_post( $section['text'] ); ?>
			</div>
		</div>
	<?php endforeach; ?>
</section>
