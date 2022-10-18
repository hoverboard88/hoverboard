<?php

namespace SearchWP\Admin\Views;

use SearchWP\Admin\Extensions\Extensions;
use SearchWP\License;
use SearchWP\Utils;

/**
 * Class ExtensionsView is responsible for displaying Extensions.
 *
 * @since 4.2.2
 */
class ExtensionsView {

	/**
	 * ExtensionsView slug.
	 *
	 * @since 4.2.2
     *
     * @var string
	 */
	private static $slug = 'extensions';


	/**
	 * ExtensionsView init.
	 *
	 * @since 4.2.2
	 */
    public static function init() {

        self::hooks();
    }

	/**
	 * ExtensionsView hooks.
	 *
	 * @since 4.2.2
	 */
    public static function hooks() {

	    if ( Utils::is_swp_admin_page( 'extensions', 'default' ) ) {
		    add_action( 'admin_notices', [ __CLASS__, 'notices' ] );
		    add_action( 'searchwp\settings\page\title', [ __CLASS__, 'page_title' ] );
		    add_action( 'searchwp\settings\view', [ __CLASS__, 'render' ] );
		    add_action( 'searchwp\settings\after', [ __CLASS__, 'scripts' ] );
		    add_action( 'admin_enqueue_scripts', [ __CLASS__, 'styles' ] );
	    }

	    add_action( 'wp_ajax_' . SEARCHWP_PREFIX . 'extension_install', [ __CLASS__, 'ajax_install_extension' ] );
	    add_action( 'wp_ajax_' . SEARCHWP_PREFIX . 'extension_activate', [ __CLASS__, 'ajax_activate_extension' ] );
	    add_action( 'wp_ajax_' . SEARCHWP_PREFIX . 'extension_deactivate', [ __CLASS__, 'ajax_deactivate_extension' ] );
    }

	/**
	 * ExtensionsView scripts.
	 *
	 * @since 4.2.6
	 */
	public static function scripts() {

		$handle = SEARCHWP_PREFIX . self::$slug;
		$debug  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG === true ) || isset( $_GET['script_debug'] ) ? '' : '.min';

		wp_enqueue_script(
			SEARCHWP_PREFIX . 'listjs',
			SEARCHWP_PLUGIN_URL . 'assets/vendor/listjs/list.min.js',
			[ 'jquery' ],
			'1.5.0'
		);

		wp_enqueue_script(
			$handle,
			SEARCHWP_PLUGIN_URL . "assets/js/admin/pages/extensions{$debug}.js",
			[ 'jquery', SEARCHWP_PREFIX . 'listjs' ],
			SEARCHWP_VERSION,
			true
		);

