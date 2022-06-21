<?php
/**
 * Logo
 *
 * @package Hoverboard
 */

?>

<?php echo $args['is_h1'] ? '<h1 class="logo">' : '<div class="logo">'; ?>
	<a class="logo__link" aria-label="<?php echo esc_html( $args['title'] ); ?>" href="<?php echo esc_url( $args['url'] ); ?>">
		<?php hb_the_svg( $args['logo_name'] ); ?>
	</a>

	<?php if ( isset( $args['description'] ) ) : ?>
		<div class="logo__description">
			<?php echo esc_html( $args['description'] ); ?>
		</div>
	<?php endif; ?>
<?php echo $args['is_h1'] ? '</h1>' : '</div>'; ?>
