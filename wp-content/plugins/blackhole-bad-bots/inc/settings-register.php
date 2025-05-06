<?php // Blackhole for Bad Bots - Register Settings

if (!defined('ABSPATH')) exit;

function blackhole_register_settings() {
	
	// register_setting( $option_group, $option_name, $sanitize_callback );
	register_setting('bbb_options', 'bbb_options', 'blackhole_validate_options');
	
	// add_settings_section( $id, $title, $callback, $page ); 
	add_settings_section('settings', esc_html__('Set the Controls..', 'blackhole-bad-bots'), 'blackhole_settings_section_settings', 'bbb_options');
	
	// add_settings_field( $id, $title, $callback, $page, $section, $args );
	add_settings_field('robots_rules',  esc_html__('Robots Rules',    'blackhole-bad-bots'), 'blackhole_callback_robots', 'bbb_options', 'settings', array('id' => 'robots_rules',  'label' => esc_html__('Add these rules to your site&rsquo;s robots.txt file', 'blackhole-bad-bots')));
	add_settings_field('disable_login', esc_html__('Logged-in Users', 'blackhole-bad-bots'), 'blackhole_callback_gopro',  'bbb_options', 'settings', array('id' => 'disable_login', 'label' => esc_html__('Disable Blackhole for logged-in users', 'blackhole-bad-bots')));
	add_settings_field('hits_required', esc_html__('Threshold',       'blackhole-bad-bots'), 'blackhole_callback_gopro',  'bbb_options', 'settings', array('id' => 'hits_required', 'label' => esc_html__('Number of hits before blocking', 'blackhole-bad-bots')));
	
	// Email Alerts
	
	add_settings_section('alerts', esc_html__('Email Alerts', 'blackhole-bad-bots'), 'blackhole_settings_section_alerts', 'bbb_options');
	
	add_settings_field('email_alerts',  esc_html__('Email Alerts',   'blackhole-bad-bots'), 'blackhole_callback_checkbox', 'bbb_options', 'alerts', array('id' => 'email_alerts',  'label' => esc_html__('Enable email alerts', 'blackhole-bad-bots')));
	add_settings_field('email_address', esc_html__('Email Address',  'blackhole-bad-bots'), 'blackhole_callback_text',     'bbb_options', 'alerts', array('id' => 'email_address', 'label' => esc_html__('Email address for alerts', 'blackhole-bad-bots')));
	add_settings_field('email_from',    esc_html__('Email From',     'blackhole-bad-bots'), 'blackhole_callback_text',     'bbb_options', 'alerts', array('id' => 'email_from',    'label' => esc_html__('Email address for &ldquo;From&rdquo; header', 'blackhole-bad-bots')));
	add_settings_field('alert_type',    esc_html__('Alert Type',     'blackhole-bad-bots'), 'blackhole_callback_gopro',    'bbb_options', 'alerts', array('id' => 'alert_type',    'label' => esc_html__('Type of email alert', 'blackhole-bad-bots')));
	add_settings_field('alert_message', esc_html__('Custom Message', 'blackhole-bad-bots'), 'blackhole_callback_gopro',    'bbb_options', 'alerts', array('id' => 'alert_message', 'label' => esc_html__('Custom alert message', 'blackhole-bad-bots')));
		
	// Front-end Display
	
	add_settings_section('frontend', esc_html__('Front-end Display', 'blackhole-bad-bots'), 'blackhole_settings_section_frontend', 'bbb_options');
	
	add_settings_field('warning_message',  esc_html__('Warning Message', 'blackhole-bad-bots'), 'blackhole_callback_gopro',    'bbb_options', 'frontend', array('id' => 'warning_message',  'label' => esc_html__('Warning message for bad bots', 'blackhole-bad-bots')));
	add_settings_field('message_display',  esc_html__('Blocked Message', 'blackhole-bad-bots'), 'blackhole_callback_radio',    'bbb_options', 'frontend', array('id' => 'message_display',  'label' => esc_html__('Message displayed to blocked bots', 'blackhole-bad-bots')));
	add_settings_field('message_custom',   esc_html__('Custom Message',  'blackhole-bad-bots'), 'blackhole_callback_textarea', 'bbb_options', 'frontend', array('id' => 'message_custom',   'label' => esc_html__('Custom blocked message', 'blackhole-bad-bots') .' <span class="bbb-light-text">'. esc_html__('(when Custom is selected in previous setting)', 'blackhole-bad-bots') .'</span>'));
	add_settings_field('blocked_redirect', esc_html__('Custom Redirect', 'blackhole-bad-bots'), 'blackhole_callback_gopro',    'bbb_options', 'frontend', array('id' => 'blocked_redirect', 'label' => esc_html__('Enter a custom URL for blocked bots', 'blackhole-bad-bots')));
	
	// Blackhole Trigger
	
	add_settings_section('trigger', esc_html__('Blackhole Trigger', 'blackhole-bad-bots'), 'blackhole_settings_section_trigger', 'bbb_options');
	
	$screenshot_trigger = '<a target="_blank" rel="noopener noreferrer" href="'. BBB_URL .'img/blackhole-pro-trigger.png" title="'. esc_attr__('View screenshot', 'blackhole-bad-bots') .'">'. esc_html__('trigger settings', 'blackhole-bad-bots') .'</a>';
	
	add_settings_field('trigger_settings', esc_html__('Trigger Settings', 'blackhole-bad-bots'), 'blackhole_callback_gopro', 'bbb_options', 'trigger', array('id' => 'trigger_settings', 'label' => esc_html__('Check out', 'blackhole-bad-bots') .' '. $screenshot_trigger .' '. esc_html__('available in pro version', 'blackhole-bad-bots')));
	
	// Bad Bots Log
	
	add_settings_section('botlog', esc_html__('Bad Bots Log', 'blackhole-bad-bots'), 'blackhole_settings_section_botlog', 'bbb_options');
	
	$screenshot_botlog = '<a target="_blank" rel="noopener noreferrer" href="'. BBB_URL .'img/blackhole-pro-bad-bot-log.jpg" title="'. esc_attr__('View screenshot', 'blackhole-bad-bots') .'">'. esc_html__('Bad Bot Log', 'blackhole-bad-bots') .'</a>';
	
	add_settings_field('botlog_settings', esc_html__('Bot Log Settings', 'blackhole-bad-bots'), 'blackhole_callback_gopro', 'bbb_options', 'botlog', array('id' => 'botlog_settings', 'label' => esc_html__('Check out', 'blackhole-bad-bots') .' '. $screenshot_botlog .' '. esc_html__('available in pro version', 'blackhole-bad-bots')));
	
	// Advanced Settings
	
	add_settings_section('advanced', esc_html__('Advanced Settings', 'blackhole-bad-bots'), 'blackhole_settings_section_advanced', 'bbb_options');
	
	add_settings_field('bot_blacklist',      esc_html__('Blacklist Bots',     'blackhole-bad-bots'), 'blackhole_callback_gopro',    'bbb_options', 'advanced', array('id' => 'bot_blacklist',      'label' => esc_html__('User agents that always should be blocked', 'blackhole-bad-bots')));
	add_settings_field('bot_whitelist',      esc_html__('Whitelist Bots',     'blackhole-bad-bots'), 'blackhole_callback_textarea', 'bbb_options', 'advanced', array('id' => 'bot_whitelist',      'label' => esc_html__('User agents that never should be blocked', 'blackhole-bad-bots')  .' <span class="bbb-light-text">'. esc_html__('(separate with commas)', 'blackhole-bad-bots') .'</span>'));
	add_settings_field('ip_whitelist',       esc_html__('Whitelist IPs',      'blackhole-bad-bots'), 'blackhole_callback_textarea', 'bbb_options', 'advanced', array('id' => 'ip_whitelist',       'label' => esc_html__('IP addresses that never should be blocked', 'blackhole-bad-bots') .' <span class="bbb-light-text">'. esc_html__('(one IP address per line)', 'blackhole-bad-bots') .'</span>'));
	add_settings_field('whitelist_redirect', esc_html__('Whitelist Redirect', 'blackhole-bad-bots'), 'blackhole_callback_gopro',    'bbb_options', 'advanced', array('id' => 'whitelist_redirect', 'label' => esc_html__('Enter a custom URL for whitelisted bots', 'blackhole-bad-bots')));
	add_settings_field('status_code',        esc_html__('Status Code',        'blackhole-bad-bots'), 'blackhole_callback_gopro',    'bbb_options', 'advanced', array('id' => 'status_code',        'label' => esc_html__('Status code for all blocked bots', 'blackhole-bad-bots')));
	add_settings_field('reset_options',      esc_html__('Reset Options',      'blackhole-bad-bots'), 'blackhole_callback_reset',    'bbb_options', 'advanced', array('id' => 'reset_options',      'label' => esc_html__('Restore default plugin options', 'blackhole-bad-bots')));
	add_settings_field('rate_plugin',        esc_html__('Rate Plugin',        'blackhole-bad-bots'), 'blackhole_callback_rate',     'bbb_options', 'advanced', array('id' => 'rate_plugin',        'label' => esc_html__('Show support with a 5-star rating &raquo;', 'blackhole-bad-bots')));
	add_settings_field('show_support',       esc_html__('Show Support',       'blackhole-bad-bots'), 'blackhole_callback_support',  'bbb_options', 'advanced', array('id' => 'show_support',       'label' => esc_html__('Show support with a small donation &raquo;', 'blackhole-bad-bots')));
	add_settings_field('pro_version',        esc_html__('Upgrade to Pro',     'blackhole-bad-bots'), 'blackhole_callback_pro',      'bbb_options', 'advanced', array('id' => 'pro_version',        'label' => esc_html__('Get Blackhole Pro &raquo;', 'blackhole-bad-bots')));
	
}

