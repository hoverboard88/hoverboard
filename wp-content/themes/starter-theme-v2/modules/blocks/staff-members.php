<?php
/**
 * Staff Members
 *
 * @package Hoverboard
 */

?>

<div class="staff-members-block align<?php echo esc_html( $align_style ); ?> <?php echo esc_attr( $class_name ); ?>">
	<?php
	the_module(
		'staff-members',
		$fields,
	);
	?>
</div>
