<?php
namespace SearchWP;

class LogicAndTest extends \Codeception\TestCase\WPTestCase {
	protected static $factory;
	protected static $post_type;
	protected static $post_ids;

	function _before() {
		self::$factory = static::factory();
		self::$post_type = 'post' . SEARCHWP_SEPARATOR . 'post';

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'lorem ipsum dolor sit amet',
		] );

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'lorem amet',
		] );

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'fishing running hiking',
		] );

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'fishing lorem',
		] );

		self::$post_ids = $post_ids;

		// Create a Default Engine.
		$engine_model = json_decode( json_encode( new \SearchWP\Engine( 'default' ) ), true );
		\SearchWP\Settings::update_engines_config( [
			'default' => \SearchWP\Utils::normalize_engine_config( $engine_model ),

			'andstemmed' => [
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
		] );

		foreach ( self::$post_ids as $post_id ) {
			\SearchWP::$index->add(
				new \SearchWP\Entry( self::$post_type, $post_id )
			);
		}
	}

	function _after() {
		$index = \SearchWP::$index;
		$index->reset();

		\SearchWP\Settings::update_engines_config( [] );
	}

	/**
	 * Both posts have both words, so both should be returned.
	 */
	public function test_multiple_matches() {
		$results = new \SWP_Query( [
			'engine'         => 'default',
			's'              => 'lorem amet',
			'fields'         => 'ids',
		] );

		$this->assertEquals( 2, count( $results->posts ) );
		$this->assertArrayHasKey( 0, $results->posts );
		$this->assertArrayHasKey( 1, $results->posts );

		$this->assertContains( $results->posts[0], self::$post_ids );
		$this->assertContains( $results->posts[1], self::$post_ids );
	}

	/**
	 * Only one post has both words so it should be the only result.
	 */
	public function test_single_match() {
		$results = new \SWP_Query( [
			'engine'         => 'default',
			's'              => 'lorem ipsum',
			'fields'         => 'ids',
		] );

		$this->assertEquals( 1, count( $results->posts ) );
		$this->assertArrayHasKey( 0, $results->posts );

		$this->assertContains( $results->posts[0], self::$post_ids );
	}

	/**
	 * Forces AND logic but includes a missing token, should yield zero results.
	 */
	public function test_forced_failure() {
		add_filter( 'searchwp\query\logic\and\strict', '__return_true' );

		$results = new \SWP_Query( [
			'engine' => 'default',
			's'      => 'lorem ipsum notfound',
			'fields' => 'all',
		] );

		remove_filter( 'searchwp\query\logic\and\strict', '__return_true' );

		$this->assertTrue( empty( $results->posts ) );
	}

	public function test_stems() {
		/**
		 * There are two posts with the following titles
		 * - fishing running hiking
		 * - fishing lorem
		 * This test ensures that searching for "fishing hiking" with stemming
		 * enabled (which will in turn search for "fish hike") doesn't resort to
		 * OR logic and then include the "fishing lorem" post.
		 */
		$results = new \SWP_Query( [
			'engine' => 'andstemmed',
			's'      => 'fishing running',
			'fields' => 'ids',
		] );

		$this->assertEquals( 1, count( $results->posts ) );
		$this->assertArrayHasKey( 0, $results->posts );

		$this->assertContains( $results->posts[0], self::$post_ids );

		// We should also be able to search for the stems and find the single post as well.
		$results = new \SWP_Query( [
			'engine' => 'andstemmed',
			's'      => 'fish hike',
			'fields' => 'ids',
		] );

		$this->assertEquals( 1, count( $results->posts ) );
		$this->assertArrayHasKey( 0, $results->posts );

		$this->assertContains( $results->posts[0], self::$post_ids );
	}
}
