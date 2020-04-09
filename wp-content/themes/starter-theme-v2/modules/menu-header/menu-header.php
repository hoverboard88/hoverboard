<?php
/**
 * Header Menu
 *
 * @package Hoverboard
 */

?>
<?php if ( has_nav_menu( $menu_name ) ) : ?>
	<nav class="menu-header">
		<?php
			wp_nav_menu(
				array(
					'container'      => null,
					'theme_location' => $menu_name,
					'menu_class'     => 'menu-header__list',
					'menu_id'        => 'menu-header__list',
				)
			);
		?>
	</nav>
<?php endif; ?>
