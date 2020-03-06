<?php
/**
 * The single post template file used to render a single post.
 *
 * @package  Template
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>

<main class="single">

<?php if ( have_posts() ) : ?>
	<header>
		<h1><?php the_title(); ?></h1>
	</header>
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
<?php endif; ?>

</main>

<?php
get_footer();
