<?php

/**
 * SearchWP SystemInfoView.
 *
 * @since 4.3.0
 */

namespace SearchWP\Admin\Views;

use SearchWP\License;
use SearchWP\Settings;
use SearchWP\Utils;
use SearchWP\Admin\NavTab;

/**
 * Class SystemInfoView is responsible for providing the UI for System Info.
 *
 * @since 4.3.0
 */
class SystemInfoView {

	private static $slug = 'system-info';

	/**
	 * SystemInfoView constructor.
	 *
	 * @since 4.3.0
	 */
	function __construct() {

		if ( Utils::is_swp_admin_page( 'tools' ) ) {
			new NavTab( [
				'page'  => 'tools',
				'tab'   => self::$slug,
				'label' => License::is_active() ? __( 'Support', 'searchwp' ) : __( 'System Info', 'searchwp' ),
			] );
		}

		if ( Utils::is_swp_admin_page( 'tools', self::$slug ) ) {
			add_action( 'searchwp\settings\view',  [ __CLASS__, 'render' ] );
			add_action( 'admin_enqueue_scripts', [ __CLASS__, 'assets' ] );
		}
	}

	/**
	 * Outputs the assets needed for the Settings UI.
	 *
	 * @since 4.3.0
	 */
	public static function assets() {

		$handle = SEARCHWP_PREFIX . self::$slug;

		wp_enqueue_style(
			$handle,
			SEARCHWP_PLUGIN_URL . 'assets/css/admin/pages/system-info.css',
			[
				Utils::$slug . 'collapse-layout',
				Utils::$slug . 'input',
				Utils::$slug . 'style',
            ],
			SEARCHWP_VERSION
		);

		wp_enqueue_script(
			$handle,
			SEARCHWP_PLUGIN_URL . 'assets/js/admin/pages/system-info.js',
			[ Utils::$slug . 'collapse' ],
			SEARCHWP_VERSION,
			true
		);
	}

	/**
	 * Callback for the render of this view.
	 *
	 * @since 4.3.0
	 */
	public static function render() {

		?>
        <div class="swp-content-container">

            <div id="system-info">

                <div class="swp-collapse swp-opened"> <!-- System Info Settings collapse -->

                    <div class="swp-collapse--header">

                        <h2 class="swp-h2">
                            System Info
                        </h2>

                        <button class="swp-expand--button">
                            <svg class="swp-arrow" width="17" height="11" viewBox="0 0 17 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.2915 0.814362L8.09717 6.95819L1.90283 0.814362L0 2.7058L8.09717 10.7545L16.1943 2.7058L14.2915 0.814362Z" fill="#0E2121" fill-opacity="0.8"/>
                            </svg>
                        </button>

                    </div>

                    <div class="swp-collapse--content">

                        <div class="swp-row">

                            <?php if ( License::is_active() ) : ?>
                                <div class="swp-flex--row sm:swp-flex--col sm:swp-flex--gap30 swp-margin-b30">
                                    <div class="swp-col swp-col--title-width">
                                        <h3 class="swp-h3">
                                            Get Help
                                        </h3>
                                    </div>

                                    <div class="swp-col sm:swp-w-full">
                                        <iframe id="swp-support-ticket" src="<?php echo esc_url( self::get_ticket_url() ); ?>" class="swp-iframe swp-w-5/6 sm:swp-w-full"></iframe>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="swp-flex--row sm:swp-flex--col sm:swp-flex--gap30">

                                <div class="swp-col swp-col--title-width">
                                    <h3 class="swp-h3">
                                        System Info
                                    </h3>
                                </div>

                                <div class="swp-col sm:swp-w-full">
                                    <textarea id="swp-tools-system-info" class="swp-textarea swp-w-5/6 swp-margin-b15 sm:swp-w-full" rows="15" readonly><?php echo esc_html( self::get_formatted_system_info() ); ?></textarea>
                                    <div class="swp-flex--row swp-flex--gap17 swp-flex--align-c">
                                        <button id="swp-tools-system-info-copy" class="swp-button">
                                            Copy to Clipboard
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>  <!-- End System Info collapse -->

            </div>
        </div>
		<?php
	}

