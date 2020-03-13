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

	<div class="logo__group">
		<div class="logo__name">
			<?php echo esc_html( $title ); ?>
		</div>

		<div class="logo__description">
			<?php echo esc_html( $description ); ?>
		</div>
	</div>
</div>
