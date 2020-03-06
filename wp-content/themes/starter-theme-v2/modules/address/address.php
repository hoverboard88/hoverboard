<div class="address align{{align_style}}">
  <?php if ( $title) : ?>
    <h3 class="address__title">
      <?php echo esc_html( $title ); ?>
    </h3>
  <?php endif; ?>

  <p class="address__address">
    <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
      <span itemprop="streetAddress">
        <?php echo esc_html( $address_1 ); ?><br>

        <?php if ( $address_2) : ?>
          <?php echo esc_html( $address_2 ); ?><br>
        <?php endif; ?>
      </span>

      <span itemprop="addressLocality"><?php echo esc_html( $city ); ?></span>,

      <span itemprop="addressRegion">
        <?php echo esc_html( $state ); ?>
      </span>

      <span itemprop="postalCode">
        <?php echo esc_html( $zip_code ); ?>
      </span>
    </span>
    <?php if ( $link ) : ?>
      <br>
      <?php the_module( 'link', array(
        'link' => $link,
      )); ?>
    <?php endif; ?>
  </p>
</div>
