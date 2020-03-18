<?php
/**
 * Header
 *
 * @package Hoverboard
 */

?>

<header class="header" data-init-js="header">
	<div class="container">
		<div class="header__logo">
			<?php
			the_module(
				'logo',
				array(
					'logo_name'   => 'logo',
					'url'         => home_url( '/' ),
					'title'       => get_bloginfo( 'name' ),
					'description' => get_bloginfo( 'description' ),
				)
			);
			?>
		</div>

		<div class="header__search-toggle">
			<?php the_module( 'search-toggle' ); ?>
		</div>

		<div class="header__nav-toggle">
			<?php the_module( 'nav-toggle' ); ?>
		</div>

		<div class="header__menu">
			<?php
			the_module(
				'menu-header',
				array(
					'menu_name' => 'menu_header',
				)
			);
			?>
		</div>

		<div class="header__search">
			<?php the_module( 'search' ); ?>
		</div>
	</div>
</header>
