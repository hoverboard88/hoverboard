<?php
/**
 * The Content
 *
 * @package Hoverboard
 */

?>

<article <?php post_class( 'the-content container' ); ?> id="post-<?php the_ID(); ?>">
	<?php
	if ( isset( $content ) ) {
		echo wp_kses_post( $content );
	} elseif ( $post_ID ) {
		the_content( $post_ID );
	}
	?>
</article>
