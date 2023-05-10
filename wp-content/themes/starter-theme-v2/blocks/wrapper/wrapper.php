<?php
/**
 * Wrapper block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 *
 * @package  Hoverboard
 * @author   Hoverboard <hi@hoverboardstudios.com>
 * @license  GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$class_names = 'wrapper';
$color       = get_field( 'color' );
$spacing     = get_field( 'spacing' );

if ( ! empty( $color ) ) {
	$class_names .= ' wrapper--' . $color;
}

if ( ! empty( $block['align'] ) ) {
	$class_names .= ' align' . $block['align'];
}

if ( ! empty( $block['className'] ) ) {
	$class_names .= ' ' . $block['className'];
}
?>

<section id="<?php echo esc_attr( $block['id'] ); ?>" class="<?php echo esc_attr( $class_names ); ?>">
	<div class="container container--<?php echo esc_attr( $spacing ); ?>">
		<InnerBlocks  />
	</div>
</section>
