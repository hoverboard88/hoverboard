<?php if ( has_post_thumbnail( $post_ID ) ) : ?>
  <figure class="featured-image">
    <div class="featured-image__image">
      <?php the_post_thumbnail( $post_ID ); ?>
    </div>

    <?php $caption = get_the_post_thumbnail_caption( $post_ID ); ?>

    <?php if ( $caption ) : ?>
      <figcaption class="featured-image__caption"><?php echo esc_html( $caption ); ?></figcaption>
    <?php endif; ?>
  </figure>
<?php endif; ?>