<?php
/**
 * Copyright
 *
 * @package Hoverboard
 */

?>

<?php if ( $args['text'] ) : ?>
	<p class="copyright">
		<?php echo do_shortcode( esc_html( $args['text'] ) ); ?>
	</p>
<?php endif; ?>
