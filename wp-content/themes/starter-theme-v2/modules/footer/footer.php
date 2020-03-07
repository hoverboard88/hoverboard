<footer class="footer">
	<div class="container">
		<?php the_module( 'menu-footer', array(
			'menu_name'  => 'menu_footer',
		) ); ?>

		<?php the_module( 'address', get_field('address', 'options') ); ?>

		<?php the_module( 'copyright', array(
			'text' => get_field( 'fine_print', 'options'),
		) ); ?>

		<?php the_module( 'menu-footer-secondary', array(
			'menu_name'  => 'menu_footer_secondary',
		) ); ?>

		<?php the_module( 'menu-social', array(
			'social_links' => get_field( 'social_links', 'options' )
		) ); ?>
	</div>
</footer>