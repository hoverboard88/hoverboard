<?php
/**
 * Pagination
 *
 * @package Hoverboard
 */

if ( ! $args['pagination_links'] ) {
	return;
}
?>

<div class="pagination container">
	<?php echo wp_kses_post( $args['pagination_links'] ); ?>
</div>
