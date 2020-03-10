<?php
/**
 * Footer Menu
 *
 * @package Hoverboard
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
