<?php
/**
 * The php file used to render the search-toggle module.
 *
 * @package  Hoverboard
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>
<a class="search-toggle" data-options='{}' href="<?php echo esc_url( home_url( '/' ) ); ?>?s=">
	<?php hb_the_svg( 'search' ); ?>
</a>
