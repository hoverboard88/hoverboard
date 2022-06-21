<?php
/**
 * Link
 *
 * @package Hoverboard
 */

?>

<?php if ( $args['link'] ) : ?>
	<a target="<?php echo esc_html( $args['link']['target'] ); ?>" href="<?php echo esc_html( $args['link']['url'] ); ?>" class="<?php echo esc_html( $args['class'] ); ?>">
		<?php echo esc_html( $args['link']['title'] ); ?>
	</a>
<?php endif; ?>