function blackhole_validate_options($input) {
	
	$message_display = blackhole_message_display();
	$allowed_tags = wp_kses_allowed_html('post');
	
	if (!isset($input['email_alerts'])) $input['email_alerts'] = null;
	$input['email_alerts'] = ($input['email_alerts'] == 1 ? 1 : 0);
	
	if (isset($input['email_address'])) $input['email_address'] = wp_filter_nohtml_kses($input['email_address']);
	
	if (isset($input['email_from'])) $input['email_from'] = wp_filter_nohtml_kses($input['email_from']);
	
	if (!isset($input['message_display'])) $input['message_display'] = null;
	if (!array_key_exists($input['message_display'], $message_display)) $input['message_display'] = null;
	
	if (isset($input['message_custom'])) $input['message_custom'] = wp_kses(stripslashes_deep($input['message_custom']), $allowed_tags);
	
	if (isset($input['bot_whitelist']))  $input['bot_whitelist'] = wp_filter_nohtml_kses($input['bot_whitelist']);
	
	if (isset($input['ip_whitelist']))  $input['ip_whitelist'] = wp_filter_nohtml_kses($input['ip_whitelist']);
	
	return $input;
	
}

function blackhole_settings_section_settings() {
	
	echo '<p>'. esc_html__('Thanks for using the free Blackhole plugin. May your site be free of bad bots. Visit the', 'blackhole-bad-bots');
	
	echo ' <strong>'. esc_html__('Help tab', 'blackhole-bad-bots') .'</strong> '. esc_html__('for complete documentation and tips.', 'blackhole-bad-bots') .'</p>';
	
	echo '<p><strong>'. esc_html__('Important:', 'blackhole-bad-bots') .'</strong> '. esc_html__('Blackhole is not compatible with caching,', 'blackhole-bad-bots');
	
	echo ' <a target="_blank" rel="noopener noreferrer" href="https://wordpress.org/support/topic/important-do-not-use-on-sites-with-caching/" title="'. esc_html__('Read announcement at WordPress.org', 'blackhole-bad-bots') .'">';
	
	echo esc_html__('learn more', 'blackhole-bad-bots') .'&nbsp;&raquo;</a></p>';
	
}

