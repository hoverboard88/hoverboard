<?php
/**
 * Popup
 *
 * @package Hoverboard
 */

?>
<div class="popup-overlay"></div>
<div class="popup" data-module="popup" data-options='{}'>
	<section class="popup__content">
		<?php echo wp_kses_post( $fields['content'] ); ?>
		<button class="popup__close">Close</button>
	</section>
</div>
<button class="popup-open btn">
	<?php echo esc_html( $fields['button_text'] ); ?>
</button>
