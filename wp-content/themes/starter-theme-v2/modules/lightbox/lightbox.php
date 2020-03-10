<?php
/**
 * Lightbox
 *
 * @package Hoverboard
 */

?>
<section id="<?php echo esc_html( $id_attribute ); ?>" class="lightbox" data-init-js="lightbox">
	<div class="lightbox__overlay">
		<div class="lightbox__popup">
			<button class="lightbox__close">Close</button>

			<?php echo wp_kses_post( $content ); ?>
		</div>
	</div>
</section>
