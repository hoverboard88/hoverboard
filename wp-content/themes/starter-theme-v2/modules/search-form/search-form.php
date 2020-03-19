<?php
/**
 * Search
 *
 * @package Hoverboard
 */

?>

<form class="search-form" role="search" action="<?php echo esc_html( site_url() ); ?>">
	<div class="search-form__field">
		<label for="s" class="screen-reader-text">
			Search
		</label>

		<input id="s" class="search-form__input" type="text" value="<?php echo get_search_query(); ?>" placeholder="<?php echo 'Search ' . esc_html( get_bloginfo( 'name' ) ) . '…'; ?>" name="s">

		<button class="search-form__submit btn" type="submit">
			Search
		</button>
	</div>
</form>
