<?php
/**
 * The default template for displaying content.
 *
 * @package  Template_Parts
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>

<main class="content">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<?php the_content(); ?>
			</article>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</main>
