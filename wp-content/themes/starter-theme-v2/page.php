<?php
/**
 * The single page template file used to render a single page.
 *
 * @package  Template
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();

while ( have_posts() ) : the_post();
  the_module( 'page-title', array(
    'title' => get_the_title(),
  ) );

  the_module( 'featured-image', array(
    'post_ID' => get_the_ID(),
  ) );

  the_module( 'the-content', array(
    'post_ID' => get_the_ID(),
  ) );
endwhile;

get_footer();
