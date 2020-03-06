<?php
/**
 * The default template for displaying content.
 *
 * @package  Template_Parts
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>

<article <?php post_class('content'); ?> id="post-<?php the_ID(); ?>">
	<!-- TODO: Make a module? image module? -->
	<?php if ( has_post_thumbnail() ) : ?>
		<figure>
			<div class="content__post-image">
				<?php the_post_thumbnail(); ?>
			</div>

			<?php $caption = get_the_post_thumbnail_caption(); ?>

			<?php if ( $caption ) : ?>
				<figcaption class="content__post-image-caption"><?php echo esc_html( $caption ); ?></figcaption>
			<?php endif; ?>
		</figure>
	<?php endif; ?>

	<header class="content__title">
		<h1>
			<?php the_title(); ?>
		</h1>
	</header>

	<div class="content__content">
		<?php the_content(); ?>
	</div>

	<?php the_module('comments'); ?>
</article>
