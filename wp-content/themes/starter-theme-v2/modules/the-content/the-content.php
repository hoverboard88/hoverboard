<?php while ( have_posts() ) : ?>
  <article class="the-content">
    <?php echo __( $content ); ?>
  </article>
<?php endwhile; ?>