<?php

/**
 * SearchWP OptionsView.
 *
 * @package SearchWP
 * @author  Jon Christopher
 */

namespace SearchWP\Admin;

use SearchWP\Utils;
use SearchWP\Settings;
use SearchWP\Statistics;
use SearchWP\Admin\Views\EnginesView;
use SearchWP\Admin\Views\SupportView;
use SearchWP\Admin\Views\SettingsView;
use SearchWP\Admin\Views\AdvancedView;
use SearchWP\Admin\Views\StatisticsView;
use SearchWP\Admin\Views\ExtensionsView;

/**
 * Class OptionsView is responsible for implementing the options screen into the WordPress Admin area.
 *
 * @since 4.0
 */
class OptionsView {

	/**
	 * Slug for this view.
	 *
	 * @since 4.0
     *
	 * @var string
	 */
	private static $slug;

	/**
	 * Extensions registry.
	 *
	 * @since 4.0
     *
	 * @var array
	 */
	private $extensions;

	/**
	 * OptionsView constructor.
	 *
	 * @since 4.0
	 */
	public function __construct() {

		self::$slug = Utils::$slug;

		self::hooks();
		self::option_views();

        // Add Extensions Tab and callbacks.
        // TODO: Extension handling can (should) be its own class.
        $this->init_extensions();

		do_action( 'searchwp\settings\init' );
	}

	/**
	 * Run OptionsView hooks.
	 *
	 * @since 4.2.0
	 */
	private static function hooks() {

		add_action( 'admin_menu', [ __CLASS__, 'legacy_admin_pages_redirect' ] );

		add_action( 'admin_enqueue_scripts', [ __CLASS__, 'assets' ], 999 );
		add_action( 'admin_enqueue_scripts', [ __CLASS__, 'legacy_assets' ] );

		add_action( 'admin_menu', [ __CLASS__, 'add_admin_menus' ] );
		add_action( 'admin_menu', [ __CLASS__, 'add_dashboard_stats_link' ] );

		add_action( 'network_admin_menu', [ __CLASS__, 'add_network_admin_menu' ] );

		add_filter( 'admin_body_class', [ __CLASS__, 'admin_body_class' ] );
		add_action( 'in_admin_header', [ __CLASS__, 'admin_header' ], 100 );
		add_action( 'admin_print_scripts', [ __CLASS__, 'admin_hide_unrelated_notices' ] );
	}

	/**
	 * Init option views.
	 *
	 * @since 4.2.0
	 */
	private static function option_views() {

		// Add internal tabs.
		do_action( 'searchwp\settings\nav\before' );

		if ( apply_filters( 'searchwp\settings\nav\engines', true ) ) {
			new EnginesView();
			do_action( 'searchwp\settings\nav\engines' );
		}

		if ( apply_filters( 'searchwp\settings\nav\settings', true ) ) {
			new SettingsView();
			do_action( 'searchwp\settings\nav\settings' );
		}

		if ( apply_filters( 'searchwp\settings\nav\advanced', true ) ) {
			new AdvancedView();
			do_action( 'searchwp\settings\nav\advanced' );
		}

		if ( apply_filters( 'searchwp\settings\nav\statistics', true ) ) {
			new StatisticsView();
			do_action( 'searchwp\settings\nav\statistics' );
		}

		if ( apply_filters( 'searchwp\settings\nav\support', true ) ) {
			new SupportView();
			do_action( 'searchwp\settings\nav\support' );
		}

		( new ExtensionsView() )->init();

		do_action( 'searchwp\settings\nav\after' );
    }

	/**
	 * Redirects options pages from legacy to updated URLs.
	 *
	 * @since 4.2.1
	 */
	public static function legacy_admin_pages_redirect() {

		global $pagenow;

		if ( $pagenow !== 'options-general.php' ) {
            return;
        }

		if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'searchwp' ) {
            return;
		}

        $url_query = wp_parse_url( $_SERVER['REQUEST_URI'], PHP_URL_QUERY ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput

		wp_safe_redirect( add_query_arg( [ 'page' => 'searchwp-settings' ], admin_url( 'admin.php?' . $url_query ) ), 301 );
		exit;
	}

	/**
	 * Enqueue the assets related to the OptionsView.
	 *
	 * @since 4.0
	 */
	public static function assets() {

		if ( ! Utils::is_swp_admin_page() ) {
			return;
		}

		wp_enqueue_style(
			self::$slug . '_admin_settings',
			SEARCHWP_PLUGIN_URL . 'assets/styles/settings.css',
			false,
			SEARCHWP_VERSION
		);

		wp_enqueue_script( 'jquery' );
	}

	/**
     * Enqueue legacy assets from a previous version of the settings screen.
     *
	 * @param string $hook_suffix The current admin page.
     *
     * @since 4.2.0
	 *
	 * @return void
	 */
    public static function legacy_assets( $hook_suffix ) {

	    if ( $hook_suffix === 'toplevel_page_searchwp-settings' ) {
		    do_action( 'admin_enqueue_scripts', 'settings_page_searchwp' );
	    }
    }

