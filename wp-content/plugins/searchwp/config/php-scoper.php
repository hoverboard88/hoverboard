<?php

declare( strict_types=1 );

/**
 * PHP SCOPER BASE CONFIGURATION
 *
 * This configuration defines the way PHP Scoper @link https://github.com/humbug/php-scoper
 * will apply a custom prefix to all namespaces in the Composer packages we're using.
 *
 * This is necessary because WordPress does not have a proper method of handling dependencies
 * and as a result if multiple Plugins (or Themes, or custom code) are using the same Composer
 * packages, we'll end up in a race condition regarding which version is loaded. This is not ideal.
 *
 * PHP Scoper applies a custom namespace to all of the Composer packages in use by SearchWP
 * and relocates the prefixed versions into the `lib` directory. PHP Scoper also generates its
 * own `scoper-autoload.php` to handle additional class handling. Instead of SearchWP relying on
 * Composer's generated `autoload.php` we are instead fully relying on PHP Scoper's generated packages.
 *
 * That said, any time a Composer does something, PHP Scoper is run to generate an up-to-date autoloader.
 *
 * To manually regenerate a new `lib` and autoloader, fire this command:
 *     `composer php-scoper`
 *
 */

use Isolated\Symfony\Component\Finder\Finder;

return [
	'expose-global-classes' => false,
	'finders'               => [
		Finder::create()
		      ->files()
		      ->ignoreVCS( true )
		      ->notName( '/LICENSE|.*\\.md|.*\\.dist|psalm.xml|CHANGELOG\\.TXT|VERSION|Makefile|composer\\.json|composer\\.lock/' )
		      ->exclude(
			      [
				      'doc',
				      'bin',
				      'test',
				      'Test',
				      'test_old',
				      'tests',
				      'Tests',
				      'vendor-bin',
				      'node_modules',
				      'examples',
				      'fonts',
				      'tools',
				      'samples',
				      'Samples',
			      ]
		      )
		      ->in(
			      [
				      __DIR__ . '/../vendor/dekor',
				      __DIR__ . '/../vendor/henck',
				      __DIR__ . '/../vendor/monolog',
				      __DIR__ . '/../vendor/smalot',
				      __DIR__ . '/../vendor/wamania',
				      __DIR__ . '/../vendor/psr',
				      __DIR__ . '/../vendor/symfony/polyfill-mbstring',
			      ]
		      ),
	],
	'patchers'              => [
		/**
		 * Prefix the dynamic class generation in Smalot PdfParser lib.
		 *
		 * @param string $file_path The path of the current file.
		 * @param string $prefix The prefix to be used.
		 * @param string $content The content of the specific file.
		 *
		 * @return string The modified content.
		 */
		static function ( $file_path, string $prefix, string $content ): string {

			if ( strpos( $file_path, 'smalot/pdfparser/src/Smalot/PdfParser/PDFObject.php' ) !== false ) {
				$content = str_replace(
					'$classname = \'\\\\Smalot\\\\PdfParser\\\\Font\\\\Font\' . $subtype;',
					'$classname = \'' . addslashes( $prefix ) . '\\\\Smalot\\\\PdfParser\\\\Font\\\\Font\' . $subtype;',
					$content
				);
			}

			if ( strpos( $file_path, 'smalot/pdfparser/src/Smalot/PdfParser/Encoding.php' ) !== false ) {
				$content = str_replace(
					'$className = \'\\\\Smalot\\\\PdfParser\\\\Encoding\\\\\' . $baseEncoding;',
					'$className = \'' . addslashes( $prefix ) . '\\\\Smalot\\\\PdfParser\\\\Encoding\\\\\' . $baseEncoding;',
					$content
				);
			}

			return $content;
		},
	],
];
