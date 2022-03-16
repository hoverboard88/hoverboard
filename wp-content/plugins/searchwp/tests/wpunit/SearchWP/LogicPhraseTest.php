<?php
namespace SearchWP;

class LogicPhraseTest extends \Codeception\TestCase\WPTestCase {
	protected static $factory;
	protected static $post_ids;

	function _before() {
		self::$factory = static::factory();

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'Phrase match post',
		] );

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'Phrase no match post flag',
		] );

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'This post has term1 term2 but also has term3 and term4',
		] );

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'This post has term1 term2 but not the unquoted AND logic terms',
		] );

		$post_ids[] = self::$factory->post->create( [
			'post_title' => 'This post has term1 and term2 but not desired',
		] );

		self::$post_ids = $post_ids;

		// Create a Default Engine.
		$engine_model = json_decode( json_encode( new \SearchWP\Engine( 'default' ) ), true );
		\SearchWP\Settings::update_engines_config( [
			'default' => \SearchWP\Utils::normalize_engine_config( $engine_model ),
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

	/**
	 * There is one post with a phrase match and another post with a word that disrupts a phrase match.
	 */
	public function test_that_phrase_match_returns_correct_result() {
		add_filter( 'searchwp\query\logic\phrase', '__return_true' );

		$results = new \SWP_Query( [
			'engine' => 'default',
			's'      => '"phrase match"',
			'fields' => 'ids',
		] );

		remove_filter( 'searchwp\query\logic\phrase', '__return_true' );

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
	 * Test that a phrase match with additional missing tokens still yields result
	 */
	public function test_phrase_match_with_extra_missing_token() {
		add_filter( 'searchwp\query\logic\phrase', '__return_true' );

		$results = new \SWP_Query( [
			'engine' => 'default',
			's'      => '"phrase match" notoken',
			'fields' => 'ids',
		] );

		remove_filter( 'searchwp\query\logic\phrase', '__return_true' );

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
	 * Test that a phrase mismatch with a matching token yields a result.
	 */
	public function test_phrase_mismatch_with_extra_matching_token() {
		add_filter( 'searchwp\query\logic\phrase', '__return_true' );

		$results = new \SWP_Query( [
			'engine' => 'default',
			's'      => '"alpha beta" flag',
			'fields' => 'ids',
		] );

		remove_filter( 'searchwp\query\logic\phrase', '__return_true' );

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
	 * Test that a phrase mismatch falls back to finding multiple results.
	 */
	public function test_phrase_mismatch_falls_back_to_token_search() {
		add_filter( 'searchwp\query\logic\phrase', '__return_true' );

		$results = new \SWP_Query( [
			'engine' => 'default',
			's'      => '"phrase broken match"',
			'fields' => 'ids',
		] );

		remove_filter( 'searchwp\query\logic\phrase', '__return_true' );

		$this->assertEquals( 2, count( $results->posts ) );

		// That the result is in our IDs.
		$this->assertContains(
			$results->posts[0],
			self::$post_ids
		);
	}

	/**
	 * Test that a phrase mismatch fails when set to strict.
	 */
	public function test_phrase_mismatch_strict_fails() {
		add_filter( 'searchwp\query\logic\phrase', '__return_true' );
		add_filter( 'searchwp\query\logic\phrase\strict', '__return_true' );

		$results = new \SWP_Query( [
			'engine' => 'default',
			's'      => '"phrase broken match"',
			'fields' => 'ids',
		] );

		remove_filter( 'searchwp\query\logic\phrase', '__return_true' );
		remove_filter( 'searchwp\query\logic\phrase\strict', '__return_true' );

		$this->assertTrue( empty( $results->posts ) );
	}

	/**
	 * If additional words are included OUTSIDE a phrase search, AND logic should be applied.
	 * e.g. even if another post has the phrase but DOES NOT have the non-phrase terms, only
	 * the entry with the phrase match with AND logic satisfied should be returned.
	 *
	 * We have two test posts:
	 *     - term1 term2 and then term3 with term4
	 *     - term1 term2 foo bar baz
	 *
	 * If we search for `"term1 term2" term3 term4` only the first result should be returned
	 * despite the 2nd having `term1 term2`
	 */
	public function test_phrase_with_and_logic() {
		add_filter( 'searchwp\query\logic\phrase', '__return_true' );
		add_filter( 'searchwp\query\logic\phrase\strict', '__return_true' );

		$results = new \SWP_Query( [
			'engine' => 'default',
			's'      => '"term1 term2" term3 term4',
			'fields' => 'ids',
		] );

		remove_filter( 'searchwp\query\logic\phrase', '__return_true' );
		remove_filter( 'searchwp\query\logic\phrase\strict', '__return_true' );

		$this->assertEquals( 1, count( $results->posts ) );

		$this->assertContains(
			$results->posts[0],
			self::$post_ids
		);
	}

	/**
	 * Related to above, if AND logic is not satisfied we should fall back to query logic.
	 */
	public function test_phrase_with_and_logic_fallback() {
		add_filter( 'searchwp\query\logic\phrase', '__return_true' );

		$results = new \SWP_Query( [
			'engine' => 'default',
			's'      => '"term1 term2" notfound',
			'fields' => 'ids',
		] );

		remove_filter( 'searchwp\query\logic\phrase', '__return_true' );

		$this->assertEquals( 2, count( $results->posts ) );

		$this->assertContains( $results->posts[0], self::$post_ids );
		$this->assertContains( $results->posts[1], self::$post_ids );
	}
}