	/**
	 * Add SearchWP admin menus.
	 *
	 * @since 4.2.0
	 */
	public static function add_admin_menus() {

		if ( ! apply_filters( 'searchwp\options\settings_screen', true ) ) {
			return;
		}

		if ( ! current_user_can( Settings::get_capability() ) ) {
			return;
		}

		$submenu_pages = self::get_submenu_pages_args();

		$page_title = esc_html__( 'SearchWP', 'searchwp' );
        $menu_page  = reset( $submenu_pages );

		// Default SearchWP top level menu item.
		add_menu_page(
			$page_title,
			$page_title,
			Settings::get_capability(),
			$menu_page['menu_slug'],
			[ __CLASS__, 'page' ],
			'data:image/svg+xml;base64,' . base64_encode( self::get_dashicon() ),
			apply_filters( 'searchwp\admin_menu\position', '58.9' )
		);

        foreach ( $submenu_pages as $submenu_page ) {
	        add_submenu_page(
		        $menu_page['menu_slug'],
		        $submenu_page['page_title'] ?? $page_title,
		        $submenu_page['menu_title'],
		        $submenu_page['capability'] ?? Settings::get_capability(),
		        $submenu_page['menu_slug'],
		        $submenu_page['function'] ?? [ __CLASS__, 'page' ]
	        );
        }
	}

	/**
	 * Get SearchWP dashicon SVG.
	 *
	 * @since 4.2.0
	 */
	private static function get_dashicon() {

		return '<svg width="50" height="61" fill="#f0f0f1" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M9.57 13.259c-.959 0-1.782.68-1.946 1.625-.527 3.033-1.59 9.715-1.702 14.875-.114 5.288 1.134 13.417 1.712 16.864.16.952.984 1.636 1.95 1.636h30.683c.959 0 1.78-.675 1.945-1.619.584-3.339 1.823-11.12 1.71-16.381-.112-5.195-1.194-12.217-1.72-15.36a1.969 1.969 0 0 0-1.95-1.64zm2.728 5a.99.99 0 0 0-.986.873c-.237 2.012-.797 7.111-.89 11.127-.096 4.116.94 10.066 1.34 12.2.089.468.497.8.972.8h24.368a.983.983 0 0 0 .972-.799c.403-2.133 1.443-8.084 1.348-12.201-.094-4.016-.658-9.117-.897-11.128a.99.99 0 0 0-.987-.872z"/>
                  <path d="M34.564 36.765c.55-3.195.858-6.711.858-10.408a65.76 65.76 0 0 0-.09-3.416l-8.852 6.777zM24.92 31.013l-9.2 8.017a41.23 41.23 0 0 0 1.272 4.579c.978 2.835 2.141 3.732 3.34 4.021.636.154 1.327.149 2.105.096.215-.015.439-.034.668-.053.58-.048 1.198-.1 1.817-.1s1.237.052 1.816.1c.23.019.454.038.668.053.778.053 1.47.058 2.106-.096 1.198-.29 2.361-1.186 3.34-4.021.484-1.406.91-2.94 1.269-4.577zM23.363 29.716l-8.851-6.777c-.059 1.119-.09 2.259-.09 3.418 0 3.696.305 7.212.855 10.406zM31.53 11.759c-.405.004-.814.04-1.194.082l-.44.05c-.323.04-.623.076-.834.083a54.57 54.57 0 0 0-3.566.22l-.121.012a5.617 5.617 0 0 1-.453.031 1.34 1.34 0 0 1-.317-.05l-.213-.057-.117-.033a9.308 9.308 0 0 0-.97-.215c-.796-.13-1.91-.192-3.329.084-.312.06-.743.04-1.136.023l-.037-.002h-.008c-.434-.018-.886-.038-1.317-.005-.436.032-.8.117-1.072.273-.25.145-.438.36-.525.728-.548 2.32-.954 4.87-1.198 7.569l10.24 7.838 10.237-7.838c-.244-2.7-.65-5.248-1.197-7.569a1.311 1.311 0 0 0-.678-.902c-.351-.193-.818-.288-1.353-.314a6.888 6.888 0 0 0-.403-.008z"/>
                  <path d="M15.732 43.242h18.38a1.5 1.5 0 0 1 1.492 1.35l.6 6a1.5 1.5 0 0 1-1.492 1.65h-19.58a1.5 1.5 0 0 1-1.493-1.65l.6-6a1.5 1.5 0 0 1 1.493-1.35z"/>
                  <path d="M19.918 3.26c-1.087 0-2 .913-2 2v8.5a1.5 1.5 0 0 0 1.5 1.5h11a1.5 1.5 0 0 0 1.5-1.5v-8.5c0-1.087-.913-2-2-2zm1 3h8v6h-8z"/>
                  <path d="M17.918 8.759h14a1.5 1.5 0 0 1 1.5 1.5v4.5h-17v-4.5a1.5 1.5 0 0 1 1.5-1.5z"/>
                  <path d="M14.918 11.759h20a1.5 1.5 0 0 1 1.5 1.5v4.5h-23v-4.5a1.5 1.5 0 0 1 1.5-1.5zM11.43 50.759h26.983a1.5 1.5 0 0 1 1.442 1.088l.858 3a1.5 1.5 0 0 1-1.443 1.912H10.573a1.5 1.5 0 0 1-1.442-1.912l.857-3a1.5 1.5 0 0 1 1.442-1.088z"/>
                </svg>';
	}

