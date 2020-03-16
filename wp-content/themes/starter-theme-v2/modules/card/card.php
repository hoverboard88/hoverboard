<?php
/**
 * Card
 *
 * @package Hoverboard
 */

?>

<section class="card">
	<?php if ( $title ) : ?>
		<h2 class="card__title">
			<?php echo esc_html( $title ); ?>
		</h2>
	<?php endif; ?>

	<?php if ( $image_id ) : ?>
		<div class="card__image">
			<?php echo wp_get_attachment_image( $image_id, 'card' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $text ) : ?>
		<p class="card__text">
			<?php echo esc_html( $text ); ?>
		</p>
	<?php endif; ?>

	<?php
	the_module(
		'link',
		array(
			'link' => array(
				'title' => 'Read More',
				'url' => $link,
			),
		)
	);
	?>
</section>
