<?php
/**
 * Cards
 *
 * @package Hoverboard
 */

?>

<div class="container">
	<div class="cards">
		<?php
		while ( have_posts() ) :
			the_post();

			the_module(
				'card',
				array(
					'title'    => get_the_title(),
					'text'     => get_the_excerpt(),
					'image_id' => ! empty( get_post_thumbnail_id() ) ? get_post_thumbnail_id() : get_field( 'placeholder_image', 'options' )['ID'],
					'link'     => get_the_permalink(),
				)
			);
		endwhile;
		?>
	</div>
</div>
