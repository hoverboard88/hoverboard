<?php
/**
 * Link
 *
 * @package Hoverboard
 */

?>

<?php if ( $link ) : ?>
	<a target="<?php echo esc_html( $link['target'] ); ?>" href="<?php echo esc_html( $link['url'] ); ?>" class="<?php echo esc_html( $class ); ?>">
		<?php echo esc_html( $link['title'] ); ?>
	</a>
<?php endif; ?>