	/**
	 * Returns a formatted version of the system information.
	 *
	 * @since 4.3.0
     * 
	 * @return string
	 */
	private static function get_formatted_system_info() {
		global $wpdb;

		$stopwords  = new \SearchWP\Logic\Stopwords();
		$synonyms   = new \SearchWP\Logic\Synonyms();
		$theme_data = wp_get_theme();
		$response   = wp_remote_post( 'https://searchwp.com/', [
			'sslverify'  => false,
			'timeout'    => 5,
			'user-agent' => 'SearchWP',
			'body'       => [ 'cmd' => '_notify-validate' ],
		] );
		$active_plugins  = get_option( 'active_plugins', [] );
		$network_plugins = get_site_option( 'active_sitewide_plugins', [] );

		$db_info = Utils::get_db_details();

		$system_info = [
			'Multisite'              => is_multisite() ? 'Yes' : 'No',
			'SITE_URL'               => site_url(),
			'HOME_URL'               => home_url(),
			'SearchWP Version'       => SEARCHWP_VERSION,
			'SearchWP License'       => License::get_key(),
			'WordPress Version'      => get_bloginfo( 'version' ),
			'Active Theme'           => $theme_data->Name . ' ' . $theme_data->Version,
			'PHP Version'            => PHP_VERSION,
			'Database'               => $db_info['engine'] . ' ' . $db_info['version'],
			'WordPress Memory Limit' => WP_MEMORY_LIMIT,
			'PHP Memory Limit'       => function_exists( 'ini_get' ) ? ini_get( 'memory_limit' ) : '?',
			'PHP Time Limit'         => function_exists( 'ini_get' ) ? (int) ini_get( 'max_execution_time' ) : '?',
			'WP_DEBUG'               => defined( 'WP_DEBUG' ) && WP_DEBUG ? 'Enabled' : 'Disabled',
			'DISABLE_WP_CRON'        => defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ? 'Enabled' : 'Disabled',
			'searchwp.com reachable' => ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ? 'Yes' : 'No',
			'Active Plugins'               => array_values( array_map( function( $plugin ) {
				return [ $plugin['Name'] => $plugin['Version'] ];
			}, array_filter( get_plugins(), function( $plugin ) use ( $active_plugins ) {
				return in_array( $plugin, $active_plugins, true );
			}, ARRAY_FILTER_USE_KEY ) ) ),
			'Network Active Plugins' => ! function_exists( 'wp_get_active_network_plugins' ) ? [] : array_map( function( $plugin ) {
				$plugin = get_plugin_data( $plugin );

				return [ $plugin['Name'] => $plugin['Version'] ];
			}, array_filter( wp_get_active_network_plugins(), function( $plugin ) use ( $network_plugins ) {
				$plugin_base = plugin_basename( $plugin );

				return array_key_exists( $plugin_base, $network_plugins );
			} ) ),
			'Index Stats'            => \SearchWP::$index->get_stats(),
			'Engines'                => array_map( function( $engine ) {
				return Utils::normalize_engine_config( json_decode( json_encode( $engine ), true ) );
			}, Settings::get_engines() ),
			'Stopwords'              => $stopwords->get(),
			'Synonyms'               => $synonyms->get(),
			'Settings'               => Settings::get(),
			'Advanced'               => call_user_func_array( 'array_merge', array_map( function( $key ) {
				return [ $key => Settings::get_single( $key, 'boolean' ) ];
			}, Settings::get_keys() ) ),
		];

		$complex_items = [
			'Active Plugins',
			'Network Active Plugins',
			'Index Stats',
			'Stopwords',
			'Synonyms',
			'Settings',
			'Engines',
			'Advanced',
		];

		if ( is_multisite() ) {
			$complex_items[] = 'Network Active Plugins';
		} else {
			unset( $system_info['Network Active Plugins'] );
		}

		$server_info = [];

		foreach ( $system_info as $item => $data ) {
			if ( in_array( $item, $complex_items ) ) {
				continue;
			}

			$server_info[] = [
				'Item'  => $item,
				'Value' => self::get_formatted_system_info_item_data( $item, $data ),
			];
		}

		// Render a table without a header.
		$formatted = explode( "\n", ( new \SearchWP\Dependencies\dekor\ArrayToTextTable( $server_info ) )->render() );
		array_splice( $formatted, 1, 2 );
		$formatted = implode( "\n", $formatted );

		$formatted .= "\n\n" . implode( "\n\n", array_filter( array_map( function( $item, $data ) use ( $complex_items ) {
				if ( ! in_array( $item, $complex_items ) ) {
					return false;
				}

				$label = strtoupper( $item );

				if ( 'SETTINGS' === $label ) {
					$label = 'SOURCES';
				}

				return $label . "\n\n" . self::get_formatted_system_info_item_data( $item, $data ) . "\n";
			}, array_keys( $system_info ), array_values( $system_info ) ) ) );

		return $formatted;
	}

