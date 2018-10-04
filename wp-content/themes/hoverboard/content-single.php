<?php
/**
 * @package Hoverboard
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php hb_func_icon(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'hb' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
