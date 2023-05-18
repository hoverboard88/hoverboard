<?php
/**
 * Post Meta
 *
 * @package Hoverboard
 */

?>

<div class="post-meta">
	<div class="container">
		<?php if ( $args['author'] ) : ?>
			By

			<a itemprop="author" class="post-meta__author-link" href="<?php echo esc_html( $args['author_url'] ); ?>">
				<?php echo esc_html( $args['author'] ); ?>
			</a>
		<?php endif; ?>

		<div class="post-meta__date" itemprop="datePublished">
			<?php echo esc_html( $args['publish_date'] ); ?>
		</div>

		<?php if ( $args['categories'] ) : ?>
			<ul class="post-meta__categories">
				<?php foreach ( $args['categories'] as  $category ) : ?>
					<li class="post-meta__category">
						<a href="<?php echo esc_html( get_term_link( $category ) ); ?>" class="post-meta__category-link">
							<?php echo esc_html( $category->name ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
</div>
