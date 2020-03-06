<?php
function hb_starter_menus() {
  register_nav_menu( 'menu', esc_html__( 'Menu', 'hb' ) );
	register_nav_menu( 'menu_footer', esc_html__( 'Menu Footer', 'hb' ) );
	register_nav_menu( 'menu_footer_secondary', esc_html__( 'Menu Footer Secondary', 'hb' ) );
	register_nav_menu( 'menu_mobile', esc_html__( 'Menu Mobile', 'hb' ) );
}

add_action( 'after_setup_theme', 'hb_starter_menus' );