<?php
/**
 * Secondary Footer Menu
 *
 * @package Hoverboard
 */

?>

<nav class="menu-footer-secondary">
	<?php
	wp_nav_menu(
		array(
			'container'      => NULL,
			'theme_location' => $menu_name,
			'menu_class'     => 'menu-footer-secondary__list',
			'menu_id'        => 'menu-footer-secondary__list',
		)
	);
	?>
</nav>
