<?php
/**
 * Image
 *
 * @param int - $image
 * @param string - $size
 * @param string - $loading value of the loading attribute aka Lazing Loading
 * @package Hoverboard
 */

if ( ! $image && isset( $default_image ) ) {
	$image = get_field( 'default_image', 'options' );
}

// Standardizing to an Image ID.
$image_id = is_array( $image ) ? $image['ID'] : $image;
?>

<?php if ( $size && $image_id ) : ?>
	<figure class="image">
		<img
			class="image__img"
			width="<?php echo esc_attr( wp_get_attachment_image_src( $image_id, $size )[1] ); ?>"
			height="<?php echo esc_attr( wp_get_attachment_image_src( $image_id, $size )[2] ); ?>"
			loading="<?php echo esc_attr( ! isset( $loading ) ? 'auto' : $loading ); ?>"
			src="<?php echo esc_url( wp_get_attachment_image_src( $image_id, $size )[0] ); ?>"
			srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( $image_id, $size ) ); ?>"
			alt="<?php echo esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ); ?>"
		>
	</figure>
<?php endif; ?>
