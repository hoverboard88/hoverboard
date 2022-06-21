<?php
/**
 * Header Menu
 *
 * @package Hoverboard
 */

?>
<?php if ( has_nav_menu( $args['menu_name'] ) ) : ?>
	<?php if ( $args['show_title'] ) : ?>
		<h3 class="menu-header__title">
			<?php echo esc_html( wp_get_nav_menu_name( $args['menu_name'] ) ); ?>
		</h3>
	<?php endif; ?>


	<nav class="menu-header">
		<?php
			wp_nav_menu(
				array(
					'container'      => null,
					'theme_location' => $args['menu_name'],
					'menu_class'     => 'menu-header__list',
					'menu_id'        => 'menu-header__list',
				)
			);
		?>
	</nav>
<?php endif; ?>
