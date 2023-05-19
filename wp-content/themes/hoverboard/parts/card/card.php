<?php
/**
 * Card
 *
 * @package Hoverboard
 */

?>

<section class="card">
	<?php if ( isset( $args['image'] ) ) : ?>
		<a href="<?php echo esc_url( $args['link'] ); ?>" class="card__image">
			<?php
			get_template_part(
				'parts/image/image',
				null,
				array(
					'image'         => $args['image'],
					'size'          => 'card',
					'default_image' => true,
				)
			);
			?>
		</a>
	<?php endif; ?>

	<?php if ( isset( $args['title'] ) ) : ?>
		<h2 class="card__title">
			<?php echo wp_kses( str_replace( '/', '/<wbr>', $args['title'] ), array( 'wbr' => array() ) ); ?>
		</h2>
	<?php endif; ?>

	<?php if ( isset( $args['text'] ) ) : ?>
		<p class="card__text">
			<?php echo esc_html( $args['text'] ); ?>
		</p>
	<?php endif; ?>

	<?php if ( isset( $args['link'] ) ) : ?>
		<div class="card__link">
			<?php
			get_template_part(
				'parts/link/link',
				null,
				array(
					'link' => array(
						'title' => 'Read More',
						'url'   => $args['link'],
					),
					'class' => 'btn',
				)
			);
			?>
		</div>
	<?php endif; ?>
</section>
