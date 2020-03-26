<?php
/**
 * Address Block
 *
 * @package Hoverboard
 */

?>

<div class="address-block align<?php echo esc_html( $align_style ); ?>">
	<?php
	the_module(
		'address',
		get_field( 'address', 'options' )
	);
	?>
</div>
