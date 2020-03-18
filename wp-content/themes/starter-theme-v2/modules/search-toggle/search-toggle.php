<?php
/**
 * Search Toggle
 *
 * @package Hoverboard
 */

?>

<a data-init-js="search-toggle" href="<?php echo esc_url( home_url( '/' ) ); ?>?s=" class="search-toggle">
  <?php hb_the_svg( 'search' ); ?>
</a>