	/**
     * Get arguments to populate the submenus.
     * Items are sorted by the 'position' value.
     *
     * @since 4.2.0
     *
	 * @return array
	 */
    private static function get_submenu_pages_args() {

	    $submenu_pages = [
		    'settings'   => [
			    'menu_title' => esc_html__( 'Settings', 'searchwp' ),
			    'menu_slug'  => 'searchwp-settings',
			    'position'   => 10,
		    ],
		    'statistics' => [
			    'menu_title' => esc_html__( 'Statistics', 'searchwp' ),
			    'menu_slug'  => 'searchwp-statistics',
			    'position'   => 20,
		    ],
		    'extensions' => [
			    'menu_title' => '<span style="color:#ff6b6b">' . esc_html__( 'Extensions', 'searchwp' ) . '</span>',
			    'menu_slug'  => 'searchwp-extensions',
			    'position'   => 30,
		    ],
	    ];

	    $submenu_pages = (array) apply_filters( 'searchwp\options\submenu_pages', $submenu_pages );

	    uasort(
		    $submenu_pages,
		    function ( $a, $b ) {
			    if ( ! isset( $a['position'] ) ) {
				    return 1;
			    }
			    if ( ! isset( $b['position'] ) ) {
				    return -1;
			    }

			    return ( $a['position'] < $b['position'] ) ? -1 : 1;
		    }
	    );

        return $submenu_pages;
    }

	/**
	 * Add Search Stats dashboard link.
	 *
	 * @since 4.2.0
	 */
	public static function add_dashboard_stats_link() {

		$user_can = current_user_can( Settings::get_capability() ) ||
		            current_user_can( Statistics::get_capability() );

		if ( ! apply_filters( 'searchwp\options\dashboard_stats_link', $user_can ) ) {
			return;
		}

		if ( current_user_can( Settings::get_capability() ) ) {
			self::add_stats_dashboard_page_options_redirect();

			return;
		}

		self::add_stats_dashboard_page_standalone();
	}

	/**
	 * Add Search Stats dashboard page and redirect it to Statistics page in plugin options menu.
	 *
	 * @since 4.2.0
	 */
	private static function add_stats_dashboard_page_options_redirect() {

		global $submenu;

		add_dashboard_page(
			__( 'Search Statistics', 'searchwp' ),
			__( 'Search Stats', 'searchwp' ),
			Statistics::get_capability(),
			self::$slug . '-stats'
		);

		if ( ! is_array( $submenu ) || ! array_key_exists( 'index.php', $submenu ) ) {
			return;
		}

		// Override the link for the Search Stats Admin Menu entry.
		foreach ( $submenu['index.php'] as $index => $dashboard_submenu ) {
			if ( $dashboard_submenu[2] !== 'searchwp-stats' ) {
				continue;
			}

			$submenu['index.php'][ $index ][2] = esc_url_raw( add_query_arg( [
				'page' => 'searchwp-statistics',
			], admin_url( 'admin.php' ) ) );

			break;
		}
	}

	/**
	 * Add Search Stats dashboard standalone page.
	 *
	 * @since 4.2.0
	 */
	private static function add_stats_dashboard_page_standalone() {

		$callback = static function() {
			wp_enqueue_style(
				self::$slug . '_admin_settings',
				SEARCHWP_PLUGIN_URL . 'assets/styles/settings.css',
				false,
				SEARCHWP_VERSION
			);

			wp_enqueue_script( 'jquery' );
			?>
            <div class="searchwp-admin-wrap wrap">
                <div class="searchwp-settings-view">
                    <?php
                    do_action( 'searchwp\settings\view' );
                    do_action( 'searchwp\settings\after' );
                    ?>
                </div>
            </div>
			<?php
		};

		// Current user can view Statistics but not Settings.
		add_dashboard_page(
			__( 'Search Statistics', 'searchwp' ),
			__( 'Search Stats', 'searchwp' ),
			Statistics::get_capability(),
			self::$slug . '-stats',
			$callback
		);
	}

	/**
	 * Adds SearchWP network admin menu.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
	public static function add_network_admin_menu() {

		$callback = static function() {
			do_action( 'searchwp\debug\log', 'Displaying network options page', 'settings' );
			?>
            <div class="wrap">
                <div style="max-width: 60em;">
                    <h1>SearchWP</h1>
					<?php
					echo wp_kses(
						__( '<p>Cross-site searches are possible in SearchWP. Any Engine from any site can be used for a cross-site search.</p><p><strong>Note</strong>: SearchWP\'s Engines control what is indexed on each sub-site. If the Engine you are using to perform the search has different Sources/Attributes/Rules than the Engine(s) on the sub-sites you are searching the <em>results may not be accurate</em>.</p><p>For example: if Posts have been added to the Engine you are using for the search, but a sub-site does not have an Engine with Posts enabled, <strong>that sub-site will not return Posts</strong>.</p><p>For a comprehensive cross-site search, ensure that <em>all sites</em> share a similar configuration and applicable Engine.</p><p><a href="https://searchwp.com/?p=288269" target="_blank">More information</a></p>', 'searchwp' ),
						[
							'p'      => [],
							'strong' => [],
							'em'     => [],
							'a'      => [
								'href'   => [],
								'target' => [],
							],
						]
					);
					?>
                </div>
            </div>
			<?php
		};

		add_menu_page(
			'SearchWP',
			'SearchWP',
			Settings::get_capability(),
			self::$slug,
			$callback,
			'data:image/svg+xml;base64,' . base64_encode( self::get_dashicon() )
		);
	}

	/**
	 * Add body class to SearchWP admin pages for easy reference.
	 *
	 * @since 4.2.0
	 *
	 * @param string $classes CSS classes, space separated.
	 *
	 * @return string
	 */
	public static function admin_body_class( $classes ) {

		if ( ! Utils::is_swp_admin_page() ) {
			return $classes;
		}

		return "$classes searchwp-admin-page";
	}

