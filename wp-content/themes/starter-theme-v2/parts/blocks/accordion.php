<?php
/**
 * Accordion Block
 *
 * @package Hoverboard
 */

?>

<div class="accordion-block align<?php echo esc_html( $align_style ); ?> <?php echo esc_attr( $class_name ); ?>">
	<?php
	get_template_part(
		'parts/accordion/accordion',
		null,
		$fields,
	);
	?>
</div>
