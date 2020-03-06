<!-- TODO: Figure out how to add a burger menu that is flexible based on various designs -->
<nav class="header-menu">
	<?php wp_nav_menu(array(
		'container'  => NULL,
		'menu'       => $menu_name,
		'menu_class' => 'header-menu__list',
		'menu_id'    => 'header-menu__list',
	)); ?>
</nav>