<?php
/**
 * Template Name: Home Template
 *
 * @package  Template
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>

<?php the_module( 'hero' ); ?>
<?php the_module( 'content-home' ); ?>

<?php
get_footer();