	/**
	 * Output the SearchWP admin header.
	 *
	 * @since 4.2.0
	 */
	public static function admin_header() {

		// Bail if we're not on a SearchWP screen or page.
		if ( ! Utils::is_swp_admin_page() ) {
			return;
		}

		if ( ! apply_filters( 'searchwp\settings\header', true ) ) {
			return;
		}

		self::header();
	}

	/**
	 * Remove non-SearchWP notices from SearchWP pages.
	 *
	 * @since 4.2.0
	 */
	public static function admin_hide_unrelated_notices() {

		if ( ! Utils::is_swp_admin_page() ) {
			return;
		}

		global $wp_filter;

		// Define rules to remove callbacks.
		$rules = [
			'user_admin_notices' => [], // remove all callbacks.
			'admin_notices'      => [],
			'all_admin_notices'  => [],
			'admin_footer'       => [
				'render_delayed_admin_notices', // remove this particular callback.
			],
		];

		$notice_types = array_keys( $rules );

		foreach ( $notice_types as $notice_type ) {
			if ( empty( $wp_filter[ $notice_type ]->callbacks ) || ! is_array( $wp_filter[ $notice_type ]->callbacks ) ) {
				continue;
			}

			$remove_all_filters = empty( $rules[ $notice_type ] );

			foreach ( $wp_filter[ $notice_type ]->callbacks as $priority => $hooks ) {
				foreach ( $hooks as $name => $arr ) {
					if ( is_object( $arr['function'] ) && is_callable( $arr['function'] ) ) {
						if ( $remove_all_filters ) {
							unset( $wp_filter[ $notice_type ]->callbacks[ $priority ][ $name ] );
						}
						continue;
					}

                    $class = '';
                    if ( ! empty( $arr['function'][0] ) && is_object( $arr['function'][0] ) ) {
                        $class = strtolower( get_class( $arr['function'][0] ) );
                    }
					if ( ! empty( $arr['function'][0] ) && is_string( $arr['function'][0] ) ) {
						$class = strtolower( $arr['function'][0] );
					}

					// Remove all callbacks except SearchWP notices.
					if ( $remove_all_filters && strpos( $class, 'searchwp' ) === false ) {
						unset( $wp_filter[ $notice_type ]->callbacks[ $priority ][ $name ] );
						continue;
					}

					$cb = is_array( $arr['function'] ) ? $arr['function'][1] : $arr['function'];

					// Remove a specific callback.
					if ( ! $remove_all_filters && in_array( $cb, $rules[ $notice_type ], true ) ) {
                        unset( $wp_filter[ $notice_type ]->callbacks[ $priority ][ $name ] );
                    }
				}
			}
		}
	}

	/**
	 * Renders the page.
	 *
	 * @since 4.2.0
	 */
	public static function page() {

		do_action( 'searchwp\settings\page' );
		do_action( 'searchwp\debug\log', 'Displaying options page', 'settings' );
		?>
        <div class="searchwp-admin-wrap wrap">
            <div class="searchwp-settings-view">
                <?php
                self::view();
                ?>
            </div>
            <?php self::footer(); ?>
        </div>
		<?php
	}

