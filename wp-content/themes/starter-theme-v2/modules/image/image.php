<?php
/**
 * Image
 *
 * @param int - $image_id
 * @param string - $size
 * @package Hoverboard
 */

?>
<?php if ( $size && $image_id ) : ?>
	<figure class="image">
		<img
			class="image__img"
			src="<?php echo esc_html( wp_get_attachment_image_src( $image_id, $size ) ); ?>"
			srcset="<?php echo esc_html( wp_get_attachment_image_srcset( $image_id, $size ) ); ?>"
			alt="<?php echo esc_html( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ); ?>"
		>
	</figure>
<?php endif; ?>
