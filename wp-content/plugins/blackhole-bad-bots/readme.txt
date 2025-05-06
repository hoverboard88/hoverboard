=== Blackhole for Bad Bots ===

Plugin Name: Blackhole for Bad Bots
Plugin URI: https://perishablepress.com/blackhole-bad-bots/
Description: Protects your site against bad bots by trapping them in a virtual black hole.
Tags: bots, blackhole, honeypot, security, anti-spam
Author: Jeff Starr
Contributors: specialk
Author URI: https://plugin-planet.com/
Donate link: https://monzillamedia.com/donate.html
Requires at least: 4.7
Tested up to: 6.8
Stable tag: 3.7.4
Version:    3.7.4
Requires PHP: 5.6.20
Text Domain: blackhole-bad-bots
Domain Path: /languages
License: GPL v2 or later

Blackhole is a WordPress security plugin that detects and traps bad bots in a virtual black hole, where they are denied access to your entire site.



== Description ==

> ✨ Trap bad bots in a virtual black hole

__Important:__ Do NOT use this plugin on sites with caching. [Learn more&nbsp;&raquo;](https://wordpress.org/support/topic/important-do-not-use-on-sites-with-caching/)



**👾 Bye bye bad bots..**

Bad bots are the worst. They do all sorts of nasty stuff and waste server resources. The Blackhole plugin helps to stop bad bots and save precious resources for legit visitors.



**👾 How does it work?**

First the plugin adds a hidden trigger link to the footer of your pages. You then add a line to your robots.txt file that forbids all bots from following the hidden link. Bots that then ignore or disobey your robots rules will crawl the link and fall into the trap. Once trapped, bad bots are denied further access to your WordPress site.

I call it the "one-strike" rule: bots have one chance to obey your site's robots.txt rule. Failure to comply results in immediate banishment. The best part is that the Blackhole only affects bad bots: human users never see the hidden link, and good bots obey the robots rules in the first place. Win-win! :)

> ✨ Add a blackhole trap to help stop bad bots

__Important:__ Do NOT use this plugin on sites with caching. [Learn more&nbsp;&raquo;](https://wordpress.org/support/topic/important-do-not-use-on-sites-with-caching/)



**👾 Features**

* Easy to set up
* Squeaky clean code
* Focused and modular
* Lightweight, fast and flexible
* Built with the WordPress API
* Works with other security plugins
* Easy to reset the list of bad bots
* Easy to delete any bot from the list
* Regularly updated and "future proof"
* Blackhole link includes "nofollow" attribute
* Plugin options configurable via settings screen
* Works silently behind the scenes to protect your site
* Whitelists all major search engines to never block
* Focused on flexibility, performance, and security
* Email alerts with WHOIS lookup for blocked bots
* Complete inline documentation via the Help tab
* Provides setting to whitelist any IP addresses
* Customize the message displayed to bad bots ;)
* One-click restore the plugin default options
* Does NOT use or require any .htaccess rules

Blackhole for Bad Bots protects your site against bad bots, spammers, scrapers, scanners, and other automated threats.

_Not using WordPress? Check out the [standalone PHP version of Blackhole](https://perishablepress.com/blackhole-bad-bots/)!_

_Check out [Blackhole Pro](https://plugin-planet.com/blackhole-pro/) and level up with advanced features!_



**👾 Whitelist**

By default, this plugin does NOT block any of the major search engines (user agents):

* AOL.com
* Baidu
* Bingbot/MSN
* DuckDuckGo
* Googlebot
* Teoma
* Yahoo!
* Yandex

These search engines (and all of their myriad variations) are whitelisted via user agent. So are a bunch of other "useful" bots. They always are allowed full access to your site, even if they disobey your robots.txt rules. This list can be customized in the plugin settings. For a complete list of whitelisted bots, visit the Help tab in the plugin settings (under "Whitelist Settings").



**👾 Privacy**

__User Data:__ This plugin automatically blocks bad bots. When bad bots fall into the trap, their IP address, user agent, and other request data are stored in the WP database. No other user data is collected by this plugin. At any time, the administrator may delete all saved data via the plugin settings. 

__Services:__ This plugin does not connect to any third-party locations or services.

__Cookies:__ This plugin does not set any cookies.

__Credit:__ Header Image Courtesy NASA/JPL-Caltech.


Blackhole for Bad Bots is developed and maintained by [Jeff Starr](https://x.com/perishable), 15-year [WordPress developer](https://plugin-planet.com/) and [book author](https://books.perishablepress.com/).



**👾 Support development**

I develop and maintain this free plugin with love for the WordPress community. To show support, you can [make a donation](https://monzillamedia.com/donate.html) or purchase one of my books: 

* [The Tao of WordPress](https://wp-tao.com/)
* [Digging into WordPress](https://digwp.com/)
* [.htaccess made easy](https://htaccessbook.com/)
* [WordPress Themes In Depth](https://wp-tao.com/wordpress-themes-book/)
* [Wizard's SQL Recipes for WordPress](https://books.perishablepress.com/downloads/wizards-collection-sql-recipes-wordpress/)

And/or purchase one of my premium WordPress plugins:

* [BBQ Pro](https://plugin-planet.com/bbq-pro/) - Super fast WordPress firewall
* [Blackhole Pro](https://plugin-planet.com/blackhole-pro/) - Automatically block bad bots
* [Banhammer Pro](https://plugin-planet.com/banhammer-pro/) - Monitor traffic and ban the bad guys
* [GA Google Analytics Pro](https://plugin-planet.com/ga-google-analytics-pro/) - Connect WordPress to Google Analytics
* [Head Meta Pro](https://plugin-planet.com/head-meta-pro/) - Ultimate Meta Tags for WordPress
* [Simple Ajax Chat Pro](https://plugin-planet.com/simple-ajax-chat-pro/) - Unlimited chat rooms
* [USP Pro](https://plugin-planet.com/usp-pro/) - Unlimited front-end forms

Links, tweets and likes also appreciated. Thank you! :)



== Screenshots ==

1. Blackhole Settings Screen (showing default options)
2. Blackhole Bad Bots Screen (showing some example bots)



== Installation ==

**Installing Blackhole for Bad Bots**

1. Upload the Blackhole plugin to your blog and activate
2. Visit the Blackhole Settings and copy the Robots Rules
3. Add the Robots Rules to your site's robots.txt file (see note)*
4. Configure the Blackhole Settings as desired and done

__Note:__ For the robots.txt rules, there are two scenarios:

1. Your site has a physical robots.txt file that you can see on the server. In this case, you need to add the required rules manually.
2. OR, your site is using the dynamic/virtual WP-generated robots.txt file, and there is no physical robots.txt file on your server. In this case, the plugin adds the required rules automatically. You do not need to add anything manually.

For complete documentation, click the "Help" tab in the upper-right corner of the Blackhole settings screen. Help tab also available on the "Bad Bots" screen.

[More info on installing WP plugins](https://wordpress.org/support/article/managing-plugins/#installing-plugins)

[Verify Blackhole is working properly](https://plugin-planet.com/blackhole-pro-check-plugin-working/)



**Caching Plugins**

__Important:__ Do NOT use this plugin on sites with caching. [Learn more&nbsp;&raquo;](https://wordpress.org/support/topic/important-do-not-use-on-sites-with-caching/)



**No robots.txt?**

For the robots.txt file, there are two possible scenarios:

1. You want to use your own physical robots.txt file that you can view and edit on the server. In this case, follow the steps below to create your site's robots.txt file.
2. OR, you want to use the dynamic/virtual WP-generated robots.txt file, such that there is no physical robots.txt file on your server. In this case, you don't need to do anything, because WordPress automatically generates a robots.txt file when requested. 

If you go with option #1, here are the steps to create a robots.txt file for your site:

1. Add a blank plain-text file to the root directory of your site
2. Name the text file `robots.txt` and upload to your server

Done. Now you can add the Blackhole rules provided on the plugin settings page. See the next section to learn more and validate your robots.txt file.

To view your robots.txt file, visit the following URL (replace example.com with your domain):

	https://example.com/robots.txt

__Tip:__ you can find a link to your site's robots.txt file on the plugin settings page.



**Robots Tools & Info**

Here are some collected resources for working with robots.txt. See also the next section, "Testing Robots.txt" for more tools.

* [Learn more about robots.txt](https://www.robotstxt.org/)
* [Validate your robots.txt file](https://lxrmarketplace.com/robots-txt-validator-tool.html)
* [Validate robots.txt in Google Webmaster Tools](https://www.google.com/webmasters/tools/robots-testing-tool)
* [Google Robots.txt Specifications](https://developers.google.com/search/reference/robots_txt)
* [How to Create a robots.txt file](https://developers.google.com/search/docs/advanced/robots/create-robots-txt)

Lots more great resources on the web to learn about and validate your robots.txt file. Read up, it's important for SEO.



**Testing Robots.txt**

To test that your site's robots.txt rules are correct, you can use a free robots.txt checker. Google provides a [robots checker](https://support.google.com/webmasters/answer/6062598) inside of your Google account (i.e., must be logged in to Google). There are many other robots validators around online. Here are some examples:

* [Robots.txt Validator](https://technicalseo.com/tools/robots-txt/)
* [Robots txt File Checker](https://pagedart.com/tools/robots-txt-file-checker/)
* [Robots.txt Checker](https://www.websiteplanet.com/webtools/robots-txt/)
* [Robots.txt Test](https://seositecheckup.com/tools/robotstxt-test)

Tons more robots tools available online, just search for something like "validate robots.txt" (without the quotes) to discover more.



**Testing Blackhole**

To test that the Blackhole trap is working, first remove your IP address(es) from the plugin setting, "Whitelist IPs". Also make sure your browser is not included in the plugin setting, "Whitelist Bots" (for example, Chrome is whitelisted). OR instead of changing any plugin settings, you can use a proxy service and non-whitelisted browser (e.g., Brave or Opera) to perform the test. 

After removing your IP address and user agent (or using a proxy service), view the source code of any web page on your site. Scroll down near the footer of the page until you locate a link that looks similar to the following:

	<a rel="nofollow" style="display:none" href="https://example.com/?blackhole=1234567890" title="Do NOT follow this link or you will be banned from the site!">Name of Your Website</a>

Click the link (the `href` value) to view the Warning Message. After visiting the Warning Message, refresh the page to view the Access Denied message. And/or visit any other page on the front-end of your site to verify that you have been banned. But don't worry, you will never be banned from the WP Admin Area or the WP Login Page. So simply log in and remove your IP address from the Bad Bots list to restore front-end access. 

More information on [how to verify Blackhole is working &raquo;](https://plugin-planet.com/blackhole-pro-check-plugin-working/)



**Why no bots?**

If you're not seeing any bad bots getting blocked, there are several things to keep in mind:

* Make sure you've set up according to the docs above
* New(er) websites may not get a lot of bad bot traffic
* Sites with low traffic may not get a lot of bad bots
* Check if you are using any other bot-blocking plugins
* Not all websites (even popular ones) get tons of bots
* Blackhole will not work if you have any caching on site
* If in doubt, you can test if the plugin is working (see previous section above)

So keep those things in mind. In most cases it's just a matter of time before some bad bots fall into the black hole.

Also note that the plugin provides two "whitelist" settings:

* Whitelist Bots
* Whitelist IPs

By default, certain things are automatically whitelisted when the plugin is activated. For example, your IP address is added to the whitelist IP setting. Also Chrome and other user agents are added to the whitelist user-agents setting. Just to keep in mind when testing plugin functionality.



**Whitelisted Bots**

Blackhole for Bad Bots is rigorously tested to ensure that the top search engine bots are NEVER BLOCKED. Any bots reporting a User Agent that contains any of the following strings will always have access to your site, even if they disobey robots.txt.

	a6-indexer, adsbot-google, ahrefsbot, aolbuild, apis-google, baidu, bingbot, bingpreview, butterfly, cloudflare, chrome, duckduckgo, embedly, facebookexternalhit, facebot, google page speed, googlebot, ia_archiver, linkedinbot, mediapartners-google, msnbot, netcraftsurvey, outbrain, pinterest, quora, rogerbot, showyoubot, slackbot, slurp, sogou, teoma, tweetmemebot, twitterbot, uptimerobot, urlresolver, vkshare, w3c_validator, wordpress, wp rocket, yandex

Of course, this list is completely customizable via the plugin settings. Each added string is matched against the full user agent, so be careful. Learn more about [user agents of the top search engines](https://perishablepress.com/list-all-user-agents-top-search-engines/).

You can also whitelist bots by IP address. Visit the setting, "Whitelist IPs", and enter the IP address (separate multiple IPs with commas). You can also whitelist entire ranges of IPs. In the same plugin setting, add something like this:

	123.456.

That will allow all bots reporting any IP that begins with `123.456.`. You can also whitelist IP addresses using CIDR notation. Check out the Help tab on the plugin settings page for details.



**Customizing**

Blackhole provides plenty of hooks for customizing and extending:

	blackhole_options
	blackhole_badbots
	blackhole_get_options
	blackhole_get_badbots
	blackhole_log_data
	blackhole_trigger
	blackhole_vars
	blackhole_log
	blackhole_ip_keys
	blackhole_alert_name
	blackhole_alert_subject
	blackhole_alert_message
	blackhole_alert_headers
	blackhole_needle
	blackhole_message_default
	blackhole_message_custom
	blackhole_message_nothing
	blackhole_ignore_loggedin
	blackhole_ignore_backend
	blackhole_ignore_login
	blackhole_block_status
	blackhole_block_protocol
	blackhole_block_connection
	blackhole_ip_filter
	blackhole_validate_ip_log
	blackhole_settings_contextual_help
	blackhole_badbots_contextual_help

If you need a hook added, [drop me a line](https://plugin-planet.com/support/#contact), will be glad to hook it up ;)



**Custom Warning Template**

The Blackhole displays two types of messages:

* Warning Message - Displayed when bots follow the blackhole trigger
* Blocked Message - Displayed for all requests made by blocked bots

The Blocked Message may be customized via the plugin settings. The Warning Message may be customized by setting up a custom template:

1. Copy `blackhole-template.php` from the plugin's `/inc/` directory
2. Paste the file into your theme template, for example: `/wp-content/my-awesome-theme/blackhole-template.php`
3. Customize any of the markup between "BEGIN TEMPLATE" and "END TEMPLATE"
4. Upload to your server and done

If the custom template exists in your theme directory, the plugin automatically will use it to display the Warning Message. If the custom template does not exist in your theme directory, the plugin will fallback to the default warning message.

__Tip:__ Instead of including the custom template in your theme, you can include via `/wp-content/` directory, like: `/wp-content/blackhole/blackhole-template.php`

_[More options available in the Pro version &raquo;](https://plugin-planet.com/blackhole-pro/)_



**Uninstalling**

Blackhole for Bad Bots cleans up after itself. All plugin settings and the bad bot list will be removed from your database when the plugin is uninstalled via the Plugins screen. After uninstalling, don't forget to remove the blackhole rules from your `robots.txt` file. It's fine to leave them in place, it will not hurt anything, but they serve no purpose without the plugin installed.

More specifically, Blackhole adds only two things to the database: options and bot list. When the plugin is uninstalled/deleted via the Plugins screen, both of those items are removed automatically via the following lines in `uninstall.php`:

	delete_option('bbb_options');
	delete_option('bbb_badbots');

So after uninstalling the plugin and deleting the robots.txt rules, there will be no trace of Blackhole for Bad Bots on your site.



**Like the plugin?**

If you like Blackhole for Bad Bots, please take a moment to [give a 5-star rating](https://wordpress.org/support/plugin/blackhole-bad-bots/reviews/?rate=5#new-post). It helps to keep development and support going strong. Thank you!



== Upgrade Notice ==

To upgrade Blackhole for Bad Bots, remove the old version and replace with the new version. Or just click "Update" from the Plugins screen and let WordPress do it for you automatically.

Note: uninstalling the plugin from the WP Plugins screen results in the removal of all settings and data from the WP database. 



== Frequently Asked Questions ==


**Do you offer any other security plugins?**

Yes, three of them:

* [BBQ Firewall](https://wordpress.org/plugins/block-bad-queries/) for super-fast firewall security
* [Blackhole for Bad Bots](https://wordpress.org/plugins/blackhole-bad-bots/) to protect your site against bad bots
* [Banhammer](https://wordpress.org/plugins/banhammer/) to monitor and ban any user or IP address

Pro versions with more features available at [Plugin Planet](https://plugin-planet.com/).


**How is this plugin different than a firewall?**

Blackhole uses its own "smart bot technology" that only blocks bots if they have demonstrated bad behavior. Firewalls typically are "static" and block requests based on a predefined set of patterns. That means that firewalls sometimes block legitimate visitors. Blackhole never blocks regular visitors, and only it blocks bots that disobey your site's robots.txt rules. So the rate of false positives is close to zero.


**The trigger link is not appearing in the source code?**

In order for the plugin to add the trigger link to your pages, your theme must include the template tag, `wp_footer()`. This is a recommended tag for all WordPress themes, so your theme should include it. If not, you can either add it yourself or contact the theme developer and ask for help. Here is [more information about wp_footer()](https://codex.wordpress.org/Function_Reference/wp_footer). Once the footer tag is included, the plugin will be able to add the trigger link to your pages.


**Will this block good bots like Google and Bing?**

No. Never. All the major search engine bots are whitelisted and will never be blocked. Unless you remove them from the whitelist setting, which is not recommended.


**I think the plugin is blocking Chrome, Firefox, etc.?**

Impossible because the plugin never blocks by user agent. It only blocks by IP address. No other criteria are used to block anything.


**How to add bots to the Blackhole manually?**

Question: Is it possible to block some bots by just adding them to blocked list and deny them Access to my website?

Answer: Not possible with the free version, but the [Pro version](https://plugin-planet.com/blackhole-pro/) includes an easy way to add bots manually (via the Bad Bots Log).


**How do I add other bots to the whitelist?**

Visit the plugin settings and add to the list.


**How do I reset the list of blocked bots?**

Visit the plugin settings and click the button.


**How do I delete the example/default bot from the log?**

Not possible with the free version, but can do with the [Pro version](https://plugin-planet.com/blackhole-pro/).


**How can I disable the email alerts?**

Visit the plugin settings and click the button.


**Is there a standalone version of the Blackhole?**

Yes. Visit Perishable Press to download a [PHP-based version](https://perishablepress.com/blackhole-bad-bots/) that does not require WordPress.


**Is there a Pro version of Blackhole?**

Yes, the [Pro version](https://plugin-planet.com/blackhole-pro/) is available at Plugin Planet.


**Is Multisite supported?**

Not yet, but it's on the to-do list.


**Which IP address are added by default?**

Your server IP address and your local (home) IP address (or whichever IP you are using when the plugin is installed).


**Can I manually include the blackhole link?**

Yes, you can add the following code anywhere in your theme template:

`<?php if (function_exists('blackhole_trigger')) blackhole_trigger(); ?>`


**Should whitelisted bots contain exact names?**

Question: Should whitelisted bots contain exact names, or can I just use partial names?

Answer: You can use partial names or full names, depending on how specific you would like to be with blocking. If you look at the default whitelisted bot strings, you will see that they are just portions of the full user agent. So for example you can block all bots that include the string "whateverbot" by including that string in the whitelist setting. It makes it easier to block bots, but you have to be careful about false positives.


**What about WordPress automatic (hidden) robots.txt?**

By default, WordPress will automatically serve a hidden, "virtual" robots.txt file to anything that requests it. Once you add your own "real" robots.txt file, WordPress will stop generating the virtual one. So when it comes to WordPress and robots.txt, real trumps virtual. Blackhole Pro requires that you add some rules to an actual robots.txt file, but it does not create/add any robots rules or the robots.txt file for you. Check out the plugin's Help tab for more infos.


**Which WP cache plugins are compatible with Blackhole?**

Maybe some, but just to be safe I'll say "none". So keep it simple and DO NOT use this plugin on sites with any sort of caching. [Learn more&nbsp;&raquo;](https://wordpress.org/support/topic/important-do-not-use-on-sites-with-caching/)


**Does Blackhole clean up after itself?**

Yes! As explained in the "Uninstalling" section in the [plugin documentation](https://wordpress.org/plugins/blackhole-bad-bots/#installation), when Blackhole is uninstalled via the Plugins screen, it removes everything from the database. After uninstalling, don't forget to remove the blackhole rules from your `robots.txt` file. Then there will be zero trace of the plugin on your site.


**How to disable the hostname lookup?**

By default, the plugin uses PHP's `gethostbyaddr()` function to lookup the host name for blocked requests. This is fine on most servers but some may experience slight reduced performance. So for those who may need it, the following code snippet can be added to disable the host lookup:

	function blackhole_enable_host_check() { return false; }
	add_filter('blackhole_enable_host_check', 'blackhole_enable_host_check');

That code can be added via your theme (or child theme) functions.php, or add via [custom plugin](https://digwp.com/2022/02/custom-code-wordpress/).


**How to disable the error log entries?**

By default the plugin adds an entry in the site error log for any invalid IP address. To disable this feature, add the following code snippet to your (child) theme's functions file, or add via [custom plugin](https://digwp.com/2022/02/custom-code-wordpress/):

	function blackhole_validate_ip_log_custom($log, $ip) { return ''; }
	add_filter('blackhole_validate_ip_log', 'blackhole_validate_ip_log_custom', 10, 2);


**How to enable Blackhole protection on Login Page?**

By default, Blackhole never blocks anything on the WP Login Page. This is to prevent new users from accidentally getting locked out of their site. 

To change the default behavior, and add Blackhole protection to the Login Page, add the following code to theme or child theme's functions.php, or add via [custom plugin](https://digwp.com/2022/02/custom-code-wordpress/):

	function blackhole_ignore_login($ignore) { return false; }
	add_filter('blackhole_ignore_login', 'blackhole_ignore_login');

If you get locked out inadvertently, simply remove the code and the Login Page will be accessible once again.


**How to prevent automatic robots.txt rules?**

By default, Blackhole will automatically add the required rules to your site's robots.txt file. This happens *only* when using WordPress' auto-generated robots.txt file.

So if you would rather add the rules yourself, and not have Blackhole make any changes to robots.txt, simply add a physical robots.txt file instead of using the one that otherwise would be generated by WordPress. When an actual/physical robots.txt file exists in your site's root directory, WordPress will *not* auto-generate one, and thus Blackhole will not add any rules or make any changes.


**Got a question?**

Send any questions or feedback via my [contact form](https://plugin-planet.com/support/#contact)



== Changelog ==

If you like Blackhole for Bad Bots, please take a moment to [give a 5-star rating](https://wordpress.org/support/plugin/blackhole-bad-bots/reviews/?rate=5#new-post). It helps to keep development and support going strong. Thank you!


**3.7.4 (2025/03/25)**

* Removes `load_i18n()` function
* Updates documentation about "no cache" policy
* Adds uninstall option `blackhole-bad-bots-dismiss-notice`
* Bumps minimum required WP version
* Updates Help tab information
* Updates plugin documentation
* Generates new language template
* Tests on WordPress 6.8


Full changelog @ [https://plugin-planet.com/wp/changelog/blackhole-bad-bots.txt](https://plugin-planet.com/wp/changelog/blackhole-bad-bots.txt)
