<?php
/**
 * Accordion Block
 *
 * @package Hoverboard
 */

?>

<div class="block-accordion align<?php echo esc_html( $align_style ); ?>">
	<?php
	the_module(
		'accordion',
		array(
			'fields' => $fields,
		)
	);
	?>
</div>
