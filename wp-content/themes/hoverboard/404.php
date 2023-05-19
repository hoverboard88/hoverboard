<?php
/**
 * The template file used to render the 404 page.
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
	'parts/page-title/page-title',
	null,
	array(
		'title' => get_field( 'four_o_four', 'options' )['title'],
		'show'  => true,
	),
);

get_template_part(
	'parts/the-content/the-content',
	null,
	array(
		'content' => get_field( 'four_o_four', 'options' )['content'],
	)
);

if ( get_field( 'four_o_four', 'options' )['search'] ) :
	echo '<div class="container">';
	get_template_part( 'parts/search-form/search-form' );
	echo '</div>';
endif;

get_footer();
