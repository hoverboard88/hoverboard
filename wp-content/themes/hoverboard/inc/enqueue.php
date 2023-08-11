<?php
/**
 * Enqueuing Scripts/Styles
 *
 * @package Hoverboard
 */

/**
 * Enqueue scripts and styles
 */
function hb_enqueue_scripts() {
	// https://www.kristinfalkner.com/wordpress-google-fonts-fix/ don't put a version number on google fonts
	wp_enqueue_style( 'google', '//fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&display=swap', array(), null );
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/css/main.min.css', array( 'google' ), filemtime( get_stylesheet_directory() . '/assets/css/main.min.css' ) );
	wp_enqueue_script( 'theme', get_template_directory_uri() . '/assets/js/main.min.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/main.min.js' ), true );
}

add_action( 'wp_enqueue_scripts', 'hb_enqueue_scripts' );

/**
 * Enqueue scripts and styles for Block Editor
 */
function hb_enqueue_block_scripts() {
	wp_enqueue_style( 'theme-editor', get_template_directory_uri() . '/assets/css/editor.min.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/editor.min.css' ) );
}

add_action( 'enqueue_block_editor_assets', 'hb_enqueue_block_scripts' );

/**
 * Add preconnect for Google Fonts
 */
function hb_add_preconnect() {
	echo '<link rel="preconnect" href="//fonts.googleapis.com">';
	echo '<link rel="preconnect" href="//fonts.gstatic.com/" crossorigin>';
}
add_action( 'wp_head', 'hb_add_preconnect', 1 );

/**
 * Add css variable aliases for colors
 */
function hb_color_aliases() {
	$theme_json = file_get_contents( get_template_directory() . '/theme.json' );

	$theme_json_object = json_decode( $theme_json );
	$colors = $theme_json_object->settings->color->palette;

	?>
	<style>
		body {
			<?php foreach ($colors as $key => $color) : ?>
				--<?php echo esc_attr( $color->slug ); ?>: var(--wp--preset--color--<?php echo esc_attr( $color->slug ); ?>);
			<?php endforeach; ?>
		?>
		}
	</style>
<?php }
add_action( 'wp_head', 'hb_color_aliases', 999 );

/**
 * Enqueue block script if block is present on page
 */
function hb_enqueue_block_script() {
	$block_types = acf_get_block_types();
	$deps        = array();

	foreach ( $block_types as $block_type ) {
		$block_acf_name = $block_type['name'];
		$block_name     = explode( '/', $block_acf_name )[1];
		$script_handles = $block_type['script_handles'] ?? false;

		// TODO: There might be a better way to do this.
		if ( has_block( $block_acf_name ) && $script_handles ) {
			$vendor              = $script_handles[1] ?? false;
			$block_relative_path = "/blocks/${block_name}/assets";

			if ( $vendor ) {
				wp_enqueue_script( $vendor, get_template_directory_uri() . "$block_relative_path/{$block_name}.vendor.min.js", array(), filemtime( get_stylesheet_directory() . "$block_relative_path/{$block_name}.vendor.min.js" ), true );
				$deps[] = $vendor;
			}

			wp_register_script( $script_handles[0], get_template_directory_uri() . "$block_relative_path/{$block_name}.min.js", $deps, filemtime( get_stylesheet_directory() . "$block_relative_path/{$block_name}.min.js" ), true );
		}
	}
}
add_action( 'enqueue_block_assets', 'hb_enqueue_block_script' );
