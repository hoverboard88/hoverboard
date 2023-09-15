<?php
/**
 * Post Header
 *
 * @package Hoverboard
 */

?>
<?php if ( $args['show'] ) : ?>
	<div class="post-header">
		<div class="container">
			<h1 class="post-header__title">
				<?php echo wp_kses_post( $args['title'] ); ?>
			</h1>

			<?php if ( $args['description'] ) : ?>
				<div class="post-header__description">
					<?php echo wp_kses_post( $args['description'] ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
