<?php
/**
 * Brand Colors block.
 *
 * @package Hoverboard
 */

$theme_json = file_get_contents( get_template_directory() . '/theme.json' );
$theme_json_object = json_decode( $theme_json );
$colors = $theme_json_object->settings->color->palette;
?>

<section <?php echo $block['block_wrapper_attributes']; ?>>
	<?php foreach ( $colors as $color ) : ?>
		<div class="brand-colors__color" style="--brand-color: <?php echo esc_attr( $color->color ); ?>">
			<span class="brand-colors__name">
				<?php echo esc_attr( $color->name ); ?>
			</span>

			<span class="brand-colors__hex">
				<?php echo esc_attr( $color->color ); ?>
			</span>
		</div>
	<?php endforeach; ?>
</section>
