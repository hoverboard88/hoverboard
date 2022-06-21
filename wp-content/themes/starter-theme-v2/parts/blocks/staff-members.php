<?php
/**
 * Staff Members
 *
 * @package Hoverboard
 */

?>

<div class="staff-members-block align<?php echo esc_html( $align_style ); ?> <?php echo esc_attr( $class_name ); ?>">
	<?php
	get_template_part(
		'parts/staff-members/staff-members',
		null,
		$fields,
	);
	?>
</div>
