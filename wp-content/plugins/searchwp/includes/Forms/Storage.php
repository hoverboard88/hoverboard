<?php

namespace SearchWP\Forms;

use SearchWP\Engine;
use SearchWP\License;
use SearchWP\Settings;
use SearchWP\Statistics;

/**
 * Manage Search Forms DB storage.
 *
 * @since 4.3.2
 */
class Storage {

	/**
	 * Add a new form with default data.
	 *
	 * @since 4.3.2
	 *
	 * @param array $data Non-default form data to apply to a new form.
	 *
	 * @return int Form id.
	 */
	public static function add( $data = [] ) {

		// This method doesn't check if user can create forms.
		// Use \SearchWP\Forms\Storage::current_user_can_create_forms() before using this method.

		$option = self::get_option();

		$id = isset( $option['next_id'] ) ? absint( $option['next_id'] ) : 0;
		$id = ! empty( $id ) ? $id : 1;

		$engine = 'default';
		if ( ! empty( $data['engine'] ) && $data['engine'] !== $engine ) {
			$engine = Settings::get_engine_settings( $data['engine'] ) ? $data['engine'] : $engine;
		}

		$sources = ( new Engine( $engine ) )->get_sources();
		$sources = array_map(
			function ( $source ) {
				return $source->get_name();
			},
			$sources
		);

		$categories = get_terms( [ 'taxonomy' => 'category' ] );
		$categories = array_column( $categories, 'term_id' );

		if ( class_exists( '\SearchWP_Metrics\QueryPopularQueriesOverTime' ) ) {
			$query = new \SearchWP_Metrics\QueryPopularQueriesOverTime(
				[
					'engine' => $engine,
					'after'  => '30 days ago',
				]
			);

			$popular_searches = $query->get_results();
		} else {
			$popular_searches = Statistics::get_popular_searches(
				[
					'days'    => 30,
					'engine'  => $engine,
					'exclude' => Settings::get( 'ignored_queries', 'array' ),
				]
			);
		}
		$popular_searches = wp_list_pluck( $popular_searches, 'query' );
		$popular_searches = array_slice( $popular_searches, 0, 5 );

		$defaults = [
			'title'                   => sprintf(
			/* translators: %d: Form id. */
				__( 'Search Form %d', 'searchwp' ),
				$id
			),
			'engine'                       => 'default',
			'target_url'                   => '/',
			'input_name'                   => 's',
			'template-include-search-form' => true,
			'swp-layout-theme'             => 'basic',
			'category-search'              => false,
			'quick-search'                 => false,
			'advanced-search'              => false,
			'post-type'                    => $sources,
			'category'                     => $categories,
			'field-label'                  => '',
			'search-button'                => true,
			'quick-search-items'           => $popular_searches,
			'advanced-search-filters'      => [ 'authors', 'post_types', 'tags' ],
			'swp-sfinput-shape'            => '',
			'swp-sfbutton-filled'          => '',
			'search-form-color'            => '',
			'search-form-font-size'        => '',
			'button-label'                 => '',
			'button-background-color'      => '',
			'button-font-color'            => '',
			'button-font-size'             => '',
		];

		$form = wp_parse_args( $data, $defaults );

		$form['id'] = $id;

		$option['forms'][ $id ] = $form;
		$option['next_id']      = $id + 1;

		self::update_option( $option );

		return $id;
	}

	/**
	 * Get a single form data.
	 *
	 * @since 4.3.2
	 *
	 * @param int $id Form id.
	 *
	 * @return array
	 */
	public static function get( $id ) {

		$forms = self::get_all();

		$form_id = absint( $id );
		if ( empty( $form_id ) ) {
			return [];
		}

		$form = isset( $forms[ $form_id ] ) ? $forms[ $form_id ] : [];

		return apply_filters( 'searchwp\forms\settings', $form, $form_id );
	}

	/**
	 * Update a single form data.
	 *
	 * @since 4.3.2
	 *
	 * @param int   $id   Form id.
	 * @param array $data Form data.
	 *
	 * @return void
	 */
	public static function update( $id, $data ) {

		$form_id = absint( $id );
		if ( empty( $form_id ) ) {
			return;
		}

		$option = self::get_option();

		$option['forms'][ $form_id ] = $data;

		self::update_option( $option );
	}

	/**
	 * Delete a single form.
	 *
	 * @since 4.3.2
	 *
	 * @param int $id Form id.
	 *
	 * @return void
	 */
	public static function delete( $id ) {

		$option = self::get_option();

		$form_id = absint( $id );
		if ( empty( $form_id ) ) {
			return;
		}

		if ( ! isset( $option['forms'][ $form_id ] ) ) {
			return;
		}

		unset( $option['forms'][ $form_id ] );

		self::update_option( $option );
	}

	/**
	 * Get all forms data.
	 *
	 * @since 4.3.2
	 *
	 * @return array
	 */
	public static function get_all() {

		$option = self::get_option();

		return ! empty( $option['forms'] ) ? $option['forms'] : [];
	}

	/**
	 * Get forms DB option.
	 *
	 * @since 4.3.2
	 *
	 * @return array
	 */
	private static function get_option() {

		return json_decode( Settings::get( 'forms' ), true );
	}

	/**
	 * Update forms DB option.
	 *
	 * @since 4.3.2
	 *
	 * @param array $data Option data.
	 *
	 * @return mixed
	 */
	private static function update_option( $data ) {

		return Settings::update( 'forms', wp_json_encode( $data ) );
	}

	/**
	 * Check if current user can create forms.
	 *
	 * @since 4.3.15
	 *
	 * @return bool
	 */
	public static function current_user_can_create_forms() {

		if ( License::is_active() ) {
			return true;
		}

		$forms_count = count( self::get_all() );

		// Allow one Search Form without an active license.
		if ( $forms_count < 1 ) {
			return true;
		}

		return false;
	}
}
