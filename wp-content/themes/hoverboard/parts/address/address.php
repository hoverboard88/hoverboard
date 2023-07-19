<?php
/**
 * Address
 *
 * @package Hoverboard
 */

?>

<div class="address">
	<?php if ( $args['title'] ) : ?>
		<h3 class="address__title">
			<?php echo esc_html( $args['title'] ); ?>
		</h3>
	<?php endif; ?>

	<p class="address__address">
		<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<span itemprop="streetAddress">
				<?php echo esc_html( $args['address_1'] ); ?><br>

				<?php if ( $args['address_2'] ) : ?>
					<?php echo esc_html( $args['address_2'] ); ?><br>
				<?php endif; ?>
			</span>

			<span itemprop="addressLocality"><?php echo esc_html( $args['city'] ); ?></span>,

			<span itemprop="addressRegion">
				<?php echo esc_html( $args['state'] ); ?>
			</span>

			<span itemprop="postalCode">
				<?php echo esc_html( $args['zip_code'] ); ?>
			</span>
		</span>

		<?php if ( $args['link'] ) : ?>
			<br>
			<?php
			get_template_part(
				'parts/link/link',
				null,
				array(
					'link' => $args['link'],
				)
			);
			?>
		<?php endif; ?>
	</p>
</div>
