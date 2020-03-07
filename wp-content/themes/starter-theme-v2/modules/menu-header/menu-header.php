<!-- TODO: Figure out how to add a burger menu that is flexible based on various designs -->
<nav class="menu-header">
	<?php wp_nav_menu(array(
		'container'      => NULL,
		'theme_location' => $menu_name,
		'menu_class'     => 'menu-header__list',
		'menu_id'        => 'menu-header__list',
	)); ?>
</nav>