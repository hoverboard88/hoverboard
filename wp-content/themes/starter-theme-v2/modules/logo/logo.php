<?php
/**
 * Logo
 *
 * @package Hoverboard
 */

?>

<div class="logo">
	<a class="logo__link" href="<?php echo esc_url( $url ); ?>">
		<?php hb_the_svg( $logo_name ); ?>

		<span class="screen-reader-text" aria-hidden="true">
			<?php echo esc_html( $title ); ?>
		</span>
	</a>

	<?php if ( isset( $description ) ) : ?>
		<div class="logo__description">
			<?php echo esc_html( $description ); ?>
		</div>
	<?php endif; ?>
</div>
