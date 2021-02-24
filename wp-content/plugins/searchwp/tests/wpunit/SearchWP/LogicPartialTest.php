<?php
namespace SearchWP;

class LogicPartialTest extends \Codeception\TestCase\WPTestCase {
	protected static $factory;
	protected static $post_ids;

	function _before() {
		self::$factory = static::factory();

		$post_ids[] = self::$factory->post->create( [
			'post_title'   => 'Partial test fishing post',
			'post_content' => 'Wildcard content test',
		] );

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'Mouton Rothschild',
		] );

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'Moutasdf Rothasdf',
		] );

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'License',
		] );

		self::$post_ids = $post_ids;

		// Create a Default Engine.
		$engine_model = json_decode( json_encode( new \SearchWP\Engine( 'default' ) ), true );
		\SearchWP\Settings::update_engines_config( [
			'default' => \SearchWP\Utils::normalize_engine_config( $engine_model ),

			// Create Supplemental Engine with stemming enabled.
			'stems' => [
				'sources'  => [
					'post.post' => [
						'attributes' => [ 'title' => 1, 'content' => 1 ],
						'rules'      => [],
						'options'    => [],
					],
				],
				'settings' => [
					'stemming'    => true,
					'adminengine' => false,
				],
			],

			// Test wildcards.
			'wildcard' => [
				'sources'  => [
					'post.post' => [
						'attributes' => [ 'content' => 1 ],
						'rules'      => [],
						'options'    => [],
					],
				],
				'settings' => [
					'stemming'    => true,
					'adminengine' => false,
				],
			],

			// HS13719.
			'hs13719' => [
				'sources'  => [
					'post.post' => [
						'attributes' => [ 'title' => 1 ],
						'rules'      => [],
						'options'    => [],
					],
				],
				'settings' => [
					'stemming'    => false,
					'adminengine' => false,
				],
			],
		] );

		foreach ( self::$post_ids as $post_id ) {
			\SearchWP::$index->add( new \SearchWP\Entry( 'post' . SEARCHWP_SEPARATOR . 'post', $post_id ) );
		}
	}

	function _after() {
		$index = \SearchWP::$index;
		$index->reset();

		\SearchWP\Settings::update_engines_config( [] );
	}

	public function test_that_partial_match_returns_correct_result() {
		add_filter( 'searchwp\query\partial_matches', '__return_true' );

		$results = new \SWP_Query( [
			'engine' => 'default',
			's'      => 'fish',
			'fields' => 'ids',
		] );

		remove_filter( 'searchwp\query\partial_matches', '__return_true' );

		// That there was 1 result returned.
		$this->assertEquals( 1, count( $results->posts ) );
		$this->assertArrayHasKey( 0, $results->posts );

		// That the result is in our IDs.
		$this->assertContains(
			$results->posts[0],
			self::$post_ids
		);
	}

	/**
	 * Test that a fuzzy match is not found when fuzzy matching is disabled.
	 */
	public function test_that_partial_mismatch_returns_no_result() {
		add_filter( 'searchwp\query\partial_matches', '__return_true' );
		add_filter( 'searchwp\query\partial_matches\fuzzy', '__return_false' );

		$results = new \SWP_Query( [
			'engine' => 'default',
			's'      => 'fishy',
		] );

		remove_filter( 'searchwp\query\partial_matches\fuzzy', '__return_false' );
		remove_filter( 'searchwp\query\partial_matches', '__return_true' );

		$this->assertTrue( empty( $results->posts ) );
	}

	/**
	 * Test that stemming is applied to partial matching.
	 */
	public function test_that_stems_apply() {
		$results = new \SWP_Query( [
			'engine' => 'stems',
			's'      => 'fish',
		] );

		$this->assertTrue( ! empty( $results->posts ) );
	}

	/**
	 * Test that partials can be forced without requiring wildcard before.
	 *
	 * @return void
	 */
	public function test_that_disabling_adaptive_applies() {
		add_filter( 'searchwp\query\partial_matches', '__return_true' );
		add_filter( 'searchwp\query\partial_matches\force', '__return_true' );
		add_filter( 'searchwp\query\partial_matches\adaptive', '__return_false' ); // Prevent adapting by adding wildcard before.

		$results = new \SWP_Query( [
			's'      => 'ildcar', // The token in question is 'wildcard'.
			'engine' => 'wildcard',
		] );

		remove_filter( 'searchwp\query\partial_matches', '__return_true' );
		remove_filter( 'searchwp\query\partial_matches\force', '__return_true' );
		remove_filter( 'searchwp\query\partial_matches\adaptive', '__return_false' );

		// Wildcard before has been intentionally disabled so there should be no result.
		$this->assertTrue( empty( $results->posts ) );
	}

	/**
	 * Test that adaptive partial matching (before and after wildcard) applies.
	 *
	 * @return void
	 */
	public function test_that_adaptive_applies() {
		add_filter( 'searchwp\query\partial_matches', '__return_true' );

		$results = new \SWP_Query( [
			's'      => 'ildcar', // The token in question is 'wildcard'.
			'engine' => 'wildcard',
		] );

		$this->assertTrue( ! empty( $results->posts ) );

		remove_filter( 'searchwp\query\partial_matches', '__return_true' );
	}

	/**
	 * Test that adaptive is not necessary if wildcard before is added.
	 *
	 * @return void
	 */
	public function test_that_disabling_adaptive_is_not_necessary() {
		add_filter( 'searchwp\query\partial_matches', '__return_true' );
		add_filter( 'searchwp\query\partial_matches\wildcard_before', '__return_true' );
		add_filter( 'searchwp\query\partial_matches\adaptive', '__return_false' );

		$results = new \SWP_Query( [
			's'      => 'ildcar', // The token in question is 'wildcard'.
			'engine' => 'wildcard',
		] );

		$this->assertTrue( ! empty( $results->posts ) );

		remove_filter( 'searchwp\query\partial_matches', '__return_true' );
		remove_filter( 'searchwp\query\partial_matches\wildcard_before', '__return_true' );
		remove_filter( 'searchwp\query\partial_matches\adaptive', '__return_false' );
	}

	public function test_forced_and_logic_all_partial_terms() {
		add_filter( 'searchwp\query\partial_matches', '__return_true' );
		add_filter( 'searchwp\query\partial_matches\force', '__return_true' );
		add_filter( 'searchwp\query\partial_matches\wildcard_before', '__return_false' );
		add_filter( 'searchwp\query\partial_matches\adaptive', '__return_false' );
		add_filter( 'searchwp\query\logic\and\strict', '__return_true' );
		add_filter( 'searchwp\query\partial_matches\fuzzy', '__return_false' );

		$results = new \SWP_Query( [
			's'      => 'Mout Roth', // Both are partial matches and should return two results.
			'engine' => 'hs13719',
		] );

		$this->assertTrue( ! empty( $results->posts ) );

		remove_filter( 'searchwp\query\partial_matches', '__return_true' );
		remove_filter( 'searchwp\query\partial_matches\force', '__return_true' );
		remove_filter( 'searchwp\query\partial_matches\wildcard_before', '__return_false' );
		remove_filter( 'searchwp\query\partial_matches\adaptive', '__return_false' );
		remove_filter( 'searchwp\query\logic\and\strict', '__return_true' );
		remove_filter( 'searchwp\query\partial_matches\fuzzy', '__return_false' );
	}

	public function test_that_trailing_spaces_are_ignored() {
		add_filter( 'searchwp\query\partial_matches', '__return_true' );

		$results = new \SWP_Query( [
			's'      => 'Partia ',
			'engine' => 'default',
		] );

		$this->assertTrue( ! empty( $results->posts ) );

		remove_filter( 'searchwp\query\partial_matches', '__return_true' );
	}

	public function test_that_exact_matches_with_stems_works() {
		add_filter( 'searchwp\query\partial_matches', '__return_true' );

		$results = new \SWP_Query( [
			's'      => 'license',
			'engine' => 'stems',
		] );

		$this->assertTrue( ! empty( $results->posts ) );

		$results = new \SWP_Query( [
			's'      => 'licensing',
			'engine' => 'stems',
		] );

		$this->assertTrue( ! empty( $results->posts ) );

		remove_filter( 'searchwp\query\partial_matches', '__return_true' );
	}
}
