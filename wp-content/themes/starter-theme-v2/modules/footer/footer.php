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
			the_module(
				'menu-footer',
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
				the_module(
					'address',
					get_field( 'address', 'options' ),
				);
				?>
			</div>
		<?php endif; ?>

		<div class="footer__copyright">
			<?php
			the_module(
				'copyright',
				array(
					'text' => get_field( 'fine_print', 'options' ),
				)
			);
			?>
		</div>

		<div class="footer__menu-secondary">
			<?php
			the_module(
				'menu-footer-secondary',
				array(
					'menu_name'  => 'menu_footer_secondary',
					'show_title' => true,
				)
			);
			?>
		</div>

		<div class="footer__social">
			<?php
			the_module(
				'menu-social',
				array(
					'social_links' => get_field( 'social_links', 'options' ),
				)
			);
			?>
		</div>
	</div>
</footer>
