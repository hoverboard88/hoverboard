<?php
/**
 * The single page template file used to render a single page.
 *
 * @package  Hoverboard
 */

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part(
		'parts/post-header/post-header',
		null,
		array(
			'title'       => get_the_title(),
			'show'        => get_field( 'show_page_title' ),
			'description' => false,
		)
	);

	get_template_part(
		'parts/featured-image/featured-image',
		null,
		array(
			'image' => get_post_thumbnail_id(),
			'show'  => get_field( 'show_featured_image' ),
		)
	);

	get_template_part(
		'parts/the-content/the-content',
		null,
		array(
			'post_ID' => get_the_ID(),
		)
	);
endwhile;

get_footer();
