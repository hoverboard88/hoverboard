<?php
/**
 * Home Content
 *
 * @package  Hoverboard
 */

?>

<main class="content-home">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<?php the_content(); ?>
			</article>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</main>
