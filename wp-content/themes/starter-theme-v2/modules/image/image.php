<?php
/**
 * Image
 *
 * @package Hoverboard
 */

?>
<?php if ( $size && $image ) : ?>
	<figure class="image">
		<img class="image__img" src="<?php echo esc_html( $image['sizes'][ $size ] ); ?>" srcset="<?php echo esc_html( wp_get_attachment_image_srcset( $image['ID'], $size ) ); ?>" alt="<?php echo esc_html( $image['alt'] ); ?>">
	</figure>
<?php endif; ?>
