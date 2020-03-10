<?php
/**
 * Popup Block
 *
 * @package Hoverboard
 */

?>

<div class="block-popup">
	<button class="btn" href="#<?php echo esc_html( $fields['slug'] ); ?>">
		<?php echo esc_html( $fields['button_text'] ); ?>
	</button>

	<?php
	the_module(
		'lightbox',
		array(
			'id_attribute' => $fields['slug'],
			'content'      => $fields['content'],
		)
	);
	?>
</div>
