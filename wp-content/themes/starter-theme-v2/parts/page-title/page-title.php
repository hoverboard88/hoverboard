<?php
/**
 * Page Title
 *
 * @package Hoverboard
 */

?>
<?php if ( $args['show'] ) : ?>
	<div class="container">
		<h1 class="page-title">
			<?php echo wp_kses_post( $args['title'] ); ?>
		</h1>
	</div>
<?php endif; ?>
