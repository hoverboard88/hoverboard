<?php
/**
 * Slider Block
 *
 * @package Hoverboard
 */

?>

<div class="block-slider align<?php echo esc_html( $align_style ); ?>">
	<?php
	the_module(
		'slider',
		array(
			'fields' => $fields,
		)
	);
	?>
</div>
