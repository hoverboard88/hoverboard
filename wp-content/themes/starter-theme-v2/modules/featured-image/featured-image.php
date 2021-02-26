<?php
/**
 * Featured Image
 *
 * @package Hoverboard
 */

?>

<?php if ( $image && $show ) : ?>
	<div class="featured-image container">
		<?php
		the_module(
			'image',
			array(
				'image' => $image,
				'size'  => 'large',
			)
		);
		?>
	</div>
<?php endif; ?>
