<div class="modal-overlay" id="modal-overlay" aria-hidden="true"></div>
<div class="modal" aria-hidden="true">
	<button class="modal__close"><?php echo hb_svg( 'close' ); ?></button>
	<div class="modal__content" data-init-js="menu-mobile" data-options-js='{}'>
		<?php wp_nav_menu(
			array(
				'container'       => 'nav',
				'container_class' => 'menu-mobile',
				'menu'            => 'menu_mobile',
				'menu_class'      => 'menu-mobile__list',
				'menu_id'         => 'menu-mobile__list',
				'theme_location'  => 'menu_mobile',
			) ); ?>

			<?php the_module( 'search' ); ?>
	</div>
</div>