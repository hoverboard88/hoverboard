<header class="header">
	<?php the_module( 'logo', array(
		'logo_name'   => 'logo-light',
		'url'         => home_url( '/' ),
		'title'       => get_bloginfo( 'name' ),
		'description' => get_bloginfo( 'description' ),
	) ); ?>

	<?php the_module( 'search', array(
		'placeholder' => 'Search ' . get_bloginfo( 'name') . '…'
	) ); ?>

	<?php the_module( 'menu-header', array(
		'menu_name'  => 'menu_header',
	) ); ?>
</header>