function blackhole_settings_section_alerts() {
	
	echo '<p>'. esc_html__('Stay aware with Blackhole Email Alerts.', 'blackhole-bad-bots') .'</p>';
	
}

function blackhole_settings_section_frontend() {
	
	echo '<p>'. esc_html__('Customize the appearance of the Blackhole on the frontend.', 'blackhole-bad-bots') .'</p>';
	
}

function blackhole_settings_section_advanced() {
	
	echo '<p>'. esc_html__('Advanced settings. Read the Help tab for more information.', 'blackhole-bad-bots') .'</p>';
	
}

function blackhole_settings_section_trigger() {
	
	echo '<p>'. esc_html__('Customize the trigger link with these settings.', 'blackhole-bad-bots') .'</p>';
	
}

function blackhole_settings_section_botlog() {
	
	echo '<p>'. esc_html__('These settings control the Bad Bots Log.', 'blackhole-bad-bots') .'</p>';
	
}

function blackhole_message_display() {
	
	$message_display = array(
		'default' => array(
			'value' => 'default',
			'label' => esc_html__('Default Message', 'blackhole-bad-bots') .' <span class="bbb-light-text">'. esc_html__('(displays some basic text and markup)', 'blackhole-bad-bots') .'</span>',
		),
		'custom' => array(
			'value' => 'custom',
			'label' => esc_html__('Custom Message', 'blackhole-bad-bots') .' <span class="bbb-light-text">'. esc_html__('(define your own message in the next setting)', 'blackhole-bad-bots') .'</span>',
		),
		'nothing' => array(
			'value' => 'nothing',
			'label' => esc_html__('Into the Void', 'blackhole-bad-bots') .' <span class="bbb-light-text">'. esc_html__('(displays an empty page with a black background)', 'blackhole-bad-bots') .'</span>',
		),
	);
	return $message_display;
	
}

