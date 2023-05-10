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

$class_names = 'slider';

if ( ! empty( $block['align'] ) ) {
	$class_names .= ' align' . $block['align'];
}

if ( ! empty( $block['className'] ) ) {
	$class_names .= ' ' . $block['className'];
}

$slides = get_field( 'slides' );
?>
<section class="<?php echo esc_attr( $class_names ); ?>" data-module="slider" data-options='{}' id="<?php echo esc_attr( $block['id'] ); ?>">
	<div class="slider__track" data-glide-el="track">
		<ul class="slider__slides">
			<?php foreach ( $slides as $slide ) : ?>
				<li class="slider__slide">
					<h3 class="slider__title">
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

					<div class="slider__text">
						<?php echo wp_kses_post( $slide['text'] ); ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="slider__bullets" data-glide-el="controls[nav]">
		<?php foreach ( $slides as $index => $slide ) : ?>
			<button class="slider__bullet" data-glide-dir="=<?php echo esc_html( $index ); ?>"></button>
		<?php endforeach; ?>
	</div>
</section>
