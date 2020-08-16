=== EWWW Image Optimizer Cloud ===
Contributors: nosilver4u
Tags: optimize, image, convert, webp, resize, compress, lazy load, optimization, lossless, lossy, seo, scale
Requires at least: 5.2
Tested up to: 5.5
Requires PHP: 5.6
Stable tag: 5.6.2
License: GPLv3

Speed up your website to better connect with your visitors. Properly compress and size/scale images. Includes lazy load and WebP convert.

== Description ==

The EWWW Image Optimizer (cloud edition) will increase your page speeds by way of image optimization. Increased page speeds can result in better search engine rankings, and will also improve conversion rates (increased sales and signups). It will also save you storage space and bandwidth. While EWWW I.O. will automatically optimize new images that you upload, it can also optimize all the images that you have already uploaded, and optionally convert your images to the best file format. You can choose pixel perfect compression or high compression options that are visually lossless. The cloud edition is being phased out in favor of the core EWWW Image Optimizer plugin.

EWWW I.O. will optimize images uploaded and created by any plugin, and features special integrations with many popular plugins, detailed below.

**Why use EWWW Image Optimizer?**

1. **No Speed Limits** and [unlimited file size](https://ewww.io/unlimited-file-size/).
1. **Smooth Handling** with pixel-perfect optimization using industry-leading tools and progressive rendering.
1. **High Torque** as we bring you the best compression/quality ratio available with our lossy options for JPG, PNG, and PDF files.
1. **Adaptive Steering** with intelligent conversion options to get the right image format for the job (JPG, PNG, or GIF).
1. **Metered Parking** means you never pay for an image we can’t compress, you are never billed for a month you do not use the API, and pre-paid credits never expire. Plus, get WebP image generation at no extra cost: any JPG or PNG can be converted to Google’s next-generation image format.
1. **Comprehensive Coverage:** no image gets left behind, optimize everything on your site, beyond just the WordPress Media Library.
1. **Safety First:** all communications are secured with top SSL encryption.
1. **Roadside Assistance:** top-notch support is in our DNA. For priority assistance, be sure to use your registered email or mention your registered email when you [contact us for help](https://ewww.io/contact-us/).
1. **Pack a Spare:** free image backups store your original images for 30 days.

Images are optimized via specialized servers that utilize the best tools available in lossless or lossy mode. Our lossy compression uses unique algorithms to gain maximum compression while remaining visually lossless. Your images can even be converted to the most suitable file format using the appropriate options. Using the EWWW I.O. API will allow the plugin to work on any hosting platform, and can also be desirable if you cannot, or do not want to use the exec() function on your server, or prefer to offload the resource demands of optimization.

= Automatic Everything =

With Easy IO, images are automatically compressed, scaled to fit the page and device size, lazy loaded, and converted to the next-gen WebP format.

= Support =

If you need assistance using the plugin, please visit our [Support Page](https://ewww.io/contact-us/).

= Bulk Optimize =

Optimize all your images from a single page using the Bulk Scanner. This includes the Media Library, your theme, and a handful of pre-configured folders (see Optimize Everything Else below). Officially supported galleries (GRAND FlaGallery, NextCellent, and NextGEN) have their own Bulk Optimize pages.

= Optimize Everything Else =

Configure any folder within your WordPress folder to be optimized. The Bulk Scan under Media->Bulk Optimize will optimize theme images, BuddyPress avatars, BuddyPress Activity Plus images, Meta Slider slides, WP Symposium Pro avatars, GD bbPress attachments, Grand Media Galleries, and any user-specified folders. Additionally, this tool can run on an hourly basis via wp_cron to keep newly uploaded images optimized. Scheduled optimization should not be used for any plugin that uses the built-in Wordpress image functions.

= Skips Previously Optimized Images =

All optimized images are stored in the database so that the plugin does not attempt to re-optimize them unless they are modified. On the Bulk Optimize page you can view a list of already optimized images. You may also remove individual images from the list, or use the Force optimize option to override the default behavior. The re-optimize links on the Media Library page also force the plugin to ignore the previous optimization status of images.

= WP Image Editor =

All images created by the built-in WP_Image_Editor class will be automatically optimized. Current implementations are GD, Imagick, and Gmagick. Images optimized via this class include Animated GIF Resize, BuddyPress Activity Plus (thumbs), Easy Watermark, Hammy, Imsanity, MediaPress, Meta Slider, MyArcadePlugin, OTF Regenerate Thumbnails, Regenerate Thumbnails, Simple Image Sizes, WP Retina 2x, WP RSS Aggregator and probably countless others. If you are not sure if a plugin uses WP_Image_Editor, [just ask](https://ewww.io/contact-us/).

= WebP Images =

Automatic WebP conversion with Easy IO, no additional configuration. Otherwise, can generate WebP versions of your images, and enables you to serve even smaller images to supported browsers. Several methods are available for serving WebP images, including Apache-compatible rewrite rules and our JS WebP Rewriting option compatible with caches and CDNs. Also works with the WebP option in the Cache Enabler plugin from KeyCDN.

= WP-CLI =

Allows you to run all Bulk Optimization processes from your command line, instead of the web interface. It is much faster, and allows you to do things like run it in 'screen' or via regular cron (instead of wp-cron, which can be unpredictable on low-traffic sites). Install WP-CLI from wp-cli.org, and run 'wp-cli.phar help ewwwio optimize' for more information or see the [Docs](https://docs.ewww.io/article/25-optimizing-with-wp-cli).

= FooGallery =

All images uploaded and cached by FooGallery are automatically optimized. Previous uploads can be optimized by running the Media Library Bulk Optimize. Previously cached images can be optimized by entering the wp-content/uploads/cache/ folder under Folders to Optimize and running a Scan & Optimize from the Bulk Optimize page.

= NextGEN Gallery =

Features optimization on upload capability, re-optimization, and bulk optimizing. The NextGEN Bulk Optimize function is located near the bottom of the NextGEN menu, and will optimize all images in all galleries. It is also possible to optimize groups of images in a gallery, or multiple galleries at once.

= NextCellent Gallery =

Features all the same capability as NextGEN, and is the continuation of legacy (1.9.x) NextGEN support.

= GRAND Flash Album Gallery =

Features optimization on upload capability, re-optimization, and bulk optimizing. The Bulk Optimize function is located near the bottom of the FlAGallery menu, and will optimize all images in all galleries. It is also possible to optimize groups of images in a gallery, or multiple galleries at once.

= Image Store =

Uploads are automatically optimized. Look for Optimize under the Image Store (Galleries) menu to see status of optimization and for re-optimization and bulk-optimization options. Using the Bulk Optimization tool under Media Library automatically includes all Image Store uploads.

= CDN Support =

[WP Offload Media](https://wordpress.org/plugins/amazon-s3-and-cloudfront/) is the officially supported (and recommended) plugin for uploads to Amazon S3 and Digital Ocean Spaces. We also support the Azure Storage and Cloudinary plugins. All pull mode CDNs like Cloudflare, KeyCDN, MaxCDN, and Sucuri CloudProxy work automatically, but will require you to purge the cache after a bulk optimization.

= WPML Compatible =

Tested regularly to ensure compatibility with multilingual sites. Learn more at https://wpml.org/plugin/ewww-image-optimizer/

= Translations =

Huge thanks to all our translators! See the full list here: https://translate.wordpress.org/projects/wp-plugins/ewww-image-optimizer-cloud/contributors

If you would like to help translate this plugin (new or existing translations), you can do so here: https://translate.wordpress.org/projects/wp-plugins/ewww-image-optimizer-cloud
To receive updates when new strings are available for translation, you can signup here: https://ewww.io/register/

== Installation ==

1. Upload the 'ewww-image-optimizer-cloud' plugin to your '/wp-content/plugins/' directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Purchase an API key via https://ewww.io/plans/.
1. Enter your API key on the plugin settings page.
1. *Optional* Visit the settings page to adjust compression levels and turn on advanced optimization features.
1. Done!

Additional documentation can be found at https://docs.ewww.io. If you need further assistance using the plugin, please visit our [Support Page](https://ewww.io/contact-us/). The forums are community supported only.

== Frequently Asked Questions ==

= Google Pagespeed says my images need compressing or resizing, but I already optimized all my images. What do I do? =

https://docs.ewww.io/article/5-pagespeed-says-my-images-need-more-work

= Does the plugin replace existing images? =

Yes, but only if the optimized version is smaller. The plugin should NEVER create a larger image.

= Can I resize my images with this plugin? =

Yes, you can, set it up on the Resize tab.

= Can I lower the compression setting for JPGs to save more space? =

The lossy JPG optimization using TinyJPG and JPEGmini will determine the ideal quality setting and give you the best results, but you can also adjust the default quality for conversion and resizing. More information: https://docs.ewww.io/article/12-jpq-quality-and-wordpress

= The bulk optimizer doesn't seem to be working, what can I do? =

See https://docs.ewww.io/article/39-bulk-optimizer-failure for full troubleshooting instructions.

= I want to know more about image optimization. =

That's not really a question, but since I made it up, I'll answer it. See this resource:
https://developers.google.com/web/tools/lighthouse/audits/optimize-images

== Changelog ==

* Feature requests can be viewed and submitted at https://feedback.ewww.io
* If you would like to help translate this plugin in your language, get started here: https://translate.wordpress.org/projects/wp-plugins/ewww-image-optimizer-cloud/

= 5.6.2 =
* fixed: fatal error for undefined add_query_var

= 5.6.1 =
* changed: prevent unintentional image re-optimization from plugins with a threshold of 5x, indicate intential regen with ewww_image_optimizer_allowed_reopt filter
* changed: include lazy load and WebP in optimization score
* fixed: query paramaters added to videos via image_downsize filter
* fixed: WP-CLI command triggers async queueing
* fixed: WPML check skips too many images during bulk scanner
* fixed: WP-CLI command options for FlAGallery and NextGEN using outdated code
* fixed: re-optimization tracker not tracking

= 5.6.0 =
* added: tool to remove originals for converted images
* changed: improved handling of WPML replicas in media library list mode and bulk optimizer
* fixed: JS WebP, picture WebP, and Easy IO errors with WP Offload Media 2.4
* fixed: JS WebP cannot find local paths when WP_CONTENT_DIR is outside ABSPATH
* fixed: Easy IO hard crops images when requested height/width is 9999
* fixed: Lazy Load and WebP parsers running on customizer preview pane

= 5.5.0 =
* added: GIF to WebP conversion with API and Easy IO
* changed: core plugin removed from disallowed list on WP Engine, you can switch to that now!
* changed: disable Lazy Load auto-scale by defining EIO_LL_AUTOSCALE as false
* fixed: async functions use of wp_die causes empty errors when wp_cron is run from WP-CLI
* fixed: big image size filter throws error when other plugins run the filter with fewer than 3 parameters
* fixed: styling broken for optimization info on Nextgen gallery pages
* fixed: broken link for network admin settings from single-site plugins page

= 5.4.1 =
* fixed: Bulk Optimizer sticks on stage 2 when there are no images to optimize
* fixed: transparency in PNG images with color type 0 or 2 not detected
* fixed: transparency false positives for PNG images with color types 4 and 6
* fixed: lazy load skips img elements with unquoted src attributes
* fixed: images converted by PNG to JPG (and friends) do not have restore links in library

= 5.4.0 =
* added: EXACTDN_DEFER_JQUERY_SAFE override for when inline scripts depend on jQuery
* changed: code rewrite to validate output escaping, input sanitization, and markup on settings page
* changed: use data-cfasync=false to prevent deferring inline JS WebP script
* changed: Easy IO uses better query-string fall-back for plugins
* changed: Easy IO enforces https if available rather than protocol-relative URLs
* changed: resize detection ignores images smaller than 25px
* changed: settings streamlined when using Easy IO
* fixed: parallel optimization on multisite fails due to missing db prefix
* fixed: error when saving JS WebP on network/multsite admin
* fixed: images not resized when Media File Renamer is active
* fixed: PHP warning while using <picture> WebP
* fixed: Lazy Load, JS WebP and <picture> WebP have nested fall-back img elements if an image is found multiple times in a page
* fixed: Easy IO mangles srcset URLs when src URL is relative instead of absolute
* fixed: Easy IO URLs leaking into block editor for new uploads
* fixed: WebP rewriting with WP Offload Media skips sub-domains of blog domain
* deprecated: support for Image Store plugin (abandoned)

= 5.3.2 =
* added: defer jQuery also with EXACTDN_DEFER_JQUERY override
* added: Lazy Load supports VC grid layouts retrieved via AJAX
* fixed: Lazy Load and JS WebP prevent loading of images in oEmbed endpoint
* fixed: jQuery exclusion was preventing deferral of jQuery extensions also
* fixed: Lazy Load parsing Owl Lazy images
* fixed: Easy IO adds srcset/sizes to feeds
* fixed: filename in attachment metadata not updated for duplicate thumbnails after conversion success
* fixed: notices for undefined variables during bulk optimize

= 5.3.1 =
* added: defer JS with Easy IO via EXACTDN_DEFER_SCRIPTS override
* fixed: warning related to user-defined exclusions in JS and picture WebP
* fixed: AMP compatiblity for Lazy Load and WebP rewriters was broken
* fixed: images not loading on WPURP/WPRM print recipe pages

= 5.3.0 =
* added: Easy IO replaces image URLs within style elements for page builders like Elementor and Divi
* added: option to use <picture> tags for WebP rewriting
* added: ability to define exclusions for JS WebP and <picture> WebP
* added: include .webp images when using WP Offload Media to copy images from bucket to server
* added: cleanup/migration tool for folks using EWWW IO 3+ years to remove old metadata entries
* added: fetch original_image for optimization when local images are removed (WP Offload Media and Microsoft Azure Storage for WordPress)
* changed: scheduled optimizer uses async/background mode to prevent timeouts
* changed: images that exceed the max resize dimensions will be queued by the bulk scanner even if previously compressed
* changed: for security, EWWW IO will only optimize images within the WP root folder, content folder, or uploads folder
* changed: WebP Only mode will bypass the check for TinyPNG compression
* changed: background/async mode uses better queueing system for speed and reliability
* changed: image queue information moved to Tools page
* changed: image re-opt troubleshooting moved to Tools page
* fixed: noresize in filename has no effect when using Media File Renamer
* fixed: debug_message() throws a warning with non-string values
* fixed: notices when uploading animated GIFs using GD
* fixed: notices when parsing JSON data from Envira
* fixed: fatal error when a WP_Error is passed from Envira to Easy IO
* fixed: Include All Resources rewrites wrong URLs when quotes are html-encoded
* fixed: <picture> tags do not follow Lazy Load exclusions
* fixed: <picture> tags broken when exluding images from Lazy Load
* fixed: Azure storage plugin doesn't re-upload optimized images

= Earlier versions =
Please refer to the separate changelog.txt file.

== Credits ==

Written by [Shane Bishop](https://ewww.io) with special thanks to my [Lord and Savior](https://www.iamsecond.com/). Based upon CW Image Optimizer, which was written by [Jacob Allred](http://www.jacoballred.com/) at [Corban Works, LLC](http://www.corbanworks.com/). CW Image Optimizer was based on WP Smush.it. Jpegtran is the work of the Independent JPEG Group. PEL is the work of Martin Geisler, Lars Olesen, and Erik Oskam. Easy IO and HTML parsing classes based upon the Photon module from Jetpack.
