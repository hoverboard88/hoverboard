<?php
/**
 * The single page template file used to render a single page.
 *
 * @package  Hoverboard
 */

get_header();

while ( have_posts() ) :
	the_post();

	the_module(
		'page-title',
		array(
			'title' => get_the_title(),
			'show'  => get_field( 'show_page_title' ),
		)
	);

	the_module(
		'featured-image',
		array(
			'image_id' => get_post_thumbnail_id(),
			'show'     => get_field( 'show_featured_image' ),
		)
	);

	the_module(
		'the-content',
		array(
			'post_ID' => get_the_ID(),
		)
	);
endwhile;

get_footer();
