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
<section class="slider" data-init-js="Slider">
	<div class="glide">
		<div class="glide__track" data-glide-el="track">
			<ul class="glide__slides">
				<?php foreach ( $fields['slides'] as $slide ) : ?>
					<li class="glide__slide">
						<h3 class="glide__title">
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

		<div class="glide__bullets" data-glide-el="controls[nav]">
			<?php foreach ( $fields['slides'] as $index => $slide ) : ?>
				<button class="glide__bullet" data-glide-dir="=<?php echo esc_html( $index ); ?>"></button>
			<?php endforeach; ?>
		</div>
	</div>
</section>
