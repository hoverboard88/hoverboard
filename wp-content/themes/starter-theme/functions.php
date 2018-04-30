<?php
define('IS_DEV', isset( $_SERVER['LANDO_WEBROOT'] ) ? true : false );

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
    $this->menus = [
      [
        'name' => 'Header Menu',
        'slug' => 'header_menu',
      ],
      [
        'name' => 'Footer Menu',
        'slug' => 'footer_menu',
      ],
    ];

    if ( function_exists('acf_add_options_page') ) {
      acf_add_options_page('Theme Options');
    }

    add_theme_support( 'post-formats' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action( 'init', array( $this, 'register_menus' ) );
    add_action( 'wp_head', array( &$this, 'wp_head' ) );
    add_action( 'admin_notices', array( &$this, 'theme_dependencies' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );parent::__construct();
    $this->register_image_sizes();
  }

  function register_post_types() {
    //this is where you can register custom post types
  }

  function register_taxonomies() {
    //this is where you can register custom taxonomies
  }

  function register_menus() {

    // Loop all menus from above and register
    foreach ($this->menus as $menu) {
      register_nav_menu($menu['slug'], $menu['slug']);
    }

  }

  // Add extra image sizes here
  public function register_image_sizes() {
    // EX:
    // add_image_size( 'large', 1440 );
  }

  public function theme_dependencies() {
  if( ! function_exists('acf_add_options_page') )
    echo '<div class="error"><p>' . 'Warning: The theme needs Advanced Custom Fields Pro to function' . '</p></div>';
  }

  public function wp_head() {
    $this->favicons();
  }

  private function favicons() { ?>
    <!-- Favicon HTML -->
  <?php }

  function enqueue_scripts_styles() {
    if (IS_DEV) {
      wp_enqueue_style( 'hb_dev_css', get_template_directory_uri() . '/dist/css/dev.css', false, filemtime( get_stylesheet_directory() . '/dist/css/dev.css' ));
      wp_enqueue_script( 'hb_dev_js', get_template_directory_uri() . '/dist/js/dev.js', false, filemtime( get_stylesheet_directory() . '/dist/js/dev.js' ), true);
    } else {
      wp_enqueue_style( 'hb_bundle_css', get_template_directory_uri() . '/dist/css/bundle.css', false, filemtime( get_stylesheet_directory() . '/dist/css/bundle.css' ));
      wp_enqueue_script( 'hb_bundle_js', get_template_directory_uri() . '/dist/js/bundle.js', false, filemtime( get_stylesheet_directory() . '/dist/js/bundle.js' ), true);
    }
  }

  // Add variables to templates
  function add_to_context( $context ) {

    // loop through menus above and pass to template
    foreach ($this->menus as $menu) {
      $context[$menu['slug']] = new TimberMenu($menu['slug']);
    }

    global $post;

    $context['template_url'] = $this->theme_uri;
    $context['options'] = get_fields('options'); // Get all global options
    $context['fields'] = get_fields($post->ID);
    $context['content_sections'] = get_field('content_sections'); // Get all layouts
    $context['site'] = $this;
    return $context;
  }

  function svg( $filename ) {
    $file = get_stylesheet_directory() . '/src/img/' . $filename . '.svg';
    return file_exists($file) ? file_get_contents($file) : false;
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
