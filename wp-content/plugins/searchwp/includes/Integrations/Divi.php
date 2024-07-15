<?php
/**
 * SearchWP Divi Integration.
 *
 * @package SearchWP
 * @author  Jon Christopher
 */

namespace SearchWP\Integrations;

/**
 * Class Divi is responsible for customizing SearchWP's Native implementation to work with Divi queries.
 *
 * @since 4.3.16
 */
class Divi {

	/**
	 * Constructor.
	 *
	 * @since 4.3.16
	 */
	public function __construct() {

		/**
		 * Filter to fetch the SearchWP results.
		 */
		add_filter(
			'searchwp\query\results',
			[ $this, 'get_search_results' ],
			10,
			2
		);

		/**
		 * Filter to add SearchWP Indexer action to the Divi load requests.
		 */
		add_filter(
			'et_builder_load_requests',
			[ $this, 'add_searchwp_indexer_action' ],
			10
		);
	}

	/**
	 * Inject the SearchWP results into WordPress query.
	 *
	 * @since 4.3.16
	 *
	 * @param array  $results   The SearchWP results.
	 * @param object $swp_query The SearchWP query object.
	 *
	 * @return mixed
	 */
	public function get_search_results( $results, $swp_query ) {

		/**
		 * Filters the posts before the query is run.
		 * This is where we inject the SearchWP results.
		 *
		 * @since 4.3.16
		 *
		 * @param array  $posts     The posts to be returned.
		 * @param object $wp_query  The WP_Query object.
		 */
		add_filter(
			'posts_pre_query',
			function ( $posts, $wp_query ) use ( $results, $swp_query ) {

				if ( $wp_query->is_search() ) {
					$wp_query->found_posts   = $swp_query->found_results;
					$wp_query->max_num_pages = $swp_query->max_num_pages;

					return $results;
				}

				return $posts;
			},
			10,
			2
		);

		return $results;
	}

	/**
	 * Add the SearchWP Indexer action to the Divi load requests.
	 *
	 * @since 4.3.16
	 *
	 * @param array $et_builder_load_requests The load requests.
	 *
	 * @return array
	 */
	public function add_searchwp_indexer_action( $et_builder_load_requests ) {

			$et_builder_load_requests['action'][] = 'searchwp_indexer';

			return $et_builder_load_requests;
	}
}
