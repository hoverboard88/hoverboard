<?php
/**
 * The template file used to render the blog posts index.
 *
 * @package  Hoverboard
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
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
		'title'       => is_home() ? get_the_title( get_option( 'page_for_posts' ) ) : get_the_archive_title(),
		'show'        => true,
		'description' => get_the_archive_description(),
	),
);

get_template_part( 'parts/cards/cards' );

get_template_part(
	'parts/pagination/pagination',
	null,
	array(
		'pagination_links' => paginate_links(),
	)
);

get_footer();
