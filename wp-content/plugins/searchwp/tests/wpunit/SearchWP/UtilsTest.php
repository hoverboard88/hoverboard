<?php
namespace SearchWP;

class UtilsTest extends \Codeception\TestCase\WPTestCase {

	public function test_that_string_is_trimmed_around_substring() {
		$haystack = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt vel ipsum vitae tincidunt. Etiam vestibulum efficitur aliquam. Quisque ac maximus dolor, non euismod urna. Fusce tempor ligula convallis porta.';
		$needle   = 'vel';
		$length   = 8;

		$this->assertEquals(
			\SearchWP\Utils::trim_string_around_substring( $haystack, $needle, $length ),
			' [&hellip;] adipiscing elit. Donec tincidunt vel ipsum vitae tincidunt. [&hellip;] '
		);
	}

	// Test that a substring in the haystack that happens to have punctuation around it
	// is not excluded as a match.
	public function test_that_string_is_trimmed_around_substring_with_punctuation() {
		$haystack = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt vel ipsum vitae tincidunt. Etiam vestibulum efficitur aliquam. Quisque ac maximus dolor, non euismod urna. Fusce tempor ligula convallis porta.';
		$needle   = 'elit';
		$length   = 8;

		$this->assertEquals(
			\SearchWP\Utils::trim_string_around_substring( $haystack, $needle, $length ),
			' [&hellip;] sit amet, consectetur adipiscing elit. Donec tincidunt vel [&hellip;] '
		);
	}
}
