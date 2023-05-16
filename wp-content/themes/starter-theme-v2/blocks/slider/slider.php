<?php
/**
 * Slider block.
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
<section class="wp-block-slider<?php echo esc_attr( $block['className'] ); ?>" data-module="slider" data-options='{}'>
	<div class="wp-block-slider__track" data-glide-el="track">
		<ul class="wp-block-slider__slides">
			<?php foreach ( $fields['slides'] as $slide ) : ?>
				<li class="wp-block-slider__slide">
					<h3 class="wp-block-slider__title">
						<?php echo esc_html( $slide['title'] ); ?>
					</h3>

					<?php
					get_template_part(
						'parts/image/image',
						null,
						array(
							'image'   => $slide['image'],
							'size'    => 'large',
							'loading' => 'lazy',
						)
					);
					?>

					<div class="wp-block-slider__text">
						<?php echo wp_kses_post( $slide['text'] ); ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="wp-block-slider__bullets" data-glide-el="controls[nav]">
		<?php foreach ( $fields['slides'] as $index => $slide ) : ?>
			<button class="wp-block-slider__bullet" data-glide-dir="=<?php echo esc_html( $index ); ?>"></button>
		<?php endforeach; ?>
	</div>
</section>
