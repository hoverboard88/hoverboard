<?php
/**
 * Staff Members
 *
 * @package Hoverboard
 */

$args = array(
	'numberposts'    => -1,
	'posts_per_page' => -1,
	'post_type'      => 'staff',
);

if ( $filter_by_group ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'staff_group',
			'field'    => 'term_id',
			'terms'    => $filter_by_group,
		),
	);
}

$members_query = new WP_Query( $args );
?>
<?php if ( $members_query->have_posts() ) : ?>
	<section class="staff-members">
		<?php
		while ( $members_query->have_posts() ) :
			$members_query->the_post();
			?>
			<div class="staff-members__item">
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

				<h3 class="staff-members__title">
					<?php the_title(); ?>
				</h3>

				<?php if ( has_excerpt() ) : ?>
					<div class="staff-members__excerpt">
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
						'class' => 'btn staff-members__btn',
					)
				);
				?>
			</div>
		<?php endwhile; ?>
	</section>
<?php endif; ?>

<?php wp_reset_postdata(); ?>