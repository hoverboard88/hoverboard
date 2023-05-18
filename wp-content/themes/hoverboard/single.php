<?php
/**
 * The single post template file used to render a single post.
 *
 * @package  Hoverboard
 */

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part(
		'parts/page-title/page-title',
		null,
		array(
			'title' => get_the_title(),
			'show'  => get_field( 'show_page_title' ),
		)
	);

	get_template_part(
		'parts/post-meta/post-meta',
		null,
		array(
			'author'       => get_the_author(),
			'author_url'   => get_author_posts_url( get_the_author_meta( 'ID' ) ),
			'publish_date' => get_the_date(),
			'categories'   => get_the_category(),
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

	/* comments_template(); */
endwhile;

get_footer();