function blackhole_callback_text($args) {
	
	global $bbb_options;
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($bbb_options[$id]) ? sanitize_text_field($bbb_options[$id]) : '';
	
	echo '<input name="bbb_options['. $id .']" type="text" size="40" value="'. $value .'" />';
	echo '<label class="bbb-label" for="bbb_options['. $id .']">'. $label .'</label>';
	
}

function blackhole_callback_textarea($args) {
	
	global $bbb_options;
	
	$allowed_tags = wp_kses_allowed_html('post');
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($bbb_options[$id]) ? wp_kses(stripslashes_deep($bbb_options[$id]), $allowed_tags) : '';
	$class = ($id === 'message_custom') ? 'class="code"' : '';
	
	$message = '<label class="bbb-label textarea-message"><span class="message-dot"></span>'. esc_html__('Read important message about this setting in the Help tab above', 'blackhole-bad-bots') .' <span class="bbb-light-text">('. esc_html__('under &ldquo;Whitelist Settings&rdquo;', 'blackhole-bad-bots') .')</span></label>';
	
	if ($id === 'bot_whitelist') {
		
		echo $message;
		
	} elseif ($id === 'ip_whitelist') {
		
		$value = explode(",", $value);
		$value = array_filter(array_map('trim', $value));
		$value = array_unique($value);
		$value = implode("\n", $value);
		
	}
	
	echo '<textarea '. $class .' name="bbb_options['. $id .']" rows="3" cols="50">'. $value .'</textarea>';
	echo '<label class="bbb-label" for="bbb_options['. $id .']">'. $label .'</label>';
	
}

