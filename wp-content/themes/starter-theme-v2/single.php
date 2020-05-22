<?php
/**
 * The single post template file used to render a single post.
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
		)
	);

	the_module(
		'post-meta',
		array(
			'author'       => get_the_author(),
			'author_url'   => get_author_posts_url( get_the_author_meta( 'ID' ) ),
			'publish_date' => get_the_date(),
			'categories'   => get_the_category(),
		)
	);

	the_module(
		'featured-image',
		array(
			'post_ID' => get_the_ID(),
		)
	);

	the_module(
		'the-content',
		array(
			'post_ID' => get_the_ID(),
		)
	);

	/* comments_template(); */
endwhile;

get_footer();
