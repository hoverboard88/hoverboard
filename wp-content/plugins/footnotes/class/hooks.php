<?php // phpcs:disable WordPress.Files.FileName.InvalidClassFileName, WordPress.Security.EscapeOutput.OutputNotEscaped
/**
 * Handles all WordPress hooks of this Plugin.
 *
 * @filesource
 * @package footnotes
 * @since 1.5.0
 * @date 12.09.14 10:56
 */

/**
 * Registers all WordPress Hooks and executes them on demand.
 *
 * @since 1.5.0
 */
class MCI_Footnotes_Hooks {

	/**
	 * Registers all WordPress hooks.
	 *
	 * @since 1.5.0
	 */
	public static function register_hooks() {
		register_activation_hook( dirname( __FILE__ ) . '/../footnotes.php', array( 'MCI_Footnotes_Hooks', 'activate_plugin' ) );
		register_deactivation_hook( dirname( __FILE__ ) . '/../footnotes.php', array( 'MCI_Footnotes_Hooks', 'deactivate_plugin' ) );
		register_uninstall_hook( dirname( __FILE__ ) . '/../footnotes.php', array( 'MCI_Footnotes_Hooks', 'uninstall_plugin' ) );
	}

	/**
	 * Executed when the Plugin gets activated.
	 *
	 * @since 1.5.0
	 */
	public static function activate_plugin() {
		// Currently unused.
	}

	/**
	 * Executed when the Plugin gets deactivated.
	 *
	 * @since 1.5.0
	 */
	public static function deactivate_plugin() {
		// Currently unused.
	}

	/**
	 * Executed when the Plugin gets uninstalled.
	 *
	 * @since 1.5.0
	 *
	 * @since 2.2.0 this function is not called any longer when deleting the plugin.
	 * @date 2020-12-12T1223+0100
	 * Note: clear_all() didn’t actually work.
	 * @see class/settings.php
	 */
	public static function uninstall_plugin() {
		// WordPress User has to be logged in.
		if ( ! is_user_logged_in() ) {
			wp_die( __( 'You must be logged in to run this script.', 'footnotes' ) );
		}
		// WordPress User needs the permission to (un)install plugins.
		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_die( __( 'You do not have permission to run this script.', 'footnotes' ) );
		}
	}

	/**
	 * Add Links to the Plugin in the "installed Plugins" page.
	 *
	 * @since 1.5.0
	 * @param array  $p_arr_links Current Links.
	 * @param string $p_str_plugin_file_name Plugins init file name.
	 * @return array
	 */
	public static function plugin_links( $p_arr_links, $p_str_plugin_file_name ) {
		// Append link to the WordPress Plugin page.
		$p_arr_links[] = sprintf( '<a href="https://wordpress.org/support/plugin/footnotes" target="_blank">%s</a>', __( 'Support', 'footnotes' ) );
		// Append link to the settings page.
		$p_arr_links[] = sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=mfmmf-footnotes' ), __( 'Settings', 'footnotes' ) );
		// Append link to the PayPal donate function.
		$p_arr_links[] = sprintf( '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6Z6CZDW8PPBBJ" target="_blank">%s</a>', __( 'Donate', 'footnotes' ) );
		// Return new links.
		return $p_arr_links;
	}
}
