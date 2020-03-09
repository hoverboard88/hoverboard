<?php
/**
 * Slider
 *
 * @package Hoverboard
 */

?>

<section class="slider" data-init-js="slider">
	<div class="js-slider">
		<div data-glide-el="track" class="slider__track">
			<ul data-glide-el="slides" class="slider__slides">
				<?php foreach ( $fields['slides'] as $slide ) : ?>
					<li class="slider__slide">
						<h3 class="slider__title">
							<?php echo esc_html( $slide['title'] ); ?>
						</h3>

						<img class="slider__image" src="<?php echo esc_html( $slide['image']['sizes']['large'] ); ?>" alt="<?php echo esc_html( $slide['image']['alt'] ); ?>">

						<div class="slider__text">
							<?php echo wp_kses_post( $slide['text'] ); ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php if ( count( $fields['slides'] ) > 1 ) : ?>
			<div class="slider__arrows" data-glide-el="controls">
				<button class="slider__arrow slider__arrow--prev" data-glide-dir="&lt;">
					<?php echo wp_kses_post( hb_svg( 'arrow-left' ) ); ?>
				</button>
				<button class="slider__arrow slider__arrow--next" data-glide-dir="&gt;">
					<?php echo wp_kses_post( hb_svg( 'arrow-right' ) ); ?>
				</button>
			</div>

			<div class="slider__bullets" data-glide-el="controls[nav]">
				<?php foreach ( $fields['slides'] as $key => $slide ) : ?>
					<button class="slider__bullet" data-glide-dir="={{loop.index - 1}}">
						<?php echo esc_html( $key ); ?>
					</button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
