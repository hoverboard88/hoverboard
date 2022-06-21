<?php
/**
 * Popup Block
 *
 * @package Hoverboard
 */

?>

<div class="popup-block align<?php echo esc_html( $align_style ); ?> <?php echo esc_attr( $class_name ); ?>">
	<?php get_template_part( 'parts/popup/popup', null, array( 'fields' => $fields ) ); ?>
</div>
