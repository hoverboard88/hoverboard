<?php
/**
 * Logo
 *
 * @package Hoverboard
 */

?>

<?php echo $is_h1 ? '<h1 class="logo">' : '<div class="logo">'; ?>
	<a class="logo__link" aria-label="<?php echo esc_html( $title ); ?>" href="<?php echo esc_url( $url ); ?>">
		<?php hb_the_svg( $logo_name ); ?>
	</a>

	<?php if ( isset( $description ) ) : ?>
		<div class="logo__description">
			<?php echo esc_html( $description ); ?>
		</div>
	<?php endif; ?>
<?php echo $is_h1 ? '</h1>' : '</div>'; ?>
