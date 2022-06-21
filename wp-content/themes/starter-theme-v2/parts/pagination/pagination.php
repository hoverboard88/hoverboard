<?php
/**
 * Pagination
 *
 * @package Hoverboard
 */

?>

<div class="pagination container">
	<?php echo wp_kses_post( $args['pagination_links'] ); ?>
</div>
