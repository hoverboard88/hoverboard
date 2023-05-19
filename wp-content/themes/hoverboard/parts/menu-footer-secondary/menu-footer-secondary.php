<?php
/**
 * Secondary Footer Menu
 *
 * @package Hoverboard
 */

?>
<?php if ( has_nav_menu( $menu_name ) ) : ?>
	<?php if ( $show_title ) : ?>
		<h3 class="menu-footer-secondary__title">
			<?php echo esc_html( wp_get_nav_menu_name( $menu_name ) ); ?>
		</h3>
	<?php endif; ?>

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
