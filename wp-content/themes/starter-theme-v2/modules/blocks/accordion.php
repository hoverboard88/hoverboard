<?php
/**
 * Accordion Block
 *
 * @package Hoverboard
 */

?>

<div class="accordion-block align<?php echo esc_html( $align_style ); ?> <?php echo esc_attr( $class_name ); ?>">
	<?php
	the_module(
		'accordion',
		$fields,
	);
	?>
</div>
