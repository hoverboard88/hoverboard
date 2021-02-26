# Header

## Split Nav

If you want to create a split nav with a logo in the middle, you could reuse the `menu-header` module and create 2 header menus in WordPress. Something like this:

```
<div class="header__menu">
	<?php
	the_module(
		'menu-header',
		array(
			'menu_name' => 'menu_header_1',
		)
	);
	?>
</div>

<div class="header__logo">
	<?php
	the_module(
		'logo',
		array(
			'logo_name' => 'logo',
			'url'       => home_url( '/' ),
			'title'     => get_bloginfo( 'name' ),
		)
	);
	?>
</div>

<div class="header__menu">
	<?php
	the_module(
		'menu-header',
		array(
			'menu_name' => 'menu_header_2',
		)
	);
	?>
</div>
```