	/**
	 * Formats individual System Info items into something more readable.
	 *
	 * @since 4.3.0
     *
	 * @param string $item The item being formatted.
	 * @param mixed  $data The data for the item being formatted.
     *
	 * @return string The formatted data.
	 */
	private static function get_formatted_system_info_item_data( string $item, $data ) {
		$formatted = '';

		switch ( $item ) {
			case 'Active Plugins':
			case 'Network Active Plugins':
			case 'Index Stats':
				if ( isset( $data[0] ) && is_array( $data[0] ) ) {
					$data = call_user_func_array( 'array_merge', $data );
				}

				if ( 'Index Stats' === $item ) {
					$data = [
						'Last Activity' => $data['lastActivity'],
						'Indexed'       => $data['indexed'],
						'Total'         => $data['total'],
						'Outdated'      => $data['outdated'] ? 'Yes' : 'No',
					];
				}

				if ( empty( $data ) ) {
					$formatted = '[[ NONE ]]';
				} else {
					$title_col_length = max( array_map( 'strlen', array_keys( $data ) ) );
					$formatted = implode( "\n", array_map( function( $plugin, $version ) use ( $title_col_length ) {
						return str_pad( $plugin . ': ', $title_col_length + 2 ) . ' ' . $version;
					}, array_keys( $data ), array_values( $data ) ) );
				}

				break;

			case 'Engines':
				if ( ! is_array( $data ) || empty( $data ) ) {
					$formatted = '[[ NONE ]]';
				} else {
					$formatted = str_replace( "\n\n", "\n", str_replace( '  ', ' ', print_r( array_map( function( $engine ) {
						$engine['settings'] = array_filter( $engine['settings'] );
						$engine['sources']  = array_map( function( $source ) {
							return array_filter( $source );
						}, $engine['sources'] );

						return $engine;
					}, $data ), true ) ) );
				}

				break;

			case 'Stopwords':
				$formatted = wordwrap( implode( ', ', $data ) );

				break;

			case 'Synonyms':
				if ( empty( $data ) ) {
					$formatted = '[[ NONE ]]';
				} else {
					$pad       = max( array_map( 'strlen', wp_list_pluck( $data, 'sources' ) ) );
					$formatted = implode( "\n", array_map( function( $synonym ) use ( $pad ) {
						return str_pad( $synonym['sources'], $pad ) . ' => ' . $synonym['synonyms'] . ( $synonym['replace'] ? ' (replace)' : '' );
					}, $data ) );
				}

				break;

			case 'Settings': // We are going to extract Source names.
				if ( empty( $data['sources'] ) ) {
					$formatted = '[[ NONE ]]';
				} else {
					$formatted = wordwrap( implode( ', ', array_keys( $data['sources'] ) ) );
				}

				break;

			case 'Advanced':
				$settings = [
					'debug'                          => 'Debugging Enabled',
					'index_outdated'                 => 'Index Outdated',
					'partial_matches'                => 'Partial Matches',
					'highlighting'                   => 'Highlighting',
					'parse_shortcodes'               => 'Parse Shortcodes',
					'do_suggestions'                 => 'Do Suggestions',
					'quoted_search_support'          => 'Quoted Search Support',
					'tokenize_pattern_matches'       => 'Tokenize Pattern Matches',
					'remove_min_word_length'         => 'Remove Min Word Length',
					'reduced_indexer_aggressiveness' => 'Reduced Aggressiveness',
					'indexer_paused'                 => 'Indexer Paused',
					'hide_announcements'             => 'Hide Announcements',
					'nuke_on_delete'                 => 'Remove Data on Delete',
				];

				$pad = max( array_map( 'strlen', $settings ) );

				$formatted = implode( "\n", array_filter( array_map( function( $setting, $value ) use ( $pad, $settings ) {
					if ( ! array_key_exists( $setting, $settings ) ) {
						return false;
					}

					return str_pad( $settings[ $setting ], $pad ) . ' => ' . ( empty( $value ) ? 'No' : 'Yes' );
				}, array_keys( $data ), array_values( $data ) ) ) );

				break;

			default:
				$formatted = (string) $data;
		}

		return $formatted;
	}

    private static function get_ticket_url() {

	    $current_user  = wp_get_current_user();
	    $conflicts_var = ''; // TODO: retrieve conflicts.

	    $db_info = Utils::get_db_details();

	    $args = [
		    'support'    => 1,
		    'f'          => 27,
		    'dd'         => 0,
		    'dt'         => 0,
		    'email'      => urlencode( $current_user->user_email ),
		    'url'        => urlencode( home_url() ),
		    'env'        => defined( 'WPE_APIKEY' ) ? 'wpe' : 0,
		    'wpegov'     => defined( 'WPE_GOVERNOR' ) && false === WPE_GOVERNOR ? 1 : 0,
		    'conflicts'  => urlencode( $conflicts_var ),
		    'searchwp_v' => urlencode( get_option( 'searchwp_version' ) ),
		    'wp_v'       => urlencode( get_bloginfo( 'version' ) ),
		    'php_v'      => urlencode( PHP_VERSION ),
		    'mysql_v'    => urlencode( $db_info['engine'] . ' ' . $db_info['version'] ),
		    'license'    => License::get_key(),
	    ];

	    return add_query_arg( $args, 'https://searchwp.com/gfembed/' );
    }
}
