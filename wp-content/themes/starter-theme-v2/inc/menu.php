<?php
function hb_menus() {
  register_nav_menu( 'menu_header', esc_html__( 'Menu Header', 'hb' ) );
	register_nav_menu( 'menu_footer', esc_html__( 'Menu Footer', 'hb' ) );
	register_nav_menu( 'menu_footer_secondary', esc_html__( 'Menu Footer Secondary', 'hb' ) );
}

add_action( 'after_setup_theme', 'hb_menus' );