<?php
/**
 * Address Block
 *
 * @package Hoverboard
 */

?>

<div class="block-address align<?php echo esc_html( $align_style ); ?>">
	<?php
	the_module(
		'address',
		get_field( 'address', 'options' )
	);
	?>
</div>
