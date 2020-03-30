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
		<?php
		the_module( 'menu-footer', array( 'menu_name' => 'menu_footer' ) );

		if ( get_field( 'address', 'options' ) ) {
			the_module( 'address', get_field( 'address', 'options' ) );
		}

		the_module( 'copyright', array( 'text' => get_field( 'fine_print', 'options' ) ) );
		the_module( 'menu-footer-secondary', array( 'menu_name' => 'menu_footer_secondary' ) );
		the_module( 'menu-social', array( 'social_links' => get_field( 'social_links', 'options' ) ) );
		?>
	</div>
</footer>
