<div class="logo">
	<a class="logo__link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php echo hb_svg( 'logo-light' ); ?>
		<span class="screen-reader-text" aria-hidden="true"><?php bloginfo( 'name' ); ?></span>
	</a>

	<div class="logo__group">
		<div class="logo__name"><?php bloginfo( 'name' ); ?></div>
		<div class="logo__description"><?php bloginfo( 'description' ); ?></div>
	</div>
</div>