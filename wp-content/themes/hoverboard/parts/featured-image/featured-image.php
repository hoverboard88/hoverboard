<?php
/**
 * Featured Image
 *
 * @package Hoverboard
 */

?>

<?php if ( $args['image'] && $args['show'] ) : ?>
	<div class="featured-image container">
		<?php
		get_template_part(
			'parts/image/image',
			null,
			array(
				'image' => $args['image'],
				'size'  => 'large',
			)
		);
		?>
	</div>
<?php endif; ?>
