<?php
/**
 * Card
 *
 * @package Hoverboard
 */

?>

<section class="card">
	<a href="<?php echo esc_url( $link ); ?>" class="card__image">
		<?php
		the_module(
			'image',
			array(
				'image'         => $image,
				'size'          => 'card',
				'default_image' => true,
			)
		);
		?>
	</a>

	<?php if ( $title ) : ?>
		<h2 class="card__title">
			<?php echo wp_kses( str_replace( '/', '/<wbr>', $title ), array( 'wbr' => array() ) ); ?>
		</h2>
	<?php endif; ?>

	<?php if ( $text ) : ?>
		<p class="card__text">
			<?php echo esc_html( $text ); ?>
		</p>
	<?php endif; ?>

	<div class="card__link">
		<?php
		the_module(
			'link',
			array(
				'link' => array(
					'title' => 'Read More',
					'url'   => $link,
				),
				'class' => 'btn',
			)
		);
		?>
	</div>
</section>
