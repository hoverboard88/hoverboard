<?php
/**
 * Social Menu
 *
 * @package Hoverboard
 */

?>

<?php if ( $social_links ) : ?>
	<nav class="menu-social" itemscope itemtype="http://schema.org/Organization">
		<link itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>">

		<ul class="menu-social__items">
			<?php foreach ( $social_links as $social_link ) : ?>
				<li class="menu-social__item">
					<a itemprop="sameAs" class="menu-social__link" href="<?php echo esc_html( $social_link['link']['url'] ); ?>" target="<?php echo esc_html( $social_link['link']['target'] ); ?>">
						<?php hb_the_svg( $social_link['type'] ); ?>

						<span class="hidden-text">
							<?php echo esc_html( $social_link['link']['title'] ); ?>
						</span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
<?php endif; ?>
