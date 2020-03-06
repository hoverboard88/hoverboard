<section class="hero" style="background-image: linear-gradient(rgba(26, 46, 89, 0.75), rgba(26, 46, 89, 0.75)), url(<?php the_post_thumbnail_url( get_the_ID() ); ?>);">
	<div class="container">
		<?php the_module( 'header' ); ?>

		<h1 class="hero__title"><?php the_field( 'hero_title' ); ?></h1>
		<div class="hero__description"><?php the_field( 'hero_description' ); ?></div>
		<?php $link = get_field( 'hero_link' ); ?>
		<a class="hero__link btn btn--inverse" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
	</div>

	<?php if( get_field('featured_video') ): ?>
		<div class="hero__video-bg"></div>
		<video class="hero__video" playsinline autoplay muted loop poster="<?php the_post_thumbnail_url( get_the_ID() ); ?>">
			<source src="<?php the_field('featured_video'); ?>" type="video/mp4">
		</video>
	<?php endif; ?>
</section>
