<?php
/**
 * Featured Image
 *
 * @package Hoverboard
 */

?>

<?php if ( $image_id && $show ) : ?>
	<div class="featured-image container">
		<?php
		the_module(
			'image',
			array(
				'image_id' => $image_id,
				'size'     => 'large',
			)
		);
		?>
	</div>
<?php endif; ?>
