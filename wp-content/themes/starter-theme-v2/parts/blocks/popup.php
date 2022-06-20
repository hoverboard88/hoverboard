<?php
/**
 * Popup Block
 *
 * @package Hoverboard
 */

?>

<div class="popup-block align<?php echo esc_html( $align_style ); ?> <?php echo esc_attr( $class_name ); ?>">
	<?php the_module( 'popup', array( 'fields' => $fields ) ); ?>
</div>