		Utils::localize_script(
			$handle,
			[
				'error_strings' => [
					'extension_error' => esc_html__( 'Could not install the extension. Please download it from searchwp.com and install it manually.', 'searchwp' ),
				],
			]
		);
	}

	/**
	 * ExtensionsView styles.
	 *
	 * @since 4.2.6
	 */
	public static function styles() {

		$handle = SEARCHWP_PREFIX . self::$slug;
		$debug  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG === true ) || isset( $_GET['script_debug'] ) ? '' : '.min';

		wp_enqueue_style(
			SEARCHWP_PREFIX . 'font-awesome',
			SEARCHWP_PLUGIN_URL . 'assets/vendor/fontawesome/css/font-awesome.min.css',
			null,
			'4.7.0'
		);

		wp_enqueue_style(
			$handle,
			SEARCHWP_PLUGIN_URL . "assets/css/admin/pages/extensions{$debug}.css",
			[],
			SEARCHWP_VERSION
		);
	}

	/**
	 * ExtensionsView notices.
	 *
	 * @since 4.2.2
	 */
	public static function notices() {

        if ( ! empty( License::is_active() ) ) {
            return;
        }

		printf(
			'<div class="notice searchwp-notice notice-error"><p>%s</p></div>',
			sprintf(
				wp_kses( /* translators: %s - SearchWP plugin settings URL. */
					__( 'To access extensions please enter and activate your SearchWP license key in the plugin <a href="%s">settings</a>.', 'searchwp' ),
					[
						'a' => [
							'href' => [],
						],
					]
				),
				esc_url_raw( add_query_arg( [ 'page' => 'searchwp-settings' ], admin_url( 'admin.php' ) ) )
			)
		);
    }

	/**
	 * ExtensionsView main page title.
	 *
	 * @since 4.2.2
	 */
	public static function page_title() {
		?>
        <h1 class="page-title">
			<?php esc_html_e( 'SearchWP Extensions', 'searchwp' ); ?>
        </h1>
		<?php
		if ( License::is_active() ) {
            echo '<input type="search" placeholder="' . esc_attr__( 'Search Extensions', 'searchwp' ) . '" id="searchwp-admin-extensions-search">';
		}
	}

	/**
	 * ExtensionsView render.
	 *
	 * @since 4.2.2
	 */
	public static function render() {
		// This node structure is as such to inherit WP-admin CSS.
		?>
		<div class="edit-post-meta-boxes-area">
			<div id="poststuff">
				<div class="meta-box-sortables">
					<?php self::print_container(); ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Print main container.
	 *
	 * @since 4.2.2
	 */
    private static function print_container() {
        ?>
        <div id="searchwp-extensions">
            <div class="searchwp-admin-content">
                <?php if ( License::is_active() ) : ?>
                    <h4 class="searchwp-extensions-heading"><?php echo esc_html__( 'Available Extensions', 'searchwp' ); ?></h4>
                <?php endif; ?>
                <div id="searchwp-extensions-list">
				    <?php self::print_extentions(); ?>
                </div>
            </div>
        </div>
        <?php
    }

	/**
	 * Print extensions lists and "Unlock More Features" message.
	 *
	 * @since 4.2.2
	 */
    private static function print_extentions() {

        self::print_extentions_allowed();
        self::print_extentions_disallowed();
    }

	/**
	 * Print allowed extensions list.
	 *
	 * @since 4.2.2
	 */
	private static function print_extentions_allowed() {

		$allowed = Extensions::get_allowed();

		if ( empty( $allowed ) ) {
            return;
        }

        echo '<div class="list extensions-list extensions-list-allowed">';
        self::print_extentions_list( $allowed );
        echo '</div>';
    }

	/**
	 * Print disallowed extensions list.
	 *
	 * @since 4.2.2
	 */
	private static function print_extentions_disallowed() {

		$disallowed = Extensions::get_disallowed();

		if ( empty( $disallowed ) ) {
            return;
        }

        self::print_unlock_features();

        echo '<div class="list extensions-list extensions-list-disallowed">';
        self::print_extentions_list( $disallowed );
        echo '</div>';
    }

	/**
	 * Print extensions list.
	 *
	 * @since 4.2.2
     *
	 * @param array $extensions Extensions data list.
	 */
	private static function print_extentions_list( array $extensions ) {

		foreach ( $extensions as $extension ) {
			self::print_extension( $extension );
		}
	}

	/**
	 * Print "Unlock More Features" message.
	 *
	 * @since 4.2.2
	 */
	private static function print_unlock_features() {

		/* translators: %s - SearchWP.com Account page URL. */
        $message = __( 'Want to get even more features? <a href="%s" target="_blank" rel="noopener noreferrer">Upgrade your SearchWP account</a> and unlock the following extensions.', 'searchwp' );

		$allowed_html = [
			'a' => [
				'href'   => [],
				'target' => [],
				'rel'    => [],
			],
		];

        $url = add_query_arg(
	        [
		        'utm_source'   => 'WordPress',
		        'utm_campaign' => 'plugin',
		        'utm_medium'   => 'extensions',
	        ],
	        SEARCHWP_EDD_STORE_URL . '/account/downloads'
        );

        ?>
		<div class="unlock-msg">
            <h4><?php esc_html_e( 'Unlock More Features...', 'searchwp' ); ?></h4>
            <p><?php echo sprintf( wp_kses( $message, $allowed_html ), esc_url( $url ) ); ?></p>
        </div>
        <?php
	}

	/**
	 * Print a single extension.
     *
     * @since 4.2.2
	 *
	 * @param array $extension Extension data.
	 */
	private static function print_extension( array $extension ) {
        ?>
        <div class="extension-container">
            <div class="extension-item">
                <?php self::print_extension_details( $extension ); ?>
                <?php self::print_extension_actions( $extension ); ?>
            </div>
        </div>
        
        <?php

	}

	/**
	 * Print a single extension details block.
     *
     * @since 4.2.2
	 *
	 * @param array $extension Extension data.
	 */
	private static function print_extension_details( array $extension ) {
        ?>
        <div class="extension-details">
            <img src="<?php echo esc_url( $extension['image'] ); ?>" alt="<?php esc_html_e( 'Extension image', 'searchwp' ); ?>">
            <h5 class="extension-name">
                <a target="_blank" rel="noopener noreferrer"
                   href="<?php echo esc_url( $extension['url'] ); ?>"
                   title="<?php echo esc_attr__( 'Learn more', 'searchwp' ); ?>">
					<?php echo esc_html( $extension['title'] ); ?>
                </a>
            </h5>
            <p class="extension-desc"><?php echo esc_html( $extension['excerpt'] ); ?></p>
        </div>
        <?php
    }

	/**
	 * Print a single extension actions block.
	 *
	 * @since 4.2.2
	 *
	 * @param array $extension Extension data.
	 */
	private static function print_extension_actions( array $extension ) {

        echo '<div class="extension-actions">';

        if ( $extension['plugin_status'] === 'disallowed' ) {
            self::print_extension_license_upgrade_link( $extension );
        } else {
            self::print_extension_action_contents( $extension );
        }

        echo '</div>';
    }

	/**
	 * Print a single extension upgrade license action.
	 *
	 * @since 4.2.2
	 *
	 * @param array $extension Extension data.
	 */
	private static function print_extension_license_upgrade_link( array $extension ) {

		if ( ! isset( $extension['slug'] ) ) {
			return;
		}

        $link = add_query_arg(
	        [
		        'utm_source'   => 'WordPress',
		        'utm_campaign' => 'plugin',
		        'utm_medium'   => 'extensions',
		        'utm_content'  => sanitize_key( $extension['slug'] ),
	        ],
	        SEARCHWP_EDD_STORE_URL . '/account/downloads'
        );

        ?>
        <div class="extension-action">
            <a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer" class="searchwp-btn searchwp-btn-accent upgrade-btn">
				<?php esc_html_e( 'Upgrade', 'searchwp' ); ?>
            </a>
        </div>
        <?php
    }

	/**
	 * Print a single extension actions block contents.
	 *
	 * @since 4.2.2
	 *
	 * @param array $extension Extension data.
	 */
    private static function print_extension_action_contents( array $extension ) {

	    if ( ! isset( $extension['slug'], $extension['plugin_status'] ) ) {
		    return;
	    }

	    $plugin_status = $extension['plugin_status'];
	    $statuses      = self::get_action_contents_statuses();

        if ( ! array_key_exists( $plugin_status, $statuses ) ) {
            return;
        }

        // Do not display 'missing' status markup for all statuses except 'missing'
        // since none of the actions transition to 'missing' status.
        if ( $plugin_status !== 'missing' ) {
            unset( $statuses['missing'] );
        }

        foreach ( $statuses as $status => $data ) {
            ?>
            <div class="extension-action extension-action-<?php echo esc_attr( $data['action_class'] ); ?>" <?php echo $status !== $plugin_status ? 'style="display: none;"' : ''; ?>>
                <div class="status">
                    <strong>
                        <?php esc_html_e( 'Status', 'searchwp' ); ?>:
                        <span class="status-label status-<?php echo esc_attr( $status ); ?>">
                            <?php echo esc_html( $data['status_title'] ); ?>
                        </span>
                    </strong>
                </div>
                <button class="searchwp-extension-<?php echo esc_attr( $data['action_class'] ); ?>" data-extension-slug="<?php echo esc_attr( $extension['slug'] ); ?>">
                    <i class="fa fa-spinner fa-spin" aria-hidden="true" style="display: none;"></i>
                    <span class="extension-action-button-text">
                        <i class="<?php echo esc_attr( $data['action_icon_class'] ); ?>" aria-hidden="true"></i>
                        <?php echo esc_html( $data['action_title'] ); ?>
                    </span>
                </button>
            </div>
            <?php
        }
    }

	/**
	 * Get a single extension actions block strings and classes.
	 *
	 * @since 4.2.2
	 */
    private static function get_action_contents_statuses() {

        return [
	        'active'   => [
		        'status_title'      => __( 'Active', 'searchwp' ),
		        'action_title'      => __( 'Deactivate', 'searchwp' ),
		        'action_class'      => 'deactivate',
		        'action_icon_class' => 'fa fa-toggle-on',
	        ],
	        'inactive' => [
		        'status_title'      => __( 'Inactive', 'searchwp' ),
		        'action_title'      => __( 'Activate', 'searchwp' ),
		        'action_class'      => 'activate',
		        'action_icon_class' => 'fa fa-toggle-on fa-flip-horizontal',
	        ],
	        'missing'  => [
		        'status_title'      => __( 'Not Installed', 'searchwp' ),
		        'action_title'      => __( 'Install', 'searchwp' ),
		        'action_class'      => 'install',
		        'action_icon_class' => 'fa fa-cloud-download',
	        ],
        ];
    }

	/**
	 * Install extension.
	 *
	 * @since 4.2.2
	 */
	public static function ajax_install_extension() {

		// Run a security check.
		Utils::check_ajax_permissions();

		$generic_error = esc_html__( 'There was an error while performing your request.', 'searchwp' );

		// Check if new installations are allowed.
		if ( ! Extensions::current_user_can_install() ) {
			wp_send_json_error( $generic_error );
		}

		$error = esc_html__( 'Could not install the extension. Please download it from searchwp.com and install it manually.', 'searchwp' );

		if ( ! isset( $_POST['extension_slug'] ) ) {
			wp_send_json_error( $error );
		}

		$extension     = Extensions::get( sanitize_key( wp_unslash( $_POST['extension_slug'] ) ) );
		$download_link = Extensions::get_download_url( $extension );

		if ( empty( $download_link ) ) {
			wp_send_json_error( $error );
		}

		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

		$skin     = new \WP_Ajax_Upgrader_Skin();
		$upgrader = new \Plugin_Upgrader( $skin );
		$result   = $upgrader->install( $download_link, [ 'overwrite_package' => true ] );

		self::ajax_process_install_extension_errors( $result, $skin );

		// Flush the cache and return the newly installed plugin basename.
		wp_cache_flush();

		$plugin_basename = $upgrader->plugin_info();

		if ( empty( $plugin_basename ) ) {
			wp_send_json_error( $error );
		}

		// Return early if user has no permissions to activate the plugins.
		if ( ! current_user_can( 'activate_plugins' ) ) {
			wp_send_json_success(
				[
					'msg'         => esc_html__( 'Extension installed.', 'searchwp' ),
					'show_action' => 'activate',
				]
			);
		}

		// Activate the plugin silently.
		$activated = activate_plugin( $plugin_basename );

		if ( is_wp_error( $activated ) ) {
            wp_send_json_error( $result );
        }

        wp_send_json_success(
	        [
		        'msg'         => esc_html__( 'Extension installed & activated.', 'searchwp' ),
		        'show_action' => 'deactivate',
	        ]
        );
	}

	/**
	 * Process extension install errors if any.
	 *
	 * @since 4.2.2
     *
	 * @param bool|WP_Error          $result Uprgrader install method result.
	 * @param \WP_Ajax_Upgrader_Skin $skin   AJAX upgrader skin.
	 */
	private static function ajax_process_install_extension_errors( $result, \WP_Ajax_Upgrader_Skin $skin ) {

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$status['debug'] = $skin->get_upgrade_messages();
		}

		if ( is_wp_error( $result ) ) {
			$status['errorCode']    = $result->get_error_code();
			$status['errorMessage'] = $result->get_error_message();

			wp_send_json_error( $status );
		} elseif ( is_wp_error( $skin->result ) ) {
			$status['errorCode']    = $skin->result->get_error_code();
			$status['errorMessage'] = $skin->result->get_error_message();

			wp_send_json_error( $status );
		} elseif ( $skin->get_errors()->has_errors() ) {
			$status['errorMessage'] = $skin->get_error_messages();

			wp_send_json_error( $status );
		} elseif ( is_null( $result ) ) {
			global $wp_filesystem;

			$status['errorCode']    = 'unable_to_connect_to_filesystem';
			$status['errorMessage'] = __( 'Unable to connect to the filesystem. Please confirm your credentials.', 'searchwp' );

			// Pass through the error from WP_Filesystem if one was raised.
			if ( $wp_filesystem instanceof \WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->has_errors() ) {
				$status['errorMessage'] = esc_html( $wp_filesystem->errors->get_error_message() );
			}
			wp_send_json_error( $status );
		}
    }

	/**
	 * Activate extension.
	 *
	 * @since 4.2.2
	 */
	public static function ajax_activate_extension() {

		// Run a security check.
		Utils::check_ajax_permissions();

		// Check for permissions.
		if ( ! current_user_can( 'activate_plugins' ) ) {
			wp_send_json_error( esc_html__( 'Plugin activation is disabled for you on this site.', 'searchwp' ) );
		}

        $error = esc_html__( 'Could not activate the extension. Please activate it on the Plugins page.', 'searchwp' );

		if ( ! isset( $_POST['extension_slug'] ) ) {
			wp_send_json_error( $error );
		}

		$extension = Extensions::get( sanitize_key( $_POST['extension_slug'] ) );

		if ( empty( $extension['file_name'] ) ) {
			wp_send_json_error( $error );
		}

		$activate = activate_plugins( $extension['file_name'] );

		if ( is_wp_error( $activate ) ) {
			wp_send_json_error( $error );
		}

		wp_send_json_success(
			[
				'msg'         => esc_html__( 'Extension activated.', 'searchwp' ),
				'show_action' => 'deactivate',
			]
		);
	}

	/**
	 * Deactivate extension.
	 *
	 * @since 4.2.2
	 */
	public static function ajax_deactivate_extension() {

		// Run a security check.
		Utils::check_ajax_permissions();

		// Check for permissions.
		if ( ! current_user_can( 'deactivate_plugins' ) ) {
			wp_send_json_error( esc_html__( 'Plugin deactivation is disabled for you on this site.', 'searchwp' ) );
		}

		$error = esc_html__( 'Could not deactivate the extension. Please deactivate from the Plugins page.', 'searchwp' );

		if ( ! isset( $_POST['extension_slug'] ) ) {
			wp_send_json_error( $error );
		}

		$extension = Extensions::get( sanitize_key( $_POST['extension_slug'] ) );

		if ( empty( $extension['file_name'] ) ) {
			wp_send_json_error( $error );
		}

		deactivate_plugins( $extension['file_name'] );

		wp_send_json_success(
			[
				'msg'         => esc_html__( 'Extension deactivated.', 'searchwp' ),
				'show_action' => 'activate',
			]
        );
	}
}
