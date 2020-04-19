<?php
/**
 * Image
 *
 * @param int - $image_id
 * @param string - $size
 * @param string - $loading value of the loading attribute aka Lazing Loading
 * @package Hoverboard
 */

if ( ! isset( $loading ) ) {
	$loading = 'auto';
}
?>

<?php if ( $size && $image_id ) : ?>
	<figure class="image">
		<img
			class="image__img"
			loading="<?php echo esc_attr( $loading ); ?>"
			src="<?php echo esc_url( wp_get_attachment_image_src( $image_id, $size )[0] ); ?>"
			srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( $image_id, $size ) ); ?>"
			alt="<?php echo esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ); ?>"
		>
	</figure>
<?php endif; ?>
