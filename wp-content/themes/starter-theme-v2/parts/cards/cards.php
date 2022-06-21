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

			get_template_part(
				'parts/card/card',
				null,
				array(
					'title' => get_the_title(),
					'text'  => get_the_excerpt(),
					'image' => get_post_thumbnail_id(),
					'link'  => get_the_permalink(),
				)
			);
		endwhile;
		?>
	</div>
</div>
