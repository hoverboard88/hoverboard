<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hoverboard-v2
 */

?>

<div class="wrap">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="container centered container-page-title">
			<header class="entry-header">
				<?php
					if ( is_single() ) {
						the_title( '<h1 class="page-title entry-title">', '</h1>' );
					} else {
						the_title( '<h2 class="page-title entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					}

				if ( 'post' === get_post_type() || 'podcast' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php hb_v2_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->
		</div>

		<div class="container container--post entry-content">

			<?php if ( 'post' === get_post_type() ) { ?>
				<div class="post__meta">
					<div class="entry-meta">

						<?php hb_v2_posted_by(); ?>
						<?php hb_v2_category_icons(get_the_ID()); ?>

						<?php $user = 'user_' . get_the_author_meta('ID'); ?>

						<div class="post__social menu--social">
							<ul>
								<?php if (get_field('social_twitter', $user)) { ?>
									<li><a target="_blank" href="https://twitter.com/<?php the_field('social_twitter', $user); ?>">
										<svg style="width:24px;height:24px" viewBox="0 0 24 24">
											<path fill="#ffffff" d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z" />
										</svg>
										<span class="visuallyhidden">Twitter</span>
									</a></li>
								<?php } ?>
								<?php if (get_field('social_linkedin', $user)) { ?>
								<li><a target="_blank" href="https://www.linkedin.com/in/<?php the_field('social_linkedin', $user); ?>">
									<svg style="width:24px;height:24px" viewBox="0 0 24 24">
										<path fill="#ffffff" d="M21,21H17V14.25C17,13.19 15.81,12.31 14.75,12.31C13.69,12.31 13,13.19 13,14.25V21H9V9H13V11C13.66,9.93 15.36,9.24 16.5,9.24C19,9.24 21,11.28 21,13.75V21M7,21H3V9H7V21M5,3A2,2 0 0,1 7,5A2,2 0 0,1 5,7A2,2 0 0,1 3,5A2,2 0 0,1 5,3Z" />
										<span class="visuallyhidden">LinkedIn</span>
									</svg>
								</a></li>
								<?php } ?>
								<li><a target="_blank" href="<?php echo esc_url( home_url( '/author/rtvenge/feed/' ) ); ?>">
									<svg style="width:24px;height:24px" viewBox="0 0 24 24">
										<path fill="#ffffff" d="M6.18,15.64A2.18,2.18 0 0,1 8.36,17.82C8.36,19 7.38,20 6.18,20C5,20 4,19 4,17.82A2.18,2.18 0 0,1 6.18,15.64M4,4.44A15.56,15.56 0 0,1 19.56,20H16.73A12.73,12.73 0 0,0 4,7.27V4.44M4,10.1A9.9,9.9 0 0,1 13.9,20H11.07A7.07,7.07 0 0,0 4,12.93V10.1Z" />
										<span class="visuallyhidden">RSS</span>
									</svg>
								</a></li>
								<?php if (get_field('social_github', $user)) { ?>
								<li><a target="_blank" href="https://www.linkedin.com/in/<?php the_field('social_github', $user); ?>">
									<svg style="width:24px;height:24px" viewBox="0 0 24 24">
										<path fill="#ffffff" d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z" />
										<span class="visuallyhidden">GitHub</span>
									</svg>
								</a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'hb_v2' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hb_v2' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	</article><!-- #post-## -->
</div>
