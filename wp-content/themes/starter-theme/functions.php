<?php

if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
    echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
  });

  add_filter('template_include', function($template) {
    return get_stylesheet_directory() . '/static/no-timber.html';
  });

  return;
}

Timber::$dirname = array('templates', 'src/views');

class StarterSite extends TimberSite {

  function __construct() {

    $this->theme_uri = get_template_directory_uri();

    add_theme_support( 'post-formats' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    add_filter( 'upload_mimes', array(&$this, 'svg_support' ));
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action( 'wp_head', array( &$this, 'wp_head' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );parent::__construct();
    $this->register_image_sizes();
  }

  function register_post_types() {
    //this is where you can register custom post types
  }

  function register_taxonomies() {
    //this is where you can register custom taxonomies
  }

  function add_svg_support( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }

  // Add extra image sizes here
	public function register_image_sizes() {
		// EX:
		// add_image_size( 'large', 1440 );
	}

  public function wp_head() {
    $this->favicons();
  }

  private function favicons() { ?>
    <!-- Favicon HTML -->
  <?php }

  function enqueue_scripts_styles() {
    wp_enqueue_style( 'hb_bundle', get_template_directory_uri() . '/dist/css/bundle.css', false, filemtime( get_stylesheet_directory() . '/dist/css/bundle.css' ));
    wp_enqueue_script( 'hb_bundle', get_template_directory_uri() . '/dist/js/bundle.js', false, filemtime( get_stylesheet_directory() . '/dist/js/bundle.js' ));
  }

  // Add variables to templates
  function add_to_context( $context ) {
    // $context['foo'] = 'These values are available everytime you call Timber::get_context();';
    $context['template_url'] = $this->theme_uri;
    $context['menu'] = new TimberMenu();
    $context['options'] = get_fields('options'); // Get all global options
    $context['site'] = $this;
    return $context;
  }

  function svg( $filename ) {
    return file_get_contents(get_stylesheet_directory() . '/src/img/' . $filename . '.svg');
  }

  function myfoo( $text ) {
    $text .= ' bar!';
    return $text;
  }

  function add_to_twig( $twig ) {
    /* this is where you can add your own functions to twig */
    $twig->addExtension( new Twig_Extension_StringLoader() );
    $twig->addFilter('svg', new Twig_SimpleFilter('svg', array($this, 'svg')));
    // See myfoo above
    // $twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
    return $twig;
  }

}

new StarterSite();