<?php
/**
 * Staff Members
 *
 * @package Hoverboard
 */

?>

<div class="staff-members-block align<?php echo esc_html( $align_style ); ?>">
	<?php
	the_module(
		'staff-members',
		$fields,
	);
	?>
</div>