function blackhole_callback_checkbox($args) {
	
	global $bbb_options;
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$checked = isset($bbb_options[$id]) ? checked($bbb_options[$id], 1, false) : '';
	
	echo '<input name="bbb_options['. $id .']" type="checkbox" value="1" '. $checked .' /> ';
	echo '<label class="bbb-label inline-block" for="bbb_options['. $id .']">'. $label .'</label>';
	
}

function blackhole_callback_radio($args) {
	
	global $bbb_options;
	
	$options_array = array();
	if ($args['id'] === 'message_display') $options_array = blackhole_message_display();
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($bbb_options[$id]) ? sanitize_text_field($bbb_options[$id]) : '';
	
	echo '<label class="bbb-label inline-block" for="bbb_options['. $id .']">'. $label .'</label>';
	echo '<ul>';
	
	foreach ($options_array as $option) {
		
		$checked = '';
		if ($value == $option['value']) $checked = ' checked="checked"';
		
		echo '<li><input type="radio" name="bbb_options['. $id .']" value="'. $option['value'] .'"'. $checked .' /> '. $option['label'] .'</li>';
		
	}
	echo '</ul>';
	
}

function blackhole_callback_select($args) {
	
	global $bbb_options;
	
	$options_array = array();
	if ($args['id'] === 'message_display') $options_array = blackhole_message_display(); // example, replace with actual id and function
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($bbb_options[$id]) ? sanitize_text_field($bbb_options[$id]) : '';
	
	echo '<select name="bbb_options['. $id .']">';
	
	foreach ($options_array as $option) {
		echo '<option '. selected($option['value'], $value, false) .' value="'. $option['value'] .'">'. $option['label'] .'</option>';
	}
	echo '</select><label class="bbb-label inline-block" for="bbb_options['. $id .']">'. $label .'</label>';
	
}

function blackhole_callback_reset($args) {
	
	$nonce = wp_create_nonce('blackhole_reset_options');
	$href  = esc_url(add_query_arg(array('reset-options-verify' => $nonce), admin_url('options-general.php?page=blackhole_settings')));
	$label = isset($args['label']) ? $args['label'] : esc_html__('Restore default plugin options', 'blackhole-bad-bots');
	
	echo '<a class="bbb-reset-options" href="'. $href .'">'. $label .'</a>';
	
}

//

function blackhole_callback_gopro_checkbox($id, $label, $title) {
	
	echo '<input title="'. $title .'" name="bbb_options['. $id .']" type="checkbox" disabled /> ';
	echo '<label title="'. $title .'" class="bbb-label inline-block" for="bbb_options['. $id .']">'. $label .'</label> ';
	
}

function blackhole_callback_gopro_number($id, $label, $title, $number) {
	
	echo '<input title="'. $title .'" class="small-text" name="bbb_options['. $id .']" type="number" value="'. $number .'" disabled /> ';
	echo '<label title="'. $title .'" class="bbb-label inline-block" for="bbb_options['. $id .']">'. $label .'</label> ';
	
}

function blackhole_callback_gopro_select($id, $label, $title, $option) {
	
	echo '<select title="'. $title .'" name="bbb_options['. $id .']" disabled>';
	echo '<option selected>'. $option .'</option></select> ';
	echo '<label title="'. $title .'" class="bbb-label inline-block" for="bbb_options['. $id .']">'. $label .'</label> ';
	
}

function blackhole_callback_gopro_text($id, $label, $title) {
	
	echo '<input title="'. $title .'" class="slim-width" name="bbb_options['. $id .']" type="text" size="10" disabled /> ';
	echo '<label title="'. $title .'" class="bbb-label inline-block" for="bbb_options['. $id .']">'. $label .'</label> ';
	
}

function blackhole_callback_gopro_label($id, $label, $title) {
	
	echo '<label title="'. $title .'" class="bbb-label inline-block" for="bbb_options['. $id .']">'. $label .'</label> ';
	
}

