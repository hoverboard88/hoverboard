<?php
/**
 * The template file used to render the search results.
 *
 * @package  Template
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

the_module( 'page-title', array(
	'title' => 'Search Results: ' . get_search_query(),
) );

the_module( 'search' );

the_module( 'cards' );

the_module('pagination', array(
	'pagination_links' => paginate_links(),
) );

get_footer();