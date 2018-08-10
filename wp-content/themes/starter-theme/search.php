<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$templates = array( 'search.twig', 'archive.twig', 'index.twig' );
$context = Timber::get_context();

$context['title'] = 'Search results for '. get_search_query();
$args = array(
  'posts_per_page' => get_field('posts_per_page', 'options'),
  'paged' => $paged,
  's' => get_search_query(),
);
$context['posts'] = new Timber\PostQuery($args);

Timber::render( $templates, $context );
