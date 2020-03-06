<header class="header">
	<div class="header__flex">
		<?php the_module( 'logo' ); ?>
		<?php the_module( 'consultation', array( 'class' => 'consultation--desktop' ) ); ?>
		<?php the_module( 'phone' ); ?>

		<button class="menu-toggle">
			<?php echo hb_svg( 'search' ); ?>
			<span>Menu</span>
		</button>
	</div>

	<?php the_module( 'menu-mobile' ); ?>
	<?php the_module( 'menu' ); ?>
</header>