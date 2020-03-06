<?php
	$social_links = get_field( 'social_links', 'option' );
?>
<?php if ( $social_links ) : ?>
<div class="social">
	<?php foreach( $social_links as $social_link ) : ?>
		<a class="social__link" href="<?php echo esc_url( $social_link['url'] ); ?>" target="_blank"><?php echo hb_svg( $social_link['type'] ); ?></a>
	<?php endforeach; ?>
</div>
<?php endif; ?>