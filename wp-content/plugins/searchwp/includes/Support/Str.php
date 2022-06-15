<?php

namespace SearchWP\Support;

/**
 * String manipulation class.
 *
 * Only general purpose actions are allowed in this class.
 * All actions specific to SearchWP operations should be placed elsewhere.
 *
 * @since 4.2.3
 */
class Str {

	/**
	 * Convert the given string to lower-case.
	 *
	 * @since 4.2.3
	 *
	 * @param string $value Input string.
	 *
	 * @return string
	 */
	public static function lower( string $value ): string {

		return function_exists( 'mb_strtolower' ) ? mb_strtolower( $value ) : strtolower( $value );
	}
}
