<?php
/**
 * Cards
 *
 * @package Hoverboard
 */

?>

<div class="cards container">
	<?php
	while ( have_posts() ) :
		the_post();

		the_module(
			'card',
			array(
				'title'    => get_the_title(),
				'text'     => get_the_excerpt(),
				'image_id' => get_post_thumbnail_id(),
				'link'     => get_the_permalink(),
			)
		);
	endwhile;
	?>
</div>
