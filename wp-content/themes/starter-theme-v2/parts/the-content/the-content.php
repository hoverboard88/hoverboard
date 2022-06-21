<?php
/**
 * The Content
 *
 * @package Hoverboard
 */

?>

<article <?php post_class( 'the-content' ); ?> id="post-<?php the_ID(); ?>">
	<?php
	if ( isset( $args['content'] ) ) {
		echo wp_kses_post( $args['content'] );
	} elseif ( $args['post_ID'] ) {
		the_content( $args['post_ID'] );
	}
	?>
</article>
