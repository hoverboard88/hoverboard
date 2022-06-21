<?php
/**
 * Address Block
 *
 * @package Hoverboard
 */

?>

<div class="address-block align<?php echo esc_html( $align_style ); ?> <?php echo esc_attr( $class_name ); ?>">
	<?php
	get_template_part(
		'parts/address/address',
		null,
		get_field( 'address', 'options' )
	);
	?>
</div>
