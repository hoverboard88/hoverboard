<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package hoverboard-v2
 */

if ( ! function_exists( 'hb_v2_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function hb_v2_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class=" visuallyhidden updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'hb_v2' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'hb_v2_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function hb_v2_posted_by() {

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'hb_v2' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo get_avatar( get_the_author_meta('ID'), $size = '150' );

	echo '<p class="single-spaced"><span class="posted-on byline">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span></p>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'hb_v2_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function hb_v2_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'hb_v2' ) );
		if ( $categories_list && hb_v2_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'hb_v2' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'hb_v2' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'hb_v2' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'hb_v2' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'hb_v2' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Echos icons for categories
 *
 * @return null
 */
function hb_v2_category_icons($id, $taxonomy = 'category') { ?>

	<?php if ( sizeof(wp_get_post_terms($id, $taxonomy)) == 0 ) {
		return false;
	} ?>

	<ul class="list--unstyled list--horizontal list--icons">

	<?php foreach (wp_get_post_terms($id, $taxonomy) as $taxonomy_object) { ?>

		<?php

			// if the Advanced custom fields function exists and the icon returns a something
			if (function_exists('get_field')) {
				if (get_field('category-icon-color', $taxonomy_object)) {
					$icon_color = get_field('category-icon-color', $taxonomy_object);
				} else {
					$icon_color = 'blue';
				}
			} else {
				$icon_color = 'blue';
			}
		?>

		<li class="icon icon--circle icon--tooltip icon--<?php echo $icon_color; ?>">
	    <a href="<?php echo get_term_link($taxonomy_object->term_id, $taxonomy); ?>">
	      <?php hb_v2_svg('mdi-' . $taxonomy_object->slug . '.svg', 'mdi-default.svg'); ?>
	      <span class="icon-circle__text"><?php echo get_term($taxonomy_object->term_id, $taxonomy)->name; ?></span>
	    </a>
	  </li>

	<?php } ?>

	</ul>

<?php }

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function hb_v2_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'hb_v2_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'hb_v2_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so hb_v2_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so hb_v2_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in hb_v2_categorized_blog.
 */
function hb_v2_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'hb_v2_categories' );
}
add_action( 'edit_category', 'hb_v2_category_transient_flusher' );
add_action( 'save_post',     'hb_v2_category_transient_flusher' );
