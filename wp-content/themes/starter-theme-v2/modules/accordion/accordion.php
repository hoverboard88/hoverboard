<?php
/**
 * Accordion
 *
 * @package Hoverboard
 */

?>

<section class="accordion" data-init-js="accordion" data-options-js='{"open": <?php echo $fields['first_section']; ?>}'>
	<?php foreach ( $fields['sections'] as $section ) : ?>
		<div class="accordion__item js-accordion-item">
			<button class="accordion__button js-accordion-button">
				<h3 class="accordion__subtitle">
					<?php echo esc_html( $section['title'] ); ?>
				</h3>
			</button>

			<div class="accordion__text">
				<?php echo $section['text']; ?>
			</div>
		</div>
	<?php endforeach; ?>
</section>
