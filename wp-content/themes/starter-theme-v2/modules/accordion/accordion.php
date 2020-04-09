<?php
/**
 * The php file used to render the accordion module.
 *
 * @package  Hoverboard
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>
<section class="accordion" data-init-js="Accordion" data-options-js='{"open": <?php echo esc_html( $first_section ); ?>}'>
	<?php foreach ( $sections as $section ) : ?>
		<div class="accordion__item js-accordion-item">
			<button class="accordion__button js-accordion-button">
				<h3 class="accordion__subtitle">
					<?php echo esc_html( $section['title'] ); ?>
				</h3>
			</button>

			<div class="accordion__text">
				<?php echo wp_kses_post( $section['text'] ); ?>
			</div>
		</div>
	<?php endforeach; ?>
</section>