	/**
	 * Renders the header.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
    private static function header() {

        do_action( 'searchwp\settings\header\before' );

        ?>
        <div class="searchwp-settings-header">
            <p class="searchwp-logo" title="SearchWP">
                <svg width="258" height="54" viewBox="0 0 258 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="searchwp-logo-path-1" fill="white">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.64822 10C3.68926 10 2.8667 10.6802 2.70237 11.625C2.17483 14.6579 1.1113 21.3405 0.999997 26.5C0.885929 31.7877 2.13398 39.917 2.71185 43.3644C2.87135 44.316 3.69656 45 4.6614 45H35.3455C36.3038 45 37.1251 44.3254 37.2902 43.3814C37.8738 40.042 39.1135 32.2614 39 27C38.8879 21.8054 37.8063 14.783 37.2804 11.6397C37.1211 10.6876 36.2951 10 35.3298 10H4.64822ZM7.37673 15C6.87334 15 6.44909 15.3729 6.39019 15.8728C6.15313 17.885 5.59328 22.9843 5.49997 27C5.40432 31.1165 6.43975 37.0664 6.84114 39.2007C6.92896 39.6676 7.33744 40 7.81258 40H32.1806C32.6554 40 33.0637 39.6681 33.1518 39.2015C33.555 37.068 34.5957 31.117 34.5 27C34.4067 22.9836 33.8419 17.883 33.6028 15.8717C33.5435 15.3722 33.1195 15 32.6165 15H7.37673Z"></path>
                    </mask>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.64822 10C3.68926 10 2.8667 10.6802 2.70237 11.625C2.17483 14.6579 1.1113 21.3405 0.999997 26.5C0.885929 31.7877 2.13398 39.917 2.71185 43.3644C2.87135 44.316 3.69656 45 4.6614 45H35.3455C36.3038 45 37.1251 44.3254 37.2902 43.3814C37.8738 40.042 39.1135 32.2614 39 27C38.8879 21.8054 37.8063 14.783 37.2804 11.6397C37.1211 10.6876 36.2951 10 35.3298 10H4.64822ZM7.37673 15C6.87334 15 6.44909 15.3729 6.39019 15.8728C6.15313 17.885 5.59328 22.9843 5.49997 27C5.40432 31.1165 6.43975 37.0664 6.84114 39.2007C6.92896 39.6676 7.33744 40 7.81258 40H32.1806C32.6554 40 33.0637 39.6681 33.1518 39.2015C33.555 37.068 34.5957 31.117 34.5 27C34.4067 22.9836 33.8419 17.883 33.6028 15.8717C33.5435 15.3722 33.1195 15 32.6165 15H7.37673Z" fill="#BFCDC2"></path>
                    <path d="M2.70237 11.625L3.68758 11.7963L3.68758 11.7963L2.70237 11.625ZM0.999997 26.5L1.99976 26.5216L0.999997 26.5ZM2.71185 43.3644L1.72561 43.5297L1.72561 43.5297L2.71185 43.3644ZM37.2902 43.3814L36.3051 43.2092L36.3051 43.2092L37.2902 43.3814ZM39 27L39.9998 26.9784L39.9998 26.9784L39 27ZM37.2804 11.6397L38.2667 11.4747L38.2667 11.4747L37.2804 11.6397ZM6.39019 15.8728L7.38332 15.9898L7.38332 15.9898L6.39019 15.8728ZM5.49997 27L4.50024 26.9768L4.50024 26.9768L5.49997 27ZM6.84114 39.2007L5.85837 39.3855L5.85837 39.3855L6.84114 39.2007ZM33.1518 39.2015L34.1344 39.3872L34.1344 39.3872L33.1518 39.2015ZM34.5 27L33.5003 27.0232L33.5003 27.0232L34.5 27ZM33.6028 15.8717L34.5959 15.7537L34.5959 15.7537L33.6028 15.8717ZM3.68758 11.7963C3.76712 11.339 4.16678 11 4.64822 11V9C3.21174 9 1.96627 10.0214 1.71716 11.4536L3.68758 11.7963ZM1.99976 26.5216C2.10928 21.445 3.16018 14.8285 3.68758 11.7963L1.71716 11.4536C1.18949 14.4874 0.113321 21.236 0.000229326 26.4784L1.99976 26.5216ZM3.69809 43.1991C3.11803 39.7386 1.88804 31.7004 1.99976 26.5216L0.000229326 26.4784C-0.116187 31.875 1.14994 40.0954 1.72561 43.5297L3.69809 43.1991ZM4.6614 44C4.17442 44 3.7751 43.6585 3.69809 43.1991L1.72561 43.5297C1.96761 44.9735 3.2187 46 4.6614 46V44ZM35.3455 44H4.6614V46H35.3455V44ZM36.3051 43.2092C36.2257 43.6632 35.8296 44 35.3455 44V46C36.778 46 38.0246 44.9875 38.2752 43.5535L36.3051 43.2092ZM38.0002 27.0216C38.1113 32.1712 36.8906 39.8593 36.3051 43.2092L38.2752 43.5535C38.8571 40.2247 40.1157 32.3516 39.9998 26.9784L38.0002 27.0216ZM36.2941 11.8047C36.8203 14.9499 37.8899 21.9075 38.0002 27.0216L39.9998 26.9784C39.886 21.7034 38.7923 14.6161 38.2667 11.4747L36.2941 11.8047ZM35.3298 11C35.8151 11 36.2169 11.343 36.2941 11.8047L38.2667 11.4747C38.0254 10.0322 36.7751 9 35.3298 9V11ZM4.64822 11H35.3298V9H4.64822V11ZM7.38332 15.9898C7.38336 15.9896 7.3833 15.9902 7.38294 15.9913C7.38259 15.9924 7.3821 15.9936 7.38151 15.9947C7.38035 15.9969 7.37924 15.998 7.37868 15.9985C7.37814 15.999 7.37752 15.9994 7.3767 15.9997C7.37546 16.0002 7.37504 16 7.37673 16V14C6.3724 14 5.516 14.7463 5.39706 15.7558L7.38332 15.9898ZM6.4997 27.0232C6.59182 23.059 7.14639 18.0009 7.38332 15.9898L5.39706 15.7558C5.15987 17.7691 4.59475 22.9096 4.50024 26.9768L6.4997 27.0232ZM7.82391 39.0158C7.4205 36.8708 6.40684 31.0197 6.4997 27.0232L4.50024 26.9768C4.4018 31.2132 5.45901 37.262 5.85837 39.3855L7.82391 39.0158ZM7.81258 39C7.81089 39 7.81113 38.9998 7.81236 39.0002C7.81328 39.0006 7.81444 39.0011 7.81575 39.0022C7.81709 39.0033 7.81896 39.0052 7.82076 39.0082C7.82278 39.0116 7.82369 39.0147 7.82391 39.0158L5.85837 39.3855C6.03687 40.3346 6.8661 41 7.81258 41V39ZM32.1806 39H7.81258V41H32.1806V39ZM32.1692 39.0158C32.1694 39.0146 32.1704 39.0116 32.1724 39.0082C32.1742 39.0052 32.176 39.0033 32.1774 39.0022C32.1787 39.0012 32.1798 39.0006 32.1808 39.0002C32.182 38.9998 32.1823 39 32.1806 39V41C33.1264 41 33.9552 40.3355 34.1344 39.3872L32.1692 39.0158ZM33.5003 27.0232C33.5931 31.0198 32.5744 36.8715 32.1692 39.0158L34.1344 39.3872C34.5356 37.2645 35.5982 31.2143 35.4997 26.9768L33.5003 27.0232ZM32.6098 15.9897C32.8487 17.9999 33.4081 23.0588 33.5003 27.0232L35.4997 26.9768C35.4052 22.9083 34.835 17.7661 34.5959 15.7537L32.6098 15.9897ZM32.6165 16C32.6182 16 32.6178 16.0002 32.6166 15.9997C32.6157 15.9994 32.6151 15.999 32.6145 15.9985C32.614 15.998 32.6128 15.9968 32.6117 15.9946C32.6111 15.9935 32.6106 15.9923 32.6102 15.9912C32.6099 15.99 32.6098 15.9895 32.6098 15.9897L34.5959 15.7537C34.476 14.745 33.6199 14 32.6165 14V16ZM7.37673 16H32.6165V14H7.37673V16Z" fill="#839788" mask="url(#searchwp-logo-path-1)"></path>
                    <path d="M9.5 23.0986C9.5 18.2201 10.032 13.6522 10.9582 9.72544C11.0451 9.35737 11.2336 9.14094 11.4843 8.99615C11.7552 8.8397 12.1209 8.75586 12.5574 8.72296C12.9882 8.69049 13.4395 8.71017 13.8729 8.72906L13.8812 8.72942C13.8932 8.72995 13.9052 8.73047 13.9173 8.731C14.3109 8.74823 14.7412 8.76706 15.0539 8.70618C16.4728 8.42987 17.5874 8.49381 18.3833 8.62349C18.7824 8.68852 19.1049 8.77064 19.3539 8.83829C19.3934 8.84901 19.4329 8.85991 19.4714 8.87053C19.5491 8.89195 19.6227 8.91224 19.6834 8.92769C19.7612 8.94749 19.8849 8.97812 20 8.97812C20.1096 8.97812 20.2685 8.96387 20.453 8.94662C20.4915 8.94303 20.5321 8.93919 20.575 8.93513C20.7508 8.91852 20.9652 8.89826 21.2272 8.87626C21.8772 8.82167 22.8189 8.75654 24.1406 8.71516C24.3511 8.70857 24.6513 8.67218 24.9751 8.63295C25.1189 8.61552 25.2675 8.59752 25.4148 8.58133C25.9221 8.52557 26.4788 8.48166 27.0095 8.50767C27.5452 8.53392 28.0123 8.62995 28.3633 8.8228C28.6944 9.00471 28.9364 9.27866 29.0418 9.72544C29.968 13.6522 30.5 18.2201 30.5 23.0986C30.5 29.6909 29.5287 35.7116 27.9288 40.349C26.9506 43.1844 25.7887 44.0814 24.5899 44.3709C23.9542 44.5245 23.2621 44.5193 22.484 44.4665C22.2698 44.4519 22.0467 44.4334 21.8173 44.4144C21.2383 44.3665 20.619 44.3152 20 44.3152C19.381 44.3152 18.7617 44.3665 18.1827 44.4144C17.9533 44.4334 17.7302 44.4519 17.516 44.4665C16.7379 44.5193 16.0458 44.5245 15.4101 44.3709C14.2113 44.0814 13.0494 43.1844 12.0712 40.349C10.4713 35.7116 9.5 29.6909 9.5 23.0986Z" fill="white" stroke="#839788"></path>
                    <path d="M10.81 39.5H29.19C29.9607 39.5 30.6059 40.0839 30.6826 40.8507L31.2826 46.8507C31.3709 47.7338 30.6775 48.5 29.79 48.5H10.21C9.32254 48.5 8.62912 47.7338 8.71742 46.8507L9.31742 40.8507C9.3941 40.0839 10.0393 39.5 10.81 39.5Z" fill="#BFCDC2" stroke="#839788"></path>
                    <path d="M14.9962 1.5H24.9962C25.2723 1.5 25.4962 1.72386 25.4962 2V10.5H14.4962V2C14.4962 1.72386 14.72 1.5 14.9962 1.5Z" stroke="#839788" stroke-width="3" stroke-linejoin="round"></path>
                    <path d="M12.9962 5.5H26.9962C27.8246 5.5 28.4962 6.17157 28.4962 7V11.5H11.4962V7C11.4962 6.17157 12.1677 5.5 12.9962 5.5Z" fill="#BFCDC2" stroke="#839788"></path>
                    <path d="M9.99615 8.5H29.9962C30.8246 8.5 31.4962 9.17157 31.4962 10V14.5H8.49615V10C8.49615 9.17157 9.16773 8.5 9.99615 8.5Z" fill="#BFCDC2" stroke="#839788"></path>
                    <path d="M6.5086 47.5H33.4914C34.1611 47.5 34.7497 47.944 34.9337 48.5879L35.7908 51.5879C36.0646 52.5461 35.3451 53.5 34.3485 53.5H5.65146C4.65489 53.5 3.9354 52.5461 4.20917 51.5879L5.06632 48.5879C5.2503 47.944 5.83888 47.5 6.5086 47.5Z" fill="#BFCDC2" stroke="#839788"></path>
                    <path d="M9.24164 35.8023L20.3256 26.1427L31.5967 17.5118" stroke="#839788" stroke-width="2"></path>
                    <path d="M30.6903 35.7466L19.6433 26.1174L8.39868 17.508" stroke="#839788" stroke-width="2"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M57.3987 34.9305C57.7699 40.9716 60.4093 44.7017 70.0595 44.7017C74.4722 44.7017 81.6067 43.9313 81.6067 35.7414C81.6067 29.9436 78.06 28.3218 73.8536 27.2271L67.2551 25.4837C65.523 25.0377 64.2446 24.4296 64.2446 22.3213C64.2446 20.0102 65.8117 19.4426 68.9047 19.4426C74.1835 19.4426 74.3072 21.0644 74.5959 23.497H80.6994C80.5757 18.3074 77.8538 14.334 69.1522 14.334C59.9969 14.334 58.0586 18.7128 58.0586 22.8889C58.0586 28.2002 61.2341 29.903 64.822 30.8355L71.9978 32.7411C74.5959 33.4304 75.4207 34.4034 75.4207 36.1874C75.4207 39.1471 73.1525 39.5931 70.0595 39.5931C64.2034 39.5931 63.7497 37.9713 63.5023 34.9305H57.3987ZM98.7626 37.9308C98.1852 39.5525 96.8656 39.958 94.6798 39.958C91.4631 39.958 90.4321 38.9849 90.2259 34.9305H104.866C104.866 25.6459 102.598 22.1591 94.9685 22.1591C85.9782 22.1591 84.3285 27.0244 84.3285 33.1466C84.3285 42.3096 87.9989 44.58 94.7211 44.58C100.618 44.58 103.918 42.8366 104.619 37.9308H98.7626ZM90.2671 31.3626C90.4733 27.9164 91.3394 26.7811 94.6798 26.7811C97.3192 26.7811 98.8863 27.4704 99.1338 31.3626H90.2671ZM113.568 29.1732C113.856 27.3487 114.434 26.7 117.279 26.7C119.96 26.7 120.991 27.2676 120.991 29.2543V30.5517L113.815 31.6464C110.64 32.133 107.506 33.9169 107.506 38.6606C107.506 42.3096 109.361 44.58 114.558 44.58C118.022 44.58 120.125 43.5664 121.238 42.4312V44.0529H126.723V28.4029C126.723 23.7403 123.548 22.1591 117.527 22.1591C111.671 22.1591 108.454 23.6592 108.165 29.1732H113.568ZM120.991 35.9036C120.991 38.5389 120.125 40.404 116.62 40.404C114.063 40.404 113.238 39.512 113.238 37.8902C113.238 35.6198 114.805 35.1738 116.991 34.8494L120.991 34.2007V35.9036ZM137.528 44.0529V36.1468C137.528 31.2815 137.941 27.6325 142.477 27.6325C143.632 27.6325 144.292 27.7542 144.292 27.7542V22.3618C144.292 22.3618 143.838 22.2402 142.807 22.2402C139.961 22.2402 138.518 23.1321 137.198 25.3621V22.6862H131.796V44.0529H137.528ZM166.809 29.903C166.231 24.6728 163.551 22.1591 157.282 22.1591C148.746 22.1591 146.684 26.7811 146.684 33.5925C146.684 39.7958 148.374 44.58 156.994 44.58C164.169 44.58 166.355 41.2554 166.809 36.4712H161.076C160.911 38.62 159.839 39.958 156.705 39.958C153.901 39.958 152.581 38.9038 152.581 33.3898C152.581 27.8758 153.901 26.7811 156.994 26.7811C159.922 26.7811 160.623 27.8353 161.076 29.903H166.768H166.809ZM176.541 14.9828H170.809V44.0529H176.541V32.3357C176.541 28.2813 177.325 26.7811 181.119 26.7811C184.79 26.7811 184.79 28.1596 184.79 33.0249V44.0529H190.522V32.0113C190.522 25.2404 189.202 22.1591 182.728 22.1591C180.501 22.1591 177.902 22.524 176.541 24.6323V14.9828ZM208.09 44.0529L212.75 22.9294L217.369 44.0529H223.844C227.184 34.3629 229.865 24.6728 231.762 14.9828H225.576C224.545 21.9564 222.937 28.93 220.833 35.9036L216.132 14.9828H209.41L204.873 35.7819C202.853 28.8489 201.286 21.9158 200.172 14.9828H193.739C195.636 24.6728 198.316 34.3629 201.657 44.0529H208.09ZM235.309 44.0529H241.412V33.4304H247.145C253.001 33.4304 257.991 32.3357 257.991 24.1052C257.991 15.5504 252.63 14.9828 246.485 14.9828H235.309V44.0529ZM245.619 19.9697C250.732 19.9697 251.805 20.5779 251.805 23.8619C251.805 27.9569 250.155 28.4434 245.248 28.4434H241.412V19.9697H245.619Z" fill="#839788"></path>
                </svg>
            </p>
        </div>
        <div class="searchwp-settings-subheader">
            <?php if ( has_action( 'searchwp\settings\nav\tab' ) ) : ?>
                <nav class="searchwp-settings-header-nav">
                    <ul>
                        <?php do_action( 'searchwp\settings\nav\tab' ); ?>
                    </ul>
                </nav>
            <?php else : ?>
	            <?php do_action( 'searchwp\settings\page\title' ); ?>
            <?php endif; ?>
        </div>

        <hr class="wp-header-end">
        <?php

		do_action( 'searchwp\settings\header\after' );
    }

    public static function header_navigation_menu() {

    }

	/**
	 * Renders the main view.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
	private static function view() {

		$view = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'default';

		// TODO: Deprecate `'searchwp\settings\...\\' . $view` actions after updating all the dependent code.

		do_action( 'searchwp\settings\before' );
		do_action( 'searchwp\settings\before\\' . $view );

		do_action( 'searchwp\settings\view' );
		do_action( 'searchwp\settings\view\\' . $view );

		do_action( 'searchwp\settings\after' );
		do_action( 'searchwp\settings\after\\' . $view );
	}

	/**
	 * Renders the footer.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
	private static function footer() {
		do_action( 'searchwp\settings\footer' );
	}

	/**
	 * Initialize all registered Extensions.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
	private function init_extensions() {

		if ( ! Utils::is_swp_admin_page( 'settings' ) ) {
            return;
        }

		$this->prime_extensions();

		$extensions = array_filter( (array) $this->extensions, function( $extension ) {
			return ! empty( $extension->public );
		} );

		if ( ! empty( $extensions ) ) {
			new NavTab([
				'tab'   => 'extensions',
				'label' => __( 'Extensions', 'searchwp' ),
				'icon'  => 'dashicons dashicons-arrow-down',
			]);
		}

		add_action( 'searchwp\settings\view\extensions', [ $this, 'render_extension_view' ] );
		add_action( 'searchwp\settings\footer',          [ $this, 'render_extensions_dropdown' ] );
	}

	/**
	 * Prime and prepare registered Extensions.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
	private function prime_extensions() {

		$extensions = apply_filters( 'searchwp\extensions', [] );

		if ( ! is_array( $extensions ) || empty( $extensions ) ) {
			return;
		}

		foreach ( $extensions as $extension => $path ) {
			$class_name = 'SearchWP' . $extension;

			if ( ! class_exists( $class_name ) && file_exists( $path ) ) {
				include_once $path;
			}

			$this->extensions[ $extension ] = new $class_name( $this->extensions );

			// Add plugin row action.
			if ( isset( $this->extensions[ $extension ]->min_searchwp_version )
			     && version_compare( SEARCHWP_VERSION, $this->extensions[ $extension ]->min_searchwp_version, '<' ) ) {
				do_action( 'searchwp\debug\log', 'after_plugin_row_' . plugin_basename( $path ) );
				add_action( 'after_plugin_row_' . plugin_basename( $path ), [ $this, 'plugin_row' ], 11, 3 );
			}
		}
	}

	/**
	 * Renders the Extensions dropdown on the Options screen.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
	public function render_extensions_dropdown() {

		$extensions = array_filter( (array) $this->extensions, function( $extension ) {
			return ! empty( $extension->public );
		} );

		if ( empty( $extensions ) ) {
			return;
		}

		?>
		<div id="searchwp-extensions-dropdown">
			<ul class="swp-dropdown-menu">
				<?php foreach ( $extensions as $extension ) : ?>
					<?php if ( ! empty( $extension->public ) && isset( $extension->slug ) && isset( $extension->name ) ) : ?>
						<?php
						$the_link = add_query_arg(
							[
								'page'      => 'searchwp-settings',
								'tab'       => 'extensions',
								'extension' => $extension->slug,
							],
							admin_url( 'admin.php' )
						);
						?>
						<li><a href="<?php echo esc_url( $the_link ); ?>"><?php echo esc_html( $extension->name ); ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.searchwp-settings-nav-tab-extensions').after($('#searchwp-extensions-dropdown').clone());
		});
			jQuery(document).ready(function($){
				var $extensions_toggler = $('.searchwp-settings-nav-tab-extensions');
				var $extensions_dropdown = $('#searchwp-extensions-dropdown');

				$extensions_dropdown.hide();
				$extensions_toggler.data('showing',false);

				// Bind the click.
				$extensions_toggler.click(function(e){
					e.preventDefault();
					if ($extensions_toggler.data('showing')){
						$extensions_dropdown.hide();
						$extensions_toggler.data('showing',false);
						$extensions_toggler.removeClass('searchwp-showing-dropdown');
						$extensions_dropdown.removeClass('searchwp-sub-menu-active');
					} else {
						if ($extensions_toggler.hasClass('nav-tab-active')) {
							$extensions_dropdown.addClass('searchwp-sub-menu-active');
						} else {
							$extensions_dropdown.removeClass('searchwp-sub-menu-active');
						}
						$extensions_dropdown.show();
						$extensions_toggler.data('showing',true);
						$extensions_toggler.addClass('searchwp-showing-dropdown');
					}
				});
			});
		</script>
		<?php
	}

	/**
	 * Renders the view for an Extension.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
	public function render_extension_view() {

		if ( empty( $this->extensions ) || ! isset( $_GET['extension'] ) ) {
			return;
		}

		// Find out which extension we're working with.
		$extension = array_filter( $this->extensions, function( $attributes, $extension ) {
			return isset( $attributes->slug ) && $attributes->slug === $_GET['extension'] && method_exists( $this->extensions[ $extension ], 'view' );
		}, ARRAY_FILTER_USE_BOTH );

		if ( empty( $extension ) ) {
			return;
		}

		reset( $extension );
		$extension  = key( $extension );
		$attributes = $this->extensions[ $extension ];
		?>
		<div class="wrap" id="searchwp-<?php echo esc_attr( $attributes->slug ); ?>-wrapper">
			<div id="icon-options-general" class="icon32"><br /></div>
			<div class="<?php echo esc_attr( $attributes->slug ); ?>-container">
				<h2>SearchWP <?php echo esc_html( $attributes->name ); ?></h2>
				<?php $this->extensions[ $extension ]->view(); ?>
			</div>
			<p class="searchwp-extension-back">
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=searchwp-settings' ) ); ?>"><?php esc_html_e( 'Back to SearchWP Settings', 'searchwp' ); ?></a>
			</p>
		</div>
		<?php
	}
}
