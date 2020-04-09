<?php
/**
 * Slider Block
 *
 * @package Hoverboard
 */

?>
<div class="slider-block align<?php echo esc_html( $align_style ); ?>">
	<?php
	the_module(
		'slider',
		$fields,
	);
	?>
</div>
