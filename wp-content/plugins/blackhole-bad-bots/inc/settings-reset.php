<?php // Blackhole for Bad Bots - Reset Settings

if (!defined('ABSPATH')) exit;

function blackhole_tools_admin_notice() {
	
	$screen_id = blackhole_get_current_screen_id();
	
	if (($screen_id === 'toplevel_page_blackhole_settings') || ($screen_id === 'blackhole_page_blackhole_badbots')) {
		
		if (!blackhole_check_date_expired() && !blackhole_dismiss_notice_check()) {
			
			$pages = array('blackhole_settings', 'blackhole_badbots');
			
			$page = (isset($_GET['page']) && in_array($_GET['page'], $pages)) ? $_GET['page'] : 'blackhole_settings';
			
			?>
			
			<div class="notice notice-success notice-margin notice-custom">
				<p>
					<strong><?php esc_html_e('Spring Sale!', 'blackhole-bad-bots'); ?></strong> 
					<?php esc_html_e('Take 30% OFF any of our', 'blackhole-bad-bots'); ?> 
					<a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/"><?php esc_html_e('Pro WordPress plugins', 'blackhole-bad-bots'); ?></a> 
					<?php esc_html_e('and', 'blackhole-bad-bots'); ?> 
					<a target="_blank" rel="noopener noreferrer" href="https://books.perishablepress.com/"><?php esc_html_e('books', 'blackhole-bad-bots'); ?></a>. 
					<?php esc_html_e('Apply code', 'blackhole-bad-bots'); ?> <code>SPRING2025</code> <?php esc_html_e('at checkout. Sale ends 6/25/2025.', 'blackhole-bad-bots'); ?> 
					<?php echo blackhole_dismiss_notice_link($page); ?>
				</p>
			</div>
			
			<?php
			
		}
		
		if (isset($_GET['reset-options'])) {
			
			if ($_GET['reset-options'] === 'true') : ?>
				
				<div class="notice notice-success is-dismissible"><p><strong><?php esc_html_e('Default options restored.', 'blackhole-bad-bots'); ?></strong></p></div>
				
			<?php else : ?>
				
				<div class="notice notice-info is-dismissible"><p><strong><?php esc_html_e('No changes made to options.', 'blackhole-bad-bots'); ?></strong></p></div>
				
			<?php endif;
			
		} elseif (isset($_GET['reset-badbots'])) {
			
			if ($_GET['reset-badbots'] === 'true') : ?>
				
				<div class="notice notice-success is-dismissible"><p><strong><?php esc_html_e('Bad bots reset successfully.', 'blackhole-bad-bots'); ?></strong></p></div>
				
			<?php else : ?>
				
				<div class="notice notice-info is-dismissible"><p><strong><?php esc_html_e('No changes made to bad bots.', 'blackhole-bad-bots'); ?></strong></p></div>
				
			<?php endif;
			
		} elseif (isset($_GET['delete-bot'])) {
			
			if ($_GET['delete-bot'] === 'true') : ?>
				
				<div class="notice notice-success is-dismissible"><p><strong><?php esc_html_e('Bot deleted.', 'blackhole-bad-bots'); ?></strong></p></div>
				
			<?php else : ?>
				
				<div class="notice notice-info is-dismissible"><p><strong><?php esc_html_e('No bots deleted.', 'blackhole-bad-bots'); ?></strong></p></div>
				
			<?php endif;
			
		}
		
	}
	
}

//

function blackhole_dismiss_notice_activate() {
	
	delete_option('blackhole-bad-bots-dismiss-notice');
	
}

function blackhole_dismiss_notice_version() {
	
	$version_current = BBB_VERSION;
	
	$version_previous = get_option('blackhole-bad-bots-dismiss-notice');
	
	$version_previous = ($version_previous) ? $version_previous : $version_current;
	
	if (version_compare($version_current, $version_previous, '>')) {
		
		delete_option('blackhole-bad-bots-dismiss-notice');
		
	}
	
}

function blackhole_dismiss_notice_check() {
	
	$check = get_option('blackhole-bad-bots-dismiss-notice');
	
	return ($check) ? true : false;
	
}

