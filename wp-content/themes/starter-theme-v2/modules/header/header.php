<?php
/**
 * The php file used to render the header module.
 *
 * @package  Hoverboard
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>
<header class="header header--sticky">
	<div class="container container--xl">
		<div class="header__nav-toggle">
			<?php the_module( 'nav-toggle' ); ?>
		</div>

		<div class="header__logo">
			<?php
			the_module(
				'logo',
				array(
					'logo_name' => 'logo',
					'url'       => home_url( '/' ),
					'title'     => get_bloginfo( 'name' ),
					'is_h1'     => is_front_page(),
				)
			);
			?>
		</div>

		<div class="header__search-toggle">
			<?php the_module( 'search-toggle' ); ?>
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
			<?php the_module( 'search-form' ); ?>
		</div>
	</div>
</header>
