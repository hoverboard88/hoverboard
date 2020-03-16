=== EWWW Image Optimizer Cloud ===
Contributors: nosilver4u
Tags: optimize, image, convert, webp, resize, compress, lazy load, optimization, lossless, lossy, seo, scale
Requires at least: 5.0
Tested up to: 5.3
Requires PHP: 5.6
Stable tag: 5.2.2
License: GPLv3

Speed up your website to better connect with your visitors. Properly compress and size/scale images. Includes lazy load and WebP convert.

== Description ==

The EWWW Image Optimizer (cloud edition) will increase your page speeds by way of image optimization. Increased page speeds can result in better search engine rankings, and will also improve conversion rates (increased sales and signups). It will also save you storage space and bandwidth. While EWWW I.O. will automatically optimize new images that you upload, it can also optimize all the images that you have already uploaded, and optionally convert your images to the best file format. You can choose pixel perfect compression or high compression options that are visually lossless. The cloud edition features all the same options as the core EWWW Image Optimizer without the security risk associated with the exec() function. Built exclusively for the EWWW I.O. API, it is lightweight and much quicker when updating.

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

* Feature requests can be viewed and submitted at https://github.com/nosilver4u/ewww-image-optimizer/labels/enhancement
* If you would like to help translate this plugin in your language, get started here: https://translate.wordpress.org/projects/wp-plugins/ewww-image-optimizer-cloud/

= 5.2.2
* added: automatic plan upgrade detection
* changed: better compatibility with other implementations of "native lazy load"
* updated: lazysizes.js to version 5.2
* fixed: custom domain for Easy IO prevents auto-scaling
* fixed: full-width background images auto-scaled due to scroll bars
* fixed: overrides for array-style exclusions not being applied

= 5.2.1 =
* changed: WebP rewrite rules hidden for Cloudflare-protected sites
* fixed: Smart Re-optimize not working for PDF files
* fixed: Easy IO detects wrong domain when using separate domains for site and content

= 5.2.0 =
* added: Lazy Load, JS WebP, and Easy IO support background images on link elements
* added: JS WebP supports background images on section, span, and li elements
* added: exclude images from Easy IO in settings
* added: exclude images from Lazy Load by string or class name
* added: prevent auto-scaling with skip-autoscale
* added: Folders to Optimize, Folders to Ignore, Lazy Load Exclusions, Easy IO Exclusions, and WebP URLs can be defined as overrides (single value as string, multiple values as an array)
* added: API key, JPG Background (for conversion only), and Disabled Resizes can be defined as overrides, see https://docs.ewww.io/article/40-override-options
* added: PNG placeholders for Lazy Load retrieved direct from API for drastically reduced memory usage
* added: Smart Re-optimize option available on Bulk Optimizer if you want to re-optimize images that were compressed on a different setting
* added: auto-restore for Smart Re-optimize when going from lossy to lossless mode
* added: Restore & Re-optimize from Media Library to change individual images from lossy to lossless
* added: search function for Optimized Images table (Tools menu)
* added: table cleanup for database table (Tools menu)
* fixed: errors due to duplicate ssl= arguments in URLs
* fixed: JS WebP has incorrect selector for video elements (props @CharlieHawker)
* updated: embedded help code for better debug prefill

= 5.1.4 =
* fixed: warnings on FlaGallery's manage gallery page
* fixed: EWWW IO resize limits are ignored when higher than WP default
* fixed: WebP images not removed from remote storage when an attachment is deleted (WP Offload Media)
* fixed: after running regen for single thumbs with Image Regenerate & Select Crop plugin, regenerated images were not automatically optimized

= 5.1.3 =
* added: better compatibility with Divi filterable grid images and parallax backgrounds
* added: cleanup .webp and database records when using Enable Media Replace
* fixed: Divi builder will not load with Easy IO and Include All Resources active
* fixed: image cover block with fixed width scaled too much
* fixed: PNG placeholders could use more memory than available
* removed: Lazy Load CSS gradient for blank placeholders

= 5.1.2 =
* added: disable native lazy-load attributes with EWWWIO_DISABLE_NATIVE_LAZY
* added: ability to choose LQIP or blank placeholders for lazy load
* changed: renaming ExactDN as Easy IO
* changed: default to blank placeholders with Easy IO
* changed: regenerated images are automatically re-optimized after running Image Regenerate & Select Crop plugin
* fixed: low-quality placeholders sometimes had larger dimensions than necessary
* fixed: database records and .webp images are not removed when Image Regenerate & Select Crop plugin deletes a thumbnail
* fixed: path traversal protection preventing normal files from optimizing
* fixed: Slider Revolution dummy.png not properly handled by Easy IO

= 5.1.1 =
* fixed: warning thrown by implode() when JS WebP is enabled with no WebP URLs

= 5.1.0 =
* added: WebP-only mode for Bulk Optimizer
* added: JS WebP Rewriting for pull-mode CDNs via WebP URLS without Force WebP
* added: JS WebP Rewriting zero-conf for WP Offload Media
* added: force lossy PNG to WebP conversion with EWWW_IMAGE_OPTIMIZER_LOSSY_PNG2WEBP override (set to true)
* changed: bulk optimizer runs wp_update_attachment_metadata() in separate request to avoid timeouts
* fixed: WebP warning regarding missing modules displayed even if green WebP test image is working
* fixed: Nextgen bulk actions not working
* fixed: unable to regenerate existing thumbnails with Image Regenerate & Select Crop plugin

= 5.0.0 =
* added: use native lazy load attributes to supplement lazy loader and make placeholders more efficient
* added: GCS sub-folder rewriting with ExactDN for cleaner URLs
* added: option to optimize original versions of scaled images for WP 5.3
* added: ability to erase optimization history from Tools page
* changed: define EWWWIO_WPLR_AUTO (any value) to enable auto-optimize on images from WP/LR Sync
* changed: thumbnails could be converted even if original was not
* changed: Show Optimized Images table moved to Tools menu
* fixed: full-size image optimization not deferred if scaled by WP 5.3
* fixed: data-width and data-height attributes missing when JS WebP active

= Earlier versions =
Please refer to the separate changelog.txt file.

== Credits ==

Written by [Shane Bishop](https://ewww.io) with special thanks to my [Lord and Savior](https://www.iamsecond.com/). Based upon CW Image Optimizer, which was written by [Jacob Allred](http://www.jacoballred.com/) at [Corban Works, LLC](http://www.corbanworks.com/). CW Image Optimizer was based on WP Smush.it. Jpegtran is the work of the Independent JPEG Group. PEL is the work of Martin Geisler, Lars Olesen, and Erik Oskam. Easy IO and HTML parsing classes based upon the Photon module from Jetpack.
