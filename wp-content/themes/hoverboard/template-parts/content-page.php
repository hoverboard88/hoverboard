<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hoverboard-v2
 */

?>

<!-- <div class="wrap">
  <div class="container centered container-page-title container--medium container-page-title">
    <h1 class="page-title"><?php the_title(); ?></h1>
  </div>
</div> -->

<?php if (is_page_template('page-about.php')) { ?>
  <div class="wrap">
    <section class="about container container--small">
      <p>At Hoverboard, we have immersed ourselves with all things digital <strong>for over 10 years</strong>, and bring an incredible understanding of the <strong>aesthetic and technical strategy</strong> to your project—the do’s, don’ts, and ingrained know-how</p>
      <div class="well well--shadowed well--centered">But that’s not all there is to building a successful digital experience.</div>
      <p>There is still that one remaining factor: <strong>you, your vision, and your plan</strong>. We collaborate directly with you to craft exactly what your business needs are.</p>
      <div class="well well--shadowed well--centered">We specialize in creating a digital experience that is performant, reliable and meets the needs of your customers.</div>
    </section>
  </div>
<?php } ?>

<?php if (is_page_template('page-services.php')) { ?>
  <div class="wrap">
    <section class="services container">
      <div class="services__technology">
        <h2 class="title-box title-box--green">
          <div class="title-box__title">Technology</div>
        </h2>
        <div class="well well--shadowed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse imperdiet, dolor sed commodo finibus, libero ante malesuada ligula, sit amet imperdiet ex nulla ac ex. Suspendisse potenti. Fusce a risus sit amet lacus dictum maximus ultrices eu augue.</div>
      </div>
    </section>
  </div>
<?php } ?>

<div class="wrap">
  <article id="post-<?php the_ID(); ?>" <?php post_class('content container container--small'); ?>>

  	<div class="entry-content">
  		<?php
  			the_content();

  			wp_link_pages( array(
  				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hb_v2' ),
  				'after'  => '</div>',
  			) );
  		?>
  	</div>

  </article><!-- #post-## -->
</div>
