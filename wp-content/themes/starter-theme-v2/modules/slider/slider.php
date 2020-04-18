<?php
/**
 * The php file used to render the slider module.
 *
 * @package  Hoverboard
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>
<section class="slider" data-module="slider" data-options='{}'>
	<div class="slider__track" data-glide-el="track">
		<ul class="slider__slides">
			<?php foreach ( $slides as $slide ) : ?>
				<li class="slider__slide">
					<h3 class="slider__title">
						<?php echo esc_html( $slide['title'] ); ?>
					</h3>

					<?php
					the_module(
						'image',
						array(
							'image_id' => $slide['image']['ID'],
							'size'     => 'large',
							'loading'  => 'lazy',
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
