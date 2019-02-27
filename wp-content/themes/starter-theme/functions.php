<?php
define('IS_DEV', isset( $_SERVER['LANDO_WEBROOT'] ) ? true : false );

if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
    echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
  });

  add_filter('template_include', function($template) {
    return '<p>Timber not activated</p>';
  });

  return;
}

if( ! function_exists('acf_add_options_page') ) {
  add_action( 'admin_notices', function() {
    echo '<div class="error"><p>Advanced Custom Fields PRO not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#acf' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
  });

  echo '<p>Advanced Custom Fields PRO not activated</p>';

  return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array('templates', 'src/views');

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site {

  public function __construct() {

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

    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action( 'init', array( $this, 'register_menus' ) );
    add_action( 'wp_head', array( &$this, 'wp_head' ) );
    add_action( 'admin_notices', array( &$this, 'theme_dependencies' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
    add_filter( 'mce_buttons_2', array( $this, 'mce_buttons_2') );
    add_filter( 'tiny_mce_before_init', array( $this, 'mce_button_styles') );

    add_action( 'acf/init', array( $this, 'blocks_init'));
    add_action( 'acf/init', array( $this, 'google_maps_api'));
    add_action( 'after_setup_theme', array( $this, 'theme_setup'));

    // React Blocks
    add_action( 'enqueue_block_editor_assets', array( $this, 'blocks_editor_enqueue' ) );

    parent::__construct();
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );parent::__construct();

    $this->register_image_sizes();
    $this->theme_supports();

    acf_add_options_page('Theme Options');
  }

  public function theme_supports() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support( 'title-tag' );

    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support( 'post-thumbnails' );

    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support(
      'html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
      )
    );

    add_theme_support( 'menus' );
   }

  public function register_post_types() {
    // Example
    // $this->add_post_type([
    //   'name' => 'members',
    //   'plural' => 'Team Members',
    //   'singular' => 'Team Member',
    //   'slug' => 'team',
    //   'icon' => 'dashicons-id',
    //   'has_archive' => true,
    //   'exclude_from_search' => false,
    // ]);
  }

  public function register_taxonomies() {
    // Use `$this->add_taxonomy()` to register taxonomies
  }

  public function register_menus() {

    // Loop all menus from above and register
    foreach ($this->menus as $menu) {
      register_nav_menu($menu['slug'], $menu['name']);
    }

  }

  /**
   * Register post type
   * @param array $args - 'name': Name of post type
   *                    - 'plural': Plural form of the post type title
   *                    - 'singular': Singular form of the post type title
   *                    - 'slug': Slug used for permalink rewrite
   *                    - 'icon': Name of icon class
   */
  protected function add_post_type( $args ) {

    $defaults = [
      'exclude_from_search' => false,
      'slug' => $args['name'],
      'has_archive' => true,
      'icon' => null,
      'rewrite' => false,
    ];

    $args = array_merge($defaults, $args);

    $labels = [
      'name' => $args['plural'],
      'singular_name' => $args['singular'],
      'menu_name' => $args['plural'],
      'name_admin_bar' => $args['singular'],
      'add_new' => 'Add New',
      'add_new_item' => 'Add New ' . $args['singular'],
      'new_item' => 'New ' . $args['singular'],
      'edit_item' => 'Edit ' . $args['singular'],
      'view_item' => 'View ' . $args['singular'],
      'all_items' => 'All ' . $args['plural'],
      'search_items' => 'Search ' .  $args['plural'],
      'parent_item_colon' => 'Parent ' . $args['plural'] . ':',
      'not_found' => 'No ' . $args['plural'] . ' found.',
      'not_found_in_trash' => 'No ' . $args['plural'] . ' found in Trash.'
    ];

    $post_type = [
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'exclude_from_search' => $args['exclude_from_search'],
      'query_var' => true,
      'rewrite' => $args['rewrite'] ? $args['rewrite'] : array( 'slug' => $args['slug'], 'with_front' => false ),
      'capability_type' => 'post',
      'has_archive' => $args['has_archive'],
      'hierarchical' => false,
      'menu_position' => null,
      'menu_icon' => $args['icon'],
      'supports' => array( 'title', 'editor', 'author', 'thumbnail' )
    ];

    register_post_type( $args['name'], $post_type );

  }

  /**
   * Register taxonomy
   * @param array $args       - 'name': Taxonomy name
   *                          - 'plural': Plural form for title
   *                          - 'singular': Singular form for title
   *                          - 'slug': Slug used for permalink rewrite
   * @param string $post_type Post type associated with this taxonomy
   */
  protected function add_taxonomy( $args, $post_type ) {
    $labels = array(
      'name' => $args['plural'],
      'singular_name' => $args['singular'],
      'search_items' => 'Search ' .  $args['plural'],
      'all_items' => 'All ' .  $args['plural'],
      'parent_item' => 'Parent ' . $args['singular'],
      'parent_item_colon' => 'Parent ' . $args['singular'] . ':',
      'edit_item' => 'Edit ' . $args['singular'],
      'update_item' => 'Update ' . $args['singular'],
      'add_new_item' => 'Add New ' . $args['singular'],
      'new_item_name' => 'New ' . $args['singular'] . ' Name',
      'menu_name' => $args['singular'],
    );

    $tax = array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => $args['rewrite'] ? $args['rewrite'] : array( 'slug' => $args['slug'] ),
    );

    register_taxonomy( $args['name'], $post_type, $tax );
  }

  /**
   * Register support for Gutenberg wide images in your theme
   */
  public function theme_setup() {
    // Gives theme ability to add "full width" and "Wide Width" option to any block. Comment out if your theme's content area can't go full browser width.
    add_theme_support( 'align-wide' );

    // Remove custom color picker
    add_theme_support( 'disable-custom-colors' );

    // Add your color palette here
    add_theme_support(
      'editor-color-palette', [
        [
          'name'  => esc_html__( 'Black', '@@textdomain' ),
          'slug' => 'black',
          'color' => '#2a2a2a',
        ],
        [
          'name'  => esc_html__( 'Gray', '@@textdomain' ),
          'slug' => 'gray',
          'color' => '#727477',
        ]
      ]
    );

  }

  public function mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
  }

  public function mce_button_styles( $init_array ) {
    // Define the style_formats array
    $style_formats = array(
      // Each array child is a format with it's own settings
      array(
        'title' => 'Button',
        'classes' => 'btn',
        'selector' => 'a',
        'wrapper' => false,
      ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

  }

  public function google_maps_api() {
    acf_update_setting('google_api_key', 'AIzaSyAsDtlJoDv1zwFeNIug0ODkhebGKgpxJl0');
  }

  // Create Gutenberg Blocks
  public function blocks_init() {
    // Accordion Block
    $this->register_block([
      'name' => 'accordion',
      'title' => __('Accordion'),
      'description' => __('Text accordion good for FAQ\'s and definitions.'),
      'category' => 'formatting',
      'icon' => 'list-view',
      'keywords' => array( 'faq', 'accordion' ),
    ]);

    // Address Block
    $this->register_block([
      'name' => 'address',
      'title' => __('Address'),
      'description' => __('Physical address.'),
      'category' => 'formatting',
      'icon' => 'location',
      'keywords' => array( 'location', 'address' ),
    ]);
  }

  public function register_block($options) {
    if( !function_exists('acf_register_block') ) {
      return false;
    }

    $slug = $options['name'];

    $options['render_callback'] = array( $this, 'render_block' );

    // Only register if the template file exists
    if (file_exists(get_template_directory() . "/src/views/blocks/$slug/$slug.twig")) {
      return acf_register_block($options);
    } else {
      return false;
    }
  }

  public function render_block( $block ) {

    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);
    $context = Timber::get_context();
    $context['fields'] = get_fields();
    $context['align_style'] = $block['align'] ? $block['align'] : 'none';

    Timber::render( "blocks/$slug/$slug.twig", $context );
  }

  // Add extra image sizes here
  public function register_image_sizes() {
    add_image_size( 'hero', 1440 );
  }

  public function wp_head() {
    $this->favicons();
  }

  private function favicons() { ?>
    <!-- Favicon HTML -->
  <?php }

  public function enqueue_block_editor_assets() {
    $dev_suffix = IS_DEV ? '.dev' : '';

    wp_enqueue_style( 'hb_editor_css', get_template_directory_uri() . "/dist/css/editor$dev_suffix.css", false, filemtime( get_stylesheet_directory() . "/dist/css/editor$dev_suffix.css" ));
  }

  public function enqueue_scripts_styles() {
    $dev_suffix = IS_DEV ? '.dev' : '';

    wp_enqueue_style( 'hb_dev_css', get_template_directory_uri() . "/dist/css/bundle$dev_suffix.css", false, filemtime( get_stylesheet_directory() . "/dist/css/bundle$dev_suffix.css" ));
      wp_enqueue_script( 'hb_dev_js', get_template_directory_uri() . "/dist/js/bundle$dev_suffix.js", false, filemtime( get_stylesheet_directory() . "/dist/js/bundle$dev_suffix.js" ), true);
  }

  // Add variables to templates
  public function add_to_context( $context ) {

    // loop through menus above and pass to template
    foreach ($this->menus as $menu) {
      $context[$menu['slug']] = new Timber\Menu($menu['slug']);
    }

    global $post;

    $context['template_url'] = $this->theme_uri;
    $context['options'] = get_fields('options'); // Get all global options
    if ($post) {
      $context['fields'] = get_fields($post->ID);
    }
    $context['site'] = $this;
    return $context;
  }

  public function svg( $filename ) {
    $file = get_stylesheet_directory() . '/dist/img/' . $filename . '.svg';
    return file_exists($file) ? file_get_contents($file) : false;
  }

  public function srcset( $image ) {
    if ( gettype($image) === 'object' ) {
      return wp_get_attachment_image_srcset($image->ID, 'large');
    }

    // If ID Array items exists and is integer
    if ( is_int($image['ID']) ) {
      return wp_get_attachment_image_srcset($image['ID'], 'large');
    } elseif ( is_int($image) ) {
      return wp_get_attachment_image_srcset($image, 'large');
    }
  }

  public function targetAttr( $target ) {
    if ($target) {
      return 'target="' . $target . '"';
    }
  }

  public function permalink( $id ) {
    return get_permalink($id);
  }

  public function add_to_twig( $twig ) {
    /* this is where you can add your own functions to twig */
    $twig->addExtension( new Twig_Extension_StringLoader() );
    $twig->addFilter( new Twig_SimpleFilter( 'svg', array( $this, 'svg' ) ) );
    $twig->addFilter( new Twig_SimpleFilter( 'srcset', array( $this,
    'srcset' ) ) );
    $twig->addFilter( new Twig_SimpleFilter( 'targetAttr', array( $this, 'targetAttr' ) ) );
    $twig->addFilter( new Twig_SimpleFilter( 'permalink', array( $this, 'permalink' ) ) );
    return $twig;
  }

  public function blocks_editor_enqueue() {
    $dev_suffix = IS_DEV ? '.dev' : '';

    wp_enqueue_script( 'hb_blocks_js', get_template_directory_uri() . "/dist/js/blocks$dev_suffix.js", array( 'wp-blocks', 'wp-i18n', 'wp-element' ), filemtime( get_stylesheet_directory() . "/dist/js/blocks$dev_suffix.js" ), true);

    wp_enqueue_style( 'hb_blocks_editor_css', get_template_directory_uri() . "/dist/css/editor$dev_suffix.css", false, filemtime( get_stylesheet_directory() . "/dist/css/editor$dev_suffix.css" ));
  }
}

new StarterSite();
