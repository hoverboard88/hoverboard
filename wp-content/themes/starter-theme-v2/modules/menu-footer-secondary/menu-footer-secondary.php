<?php
/**
 * Secondary Footer Menu
 *
 * @package Hoverboard
 */

?>
<?php if ( has_nav_menu( $menu_name ) ) : ?>
	<nav class="menu-footer-secondary">
		<?php
		wp_nav_menu(
			array(
				'container'      => null,
				'theme_location' => $menu_name,
				'menu_class'     => 'menu-footer-secondary__list',
				'menu_id'        => 'menu-footer-secondary__list',
			)
		);
		?>
	</nav>
<?php endif; ?>
