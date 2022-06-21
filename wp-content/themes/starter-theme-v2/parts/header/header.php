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
<header class="header">
	<div class="container container--xl">
		<div class="header__nav-toggle">
			<?php get_template_part( 'part/nav-toggle/nav-toggle' ); ?>
		</div>

		<div class="header__logo">
			<?php
			get_template_part(
				'parts/logo/logo',
				null,
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
			<?php get_template_part( 'parts/search-toggle/search-toggle' ); ?>
		</div>

		<div class="header__menu">
			<?php
			get_template_part(
				'parts/menu-header/menu-header',
				null,
				array(
					'menu_name'  => 'menu_header',
					'show_title' => false,
				)
			);
			?>
		</div>

		<div class="header__search">
			<?php get_template_part( 'parts/search-form/search-form' ); ?>
		</div>
	</div>
</header>
