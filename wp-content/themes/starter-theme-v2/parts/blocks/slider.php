<?php
/**
 * Slider Block
 *
 * @package Hoverboard
 */

?>
<div class="slider-block align<?php echo esc_html( $align_style ); ?> <?php echo esc_attr( $class_name ); ?>">
	<?php
	get_template_part(
		'parts/slider/slider',
		null,
		$fields,
	);
	?>
</div>