function blackhole_callback_gopro($args) {
	
	$id    = isset($args['id']) ? $args['id'] : '';
	
	$label = isset($args['label']) ? $args['label'] : '';
	
	$title = esc_attr__('Go Pro to unlock this feature', 'blackhole-bad-bots');
	
	if ($id === 'disable_login') {
		
		blackhole_callback_gopro_checkbox($id, $label, $title);
		
	} elseif ($id === 'hits_required') {
		
		blackhole_callback_gopro_number($id, $label, $title, '1');
		
	} elseif ($id === 'alert_type') {
		
		blackhole_callback_gopro_select($id, $label, $title, esc_attr__('Daily Report', 'blackhole-bad-bots'));
		
	} elseif ($id === 'alert_message') {
		
		blackhole_callback_gopro_text($id, $label, $title);
		
	} elseif ($id === 'warning_message') {
		
		blackhole_callback_gopro_select($id, $label, $title, esc_attr__('Default Message', 'blackhole-bad-bots'));
		
	} elseif ($id === 'blocked_redirect') {
		
		blackhole_callback_gopro_text($id, $label, $title);
		
	} elseif ($id === 'trigger_settings') {
		
		blackhole_callback_gopro_label($id, $label, $title);
		
	} elseif ($id === 'botlog_settings') {
		
		blackhole_callback_gopro_label($id, $label, $title);
		
	} elseif ($id === 'bot_blacklist') {
		
		blackhole_callback_gopro_text($id, $label, $title);
		
	} elseif ($id === 'whitelist_redirect') {
		
		blackhole_callback_gopro_text($id, $label, $title);
		
	} elseif ($id === 'status_code') {
		
		blackhole_callback_gopro_select($id, $label, $title, esc_attr__('403 Forbidden', 'blackhole-bad-bots'));
		
	}
	
	echo blackhole_go_pro();
	
}

function blackhole_go_pro() {
	
	$output  = '<span class="gopro">';
	$output .= '<span class="gopro-arrow">'. esc_html__('&#9654;', 'blackhole-bad-bots') .'</span> ';
	$output .= '<a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/blackhole-pro/" title="'. esc_attr__('Check out Blackhole Pro at Plugin Planet', 'blackhole-bad-bots') .'">';
	$output .= esc_html__('Go Pro', 'blackhole-bad-bots') .'</a> '. esc_html__('to unlock this feature', 'blackhole-bad-bots');
	$output .= '</span>';
	
	return $output;
	
}

//

function blackhole_callback_robots() {
	
	$rules = blackhole_robots();
	
	if (empty($rules)) {
		
		$display = '<em class="bbb-warning">'. esc_html__('Please check WP General Settings.', 'blackhole-bad-bots') .'</em>';
		
	} else {
		
		$protocol = is_ssl() ? 'https://' : 'http://';
		
		$url = $protocol . blackhole_domain() . '/robots.txt';
		
		$title = __('View your site&rsquo;s robots.txt', 'blackhole-bad-bots');
		
		$text = __('robots.txt file', 'blackhole-bad-bots');
		
		$link = '<a target="_blank" rel="noopener noreferrer" href="'. esc_url($url) .'" title="'. esc_attr($title) .'">'. esc_html($text) .'</a>';
		
		$display  = '<div><em>'. esc_html__('Add the following rules to your site&rsquo;s ', 'blackhole-bad-bots') . $link .':</em></div>';
		
		$display .= '<pre>'. trim($rules) .'</pre>';
		
		$display .= '<div><em>'. esc_html__('If you are using WP-generated robots.txt, these rules are added automatically.', 'blackhole-bad-bots') .'</em></div>';
		
	}
	
	echo $display;
	
}

function blackhole_callback_rate($args) {
	
	$label = isset($args['label']) ? $args['label'] : esc_html__('Show support with a 5-star rating &raquo;', 'blackhole-bad-bots');
	$href  = 'https://wordpress.org/support/plugin/'. BBB_SLUG .'/reviews/?rate=5#new-post';
	$title = esc_attr__('Help keep Blackhole going strong! A huge THANK YOU for your support!', 'blackhole-bad-bots');
	
	echo '<a target="_blank" rel="noopener noreferrer" class="bbb-rate-plugin" href="'. $href .'" title="'. $title .'">'. $label .'</a>';
	
}

