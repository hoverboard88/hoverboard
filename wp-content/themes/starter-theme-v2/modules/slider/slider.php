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
							the_module( 'image',
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
			<button class="glide__bullet" data-glide-dir="=0"></button>
			<button class="glide__bullet" data-glide-dir="=1"></button>
			<button class="glide__bullet" data-glide-dir="=2"></button>
		</div>
	</div>
</section>
