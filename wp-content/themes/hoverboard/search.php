<?php
/**
 * The template file used to render the search results.
 *
 * @package  Hoverboard
 */

/**
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 */

get_header();

get_template_part(
	'parts/post-header/post-header',
	null,
	array(
		'title'       => 'Search Results: ' . get_search_query(),
		'show'        => true,
		'description' => false,
	)
);

get_template_part( 'parts/frontend-search-form/frontend-search-form' );

get_template_part( 'parts/cards/cards' );

get_template_part(
	'parts/pagination/pagination',
	null,
	array(
		'pagination_links' => paginate_links(),
	)
);

get_footer();