function blackhole_callback_support($args) {
	
	$href  = 'https://monzillamedia.com/donate.html';
	$title = esc_attr__('Donate via PayPal, credit card, or cryptocurrency', 'blackhole-bad-bots');
	$text  = isset($args['label']) ? $args['label'] : esc_html__('Show support with a small donation&nbsp;&raquo;', 'blackhole-bad-bots');
	
	echo '<a target="_blank" rel="noopener noreferrer" class="bbb-show-support" href="'. $href .'" title="'. $title .'">'. $text .'</a>';
	
}

function blackhole_callback_pro($args) {
	
	$src   = esc_url(BBB_URL .'/img/blackhole-pro.jpg');
	$href  = esc_url('https://plugin-planet.com/blackhole-pro/');
	$alt   = esc_attr__('Blackhole Pro', 'blackhole-bad-bots');
	$text  = esc_html__('Upgrade to get more options, advanced bot log, add bots, and more.', 'blackhole-bad-bots');
	
	$output  = '<p>'. $text .' <a target="_blank" rel="noopener noreferrer" href="'. $href .'">'. esc_html__('Get Blackhole Pro &raquo;', 'blackhole-bad-bots') .'</a></p>';
	$output .= '<p class="bbb-pro"><a target="_blank" rel="noopener noreferrer" href="'. $href .'"><img src="'. $src .'" width="400" height="104" alt="'. $alt .'"></a></p>';
	
	$extra = isset($args['extra']) ? $args['extra'] : false;
	
	echo ($extra) ? $output . blackhole_callback_pro_extra() : $output;
	
}

function blackhole_callback_pro_extra() {
	
	$href_1 = esc_url(BBB_URL .'img/blackhole-pro-settings.jpg');
	$href_2 = esc_url(BBB_URL .'img/blackhole-pro-bad-bot-log.jpg');
	$href_3 = esc_url(BBB_URL .'img/blackhole-pro-add-bot.jpg');
	
	$src_1 = esc_url(BBB_URL .'img/blackhole-pro-settings-400.jpg');
	$src_2 = esc_url(BBB_URL .'img/blackhole-pro-bad-bot-log-400.jpg');
	$src_3 = esc_url(BBB_URL .'img/blackhole-pro-add-bot-400.jpg');
	
	$alt_1 = esc_attr__('Screenshot showing Pro settings',    'blackhole-bad-bots');
	$alt_2 = esc_attr__('Screenshot showing Bad Bot Log',     'blackhole-bad-bots');
	$alt_3 = esc_attr__('Screenshot showing Add Bot feature', 'blackhole-bad-bots');
	
	$title = esc_attr__('Click to view full size screenshot (opens new tab)', 'blackhole-bad-bots');
	
	$output  = '<p class="bbb-pro-screenshots-intro">'. esc_html__('Check out Blackhole Pro settings and features:', 'blackhole-bad-bots') .'</p>';
	$output .= '<p class="bbb-pro bbb-pro-screenshots">';
	$output .= '<a target="_blank" rel="noopener noreferrer" href="'. $href_1 .'" title="'. $title .'"><img src="'. $src_1 .'" width="110" height="110" alt="'. $alt_1 .'" title="'. $alt_1 .'"></a>';
	$output .= '<a target="_blank" rel="noopener noreferrer" href="'. $href_2 .'" title="'. $title .'"><img src="'. $src_2 .'" width="110" height="110" alt="'. $alt_2 .'" title="'. $alt_2 .'"></a>';
	$output .= '<a target="_blank" rel="noopener noreferrer" href="'. $href_3 .'" title="'. $title .'"><img src="'. $src_3 .'" width="110" height="110" alt="'. $alt_3 .'" title="'. $alt_3 .'"></a>';
	$output .= '</p>';
	
	return $output;
	
}