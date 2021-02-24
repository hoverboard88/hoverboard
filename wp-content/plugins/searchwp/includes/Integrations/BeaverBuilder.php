<?php

/**
 * SearchWP BeaverBuilder.
 *
 * @package SearchWP
 * @author  Jon Christopher
 */

namespace SearchWP\Integrations;

/**
 * Class BeaverBuilder is responsible for customizing SearchWP's Native implementation to work with BeaverBuilder queries.
 *
 * @since 4.1.5
 */
class BeaverBuilder extends PageBuilder {

	/**
	 * Name used for canonical reference to Integration.
	 *
	 * @since 4.1.5
	 * @var   string
	 */
	protected $name = 'beaver-builder';

	/**
	 * Constructor.
	 *
	 * @since 4.1.8
	 * @return void
	 */
	public function __construct() {
		if ( ! has_action( 'parse_query', [ $this, 'maybe_integrate' ] ) ) {
			add_action( 'parse_query', [ $this, 'maybe_integrate' ] );
		}
	}

	/**
	 * Integrate when Beaver Builder Themer is used for a Search Archive.
	 *
	 * @since 4.1.8
	 */
	public function maybe_integrate() {
		if ( ! is_search() ) {
			return;
		}

		if ( ! class_exists( '\\FLThemeBuilderLayoutData' ) ) {
			return;
		}

		// Make sure Beaver Builder Themer is being used for this archive.
		$layouts = \FLThemeBuilderLayoutData::get_current_page_layouts( 'archive' );

		if ( 0 == count( $layouts ) ) {
			return;
		}

		$types     = wp_list_pluck( $layouts, 'type' );
		$locations = call_user_func_array( 'array_merge',
			array_values( wp_list_pluck( $layouts, 'locations' ) ) );

		if ( ! in_array( 'archive', $types, true ) || ! in_array( 'general:search', $locations, true ) ) {
			return;
		}

		$this->modify_native_behavior();

		// Prevent redundancy.
		remove_action( 'parse_query', [ $this, 'maybe_integrate' ] );
	}
}