function blackhole_dismiss_notice_save() {
	
	if (isset($_GET['dismiss-notice-verify']) && wp_verify_nonce($_GET['dismiss-notice-verify'], 'blackhole_dismiss_notice')) {
		
		if (!current_user_can('manage_options')) exit;
		
		$result = update_option('blackhole-bad-bots-dismiss-notice', BBB_VERSION, false);
		
		$result = $result ? 'true' : 'false';
		
		$pages = array('blackhole_settings', 'blackhole_badbots');
		
		$page = (isset($_GET['page']) && in_array($_GET['page'], $pages)) ? $_GET['page'] : 'blackhole_settings';
		
		$location = admin_url('admin.php?page='. $page .'&dismiss-notice='. $result);
		
		wp_redirect($location);
		
		exit;
		
	}
	
}

function blackhole_dismiss_notice_link($page) {
	
	$nonce = wp_create_nonce('blackhole_dismiss_notice');
	
	$href  = add_query_arg(array('dismiss-notice-verify' => $nonce), admin_url('admin.php?page='. $page));
	
	$label = esc_html__('Dismiss', 'blackhole-bad-bots');
	
	return '<a class="bbb-dismiss-notice" href="'. esc_url($href) .'">'. esc_html($label) .'</a>';
	
}

function blackhole_check_date_expired() {
	
	$expires = apply_filters('blackhole_check_date_expired', '2025-06-25');
	
	return (new DateTime() > new DateTime($expires)) ? true : false;
	
}

//

function blackhole_reset_options() {
	
	if (isset($_GET['reset-options-verify']) && wp_verify_nonce($_GET['reset-options-verify'], 'blackhole_reset_options')) {
		
		if (!current_user_can('manage_options')) exit;
		
		$options_default = Blackhole_Bad_Bots::options();
		
		$options_update = update_option('bbb_options', $options_default);
		
		$result = 'false';
		
		if ($options_update) $result = 'true';
		
		do_action('blackhole_reset_options', $options_update, $options_default);
		
		$location = admin_url('admin.php?page=blackhole_settings&reset-options='. $result);
		wp_redirect($location);
		exit;
		
	}
	
}

function blackhole_reset_badbots() { 
	
	if (isset($_GET['reset-badbots-verify']) && wp_verify_nonce($_GET['reset-badbots-verify'], 'blackhole_reset_badbots')) {
		
		if (!current_user_can('manage_options')) exit;
		
		$badbots_default = Blackhole_Bad_Bots::badbots();
		
		$badbots_update = update_option('bbb_badbots', $badbots_default);
		
		$result = 'false';
		
		if ($badbots_update) {
			
			blackhole_clear_cache();
			
			$result = 'true';
			
		}
		
		do_action('blackhole_reset_badbots', $badbots_update, $badbots_default);
		
		$location = admin_url('admin.php?page=blackhole_badbots&reset-badbots='. $result);
		wp_redirect($location);
		exit;
		
	}
	
}

function blackhole_delete_bot() { 
	
	global $bbb_badbots;
	
	if (isset($_GET['delete-bot-verify']) && wp_verify_nonce($_GET['delete-bot-verify'], 'blackhole_delete_bot')) {
		
		if (!current_user_can('manage_options')) exit;
		
		$bot_ip = isset($_GET['bot-ip']) ? $_GET['bot-ip'] : '';
		
		$bot_id = isset($_GET['bot-id']) ? $_GET['bot-id'] : '';
		
		if (empty($bot_id)) return false;
		
		unset($bbb_badbots[$bot_id]);
		
		$badbots_update = update_option('bbb_badbots', $bbb_badbots);
		
		$result = 'false';
		
		if ($badbots_update) {
			
			blackhole_clear_cache();
			
			$result = 'true';
			
		}
		
		do_action('blackhole_delete_bot', $bot_id, $bot_ip, $badbots_update);
		
		$location = admin_url('admin.php?page=blackhole_badbots&delete-bot='. $result);
		wp_redirect($location);
		exit;
		
	}
	
}
