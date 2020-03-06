<article <?php post_class('the-content container'); ?> id="post-<?php the_ID(); ?>">
  <?php
    if ( $content ) {
      echo __( $content );
    } else if ( $post_ID ) {
      the_content( $post_ID );
    }
  ?>
</article>