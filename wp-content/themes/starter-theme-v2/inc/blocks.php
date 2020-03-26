<?php
/**
 * ACF Blocks
 *
 * @package Hoverboard
 */

hb_register_block(
	array(
		'name'        => 'slider',
		'title'       => __( 'Slider' ),
		'description' => __( 'A slider to move content from one section to another.' ),
		'category'    => 'formatting',
		'icon'        => 'slides',
		'keywords'    => array( 'slider', 'carousel', 'gallery' ),
	)
);

hb_register_block(
	array(
		'name'        => 'accordion',
		'title'       => __( 'Accordion' ),
		'description' => __( 'An accordion that can hide or show content.' ),
		'category'    => 'formatting',
		'icon'        => 'list-view',
		'keywords'    => array( 'faq', 'accordion' ),
	)
);

hb_register_block(
	array(
		'name'        => 'address',
		'title'       => __( 'Address' ),
		'description' => __( 'Physical address.' ),
		'category'    => 'formatting',
		'icon'        => 'location',
		'keywords'    => array( 'location', 'address' ),
		'supports'    => array(
			'align' => false,
		),
	)
);

hb_register_block(
	array(
		'name'        => 'popup',
		'title'       => __( 'Popup' ),
		'description' => __( 'Button with popup.' ),
		'category'    => 'formatting',
		'icon'        => 'admin-comments',
		'keywords'    => array( 'popup', 'lightbox' ),
		'supports'    => array(
			'align' => false,
		),
	)
);
