<?php
/**
 * Team block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 *
 * @package  Hoverboard
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$filter_by_group = get_field( 'filter_by_group' );

$args = array(
	'numberposts'    => -1,
	'posts_per_page' => -1,
	'post_type'      => 'team',
);

if ( $filter_by_group ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'executives',
			'field'    => 'term_id',
			'terms'    => $filter_by_group,
		),
	);
}

$team = new WP_Query( $args );
?>
<?php if ( $team->have_posts() ) : ?>
	<section <?php echo $block['block_wrapper_attributes']; ?>>
		<?php
		while ( $team->have_posts() ) :
			$team->the_post();
			?>
			<div class="wp-block-acf-team__member">
				<a href="<?php the_permalink(); ?>">
					<?php
					get_template_part(
						'parts/image/image',
						null,
						array(
							'image'         => get_post_thumbnail_id(),
							'size'          => 'card',
							'default_image' => true,
						)
					);
					?>
				</a>

				<h3 class="wp-block-acf-team__title">
					<?php the_title(); ?>
				</h3>

				<?php if ( has_excerpt() ) : ?>
					<div class="wp-block-acf-team__excerpt">
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>

				<?php
				get_template_part(
					'parts/link/link',
					null,
					array(
						'link'  => array(
							'url'   => get_the_permalink(),
							'title' => 'Full Bio',
						),
						'class' => 'btn team__btn',
					)
				);
				?>
			</div>
		<?php endwhile; ?>
	</section>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
