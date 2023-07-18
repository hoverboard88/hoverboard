<?php
/**
 * The php file used to render the footer module.
 *
 * @package  Hoverboard
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>
<footer class="footer">
	<div class="container">
		<div class="footer__menu">
			<?php
			get_template_part(
				'parts/menu-footer/menu-footer',
				null,
				array(
					'menu_name'  => 'menu_footer',
					'show_title' => true,
				)
			);
			?>
		</div>

		<?php if ( get_field( 'address', 'options' ) ) : ?>
			<div class="footer__address">
				<?php
				get_template_part(
					'parts/address/address',
					null,
					get_field( 'address', 'options' ),
				);
				?>
			</div>
		<?php endif; ?>

		<div class="footer__copyright">
			<?php
			get_template_part(
				'parts/copyright/copyright',
				null,
				array(
					'text' => get_field( 'fine_print', 'options' ),
				)
			);
			?>
		</div>

		<div class="footer__menu-secondary">
			<?php
			get_template_part(
				'parts/menu-footer-secondary/menu-footer-secondary',
				null,
				array(
					'menu_name'  => 'menu_footer_secondary',
					'show_title' => true,
				)
			);
			?>
		</div>

		<div class="footer__social">
			<?php
			get_template_part(
				'parts/menu-social/menu-social',
				null,
				array(
					'social_links' => get_field( 'social_links', 'options' ),
				)
			);
			?>
		</div>
	</div>
</footer>
