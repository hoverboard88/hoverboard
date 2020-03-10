<?php
/**
 * Featured Image
 *
 * @package Hoverboard
 */

?>

<?php if ( has_post_thumbnail( $post_ID ) ) : ?>
	<figure class="featured-image">
		<div class="featured-image__image">
			<?php echo get_the_post_thumbnail( $post_ID, 'large' ); ?>
		</div>

		<?php $caption = get_the_post_thumbnail_caption( $post_ID ); ?>

		<?php if ( $caption ) : ?>
			<figcaption class="featured-image__caption"><?php echo esc_html( $caption ); ?></figcaption>
		<?php endif; ?>
	</figure>
<?php endif; ?>
