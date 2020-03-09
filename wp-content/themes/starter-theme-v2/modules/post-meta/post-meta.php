<?php
/**
 * Post Meta
 *
 * @package Hoverboard
 */

?>

<div class="post-meta">
	<div class="container">
		<?php if ( $author ) : ?>
			By

			<a itemprop="author" class="post-meta__author-link" href="<?php echo esc_html( $author_url ); ?>">
				<?php echo esc_html( $author ); ?>
			</a>
		<?php endif; ?>

		<div class="post-meta__date" itemprop="datePublished">
			<?php echo esc_html( $publish_date ); ?>
		</div>

		<?php if ( $categories ) : ?>
			<ul class="post-meta__categories">
				<?php foreach ( $categories as  $category ) : ?>
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
