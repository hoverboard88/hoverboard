<?php
/**
 * Unit Test API
 *
 * @package Pantheon HUD
 */

/**
 * API Unit Test
 */
class APITest extends WP_UnitTestCase {

	/**
	 * Setup Test.
	 */
	public function setUp() {
		parent::setUp();
		$this->api                    = new Pantheon\HUD\API();
		$_ENV['PANTHEON_ENVIRONMENT'] = 'dev';
		$_ENV['PANTHEON_SITE']        = '73cae74a-b66e-440a-ad3b-4f0679eb5e97';
		$_ENV['PANTHEON_SITE_NAME']   = 'daniel-pantheon';
		$_ENV['php_version']          = '7.3';
	}

	/**
	 * Test getting the Site ID.
	 */
	public function test_get_site_id() {
		$this->assertEquals( '73cae74a-b66e-440a-ad3b-4f0679eb5e97', $this->api->get_site_id() );
	}

	/**
	 * Test getting the Site name.
	 */
	public function test_get_site_name() {
		$this->assertEquals( 'daniel-pantheon', $this->api->get_site_name() );
	}

	/**
	 * Test getting timestamp.
	 */
	public function test_get_last_code_push_timestamp() {
		$this->assertEquals( 1562339889, $this->api->get_last_code_push_timestamp() );
	}

	/**
	 * Ensures primary environment URL is properly fetched.
	 */
	public function test_get_primary_environment_url() {
		$this->assertEquals( '', $this->api->get_primary_environment_url( 'dev' ) );
	}

	/**
	 * Ensures the PHP version is pulled from the $_ENV variable as expected.
	 */
	public function test_get_php_version() {
		$this->assertEquals( '7.3', $this->api->get_php_version() );
	}

	/**
	 * Test getting the environment details.
	 */
	public function test_get_environment_details() {
		$environment_details = $this->api->get_environment_details();
		$this->assertEquals(
			array(
				'web'      => array(
					'appserver_count' => 2,
					'php_version'     => 'PHP 7.3',
				),
				'database' => array(
					'dbserver_count'           => 1,
					'read_replication_enabled' => false,
				),
			),
			$environment_details
		);
	}

}
