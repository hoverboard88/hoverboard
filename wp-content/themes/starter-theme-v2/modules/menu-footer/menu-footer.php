<?php
/**
 * The php file used to render the menu-footer module.
 *
 * @package  Hoverboard
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>
<nav class="menu-footer">
	<?php
	wp_nav_menu(
		array(
			'container'      => null,
			'theme_location' => $menu_name,
			'menu_class'     => 'menu-footer__list',
			'menu_id'        => 'menu-footer__list',
		)
	);
	?>
</nav>
