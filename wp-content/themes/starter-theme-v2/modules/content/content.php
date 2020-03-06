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

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<figure>
		<?php the_post_thumbnail(); ?>
		<?php $caption = get_the_post_thumbnail_caption(); ?>
		<?php if ( $caption ) : ?>
			<figcaption class="wp-caption-text"><?php echo esc_html( $caption ); ?></figcaption>
		<?php endif; ?>
	</figure>

	<header>
		<h1><?php the_title(); ?></h1>
	</header>

	<?php the_content(); ?>

	<?php
	/**
	 *  Output comments template if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		comments_template();
	}
	?>
</article>
