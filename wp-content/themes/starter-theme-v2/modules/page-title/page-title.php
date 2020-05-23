<?php
/**
 * Page Title
 *
 * @package Hoverboard
 */

?>
<?php if ( $show ) : ?>
	<div class="container">
		<h1 class="page-title">
			<?php echo wp_kses_post( $title ); ?>
		</h1>
	</div>
<?php endif; ?>
