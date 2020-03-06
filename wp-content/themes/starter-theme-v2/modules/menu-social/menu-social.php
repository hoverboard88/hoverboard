<?php if ( $social_links ) : ?>
  <nav class="menu-social" itemscope itemtype="http://schema.org/Organization">
    <link itemprop="url" href="{{site.url}}">

    <ul class="menu-social__items">
      <?php foreach ($social_links as $social_link) : ?>
        <li class="menu-social__item">
          <a itemprop="sameAs" class="menu-social__link" href="<?php echo esc_html( $social_link['url']); ?>" target="_blank">
            <?php echo hb_svg( $social_link['type'] ); ?>

            <span class="hidden-text">
              <?php echo esc_html( $social_link['label']); ?>
            </span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>
<?php endif; ?>
