<?php
/**
 * Cards block.
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

$class_names    = 'wp-block-cards';
$allowed_blocks = array( 'acf/card' );
$background     = get_field( 'background' );
$columns        = get_field( 'columns' );
$gap            = get_field( 'gap' );
$minmax         = get_field( 'minmax' );
$rows           = get_field( 'rows' );

if ( ! empty( $block['align'] ) ) {
	$class_names .= ' align' . $block['align'];
}

if ( ! empty( $block['className'] ) ) {
	$class_names .= ' ' . $block['className'];
}
?>

<section class="<?php echo esc_attr( $class_names ); ?>" style="background-color: <?php echo esc_attr( $background ); ?>">
	<?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" />'; ?>
</section>

<style>
	.wp-block-cards .acf-innerblocks-container {
		gap: <?php echo esc_attr( $gap ); ?>;
		grid-template-columns: repeat(<?php echo esc_attr( $columns ); ?>, minmax(<?php echo esc_attr( $minmax ); ?>, 1fr));
		grid-template-rows: repeat(<?php echo esc_attr( $rows ); ?>, minmax(<?php echo esc_attr( $minmax ); ?>, 1fr));
	}
</style>
