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

<?php if (is_page_template('page-services.php')): ?>
  <section class="services-template container">
    <div class="services-template__technology centered">
      <h2 class="title-box title-box--green">
        <div class="title-box__title">Technology</div>
      </h2>
      <div class="services-template__content">
        <div class="well well--shadowed well--no-padding">
          <h4 class="services-template__title">Web Development</h4>
          <div class="services-template__container">
            <?php echo file_get_contents( get_template_directory() . '/dist/img/wordpress.svg' ); ?>
            <p>Our goal is providing you with a tool that allows you to effectively and efficiently <strong>communicate</strong> with your customers.</p>
          </div>
        </div>
        <div class="well well--shadowed well--no-padding">
          <h4 class="services-template__title">Software Development</h4>
          <div class="services-template__container">
            <?php echo file_get_contents( get_template_directory() . '/dist/img/node.svg' ); ?>
            <p>If you need a custom software application we <strong>collaborate</strong> with you on technical strategy to build out a solution that fits your needs.</p>
          </div>
        </div>
        <div class="well well--shadowed well--no-padding">
          <h4 class="services-template__title">E-commerce</h4>
          <div class="services-template__container">
            <?php echo file_get_contents( get_template_directory() . '/dist/img/woo-commerce.svg' ); ?>
            <p>We can help you set up <strong>payment solutions</strong> so your customers can purchase goods, products, or services from your website.</p>
          </div>
        </div>
        <div class="well well--shadowed well--no-padding">
          <h4 class="services-template__title">DevOps/Hosting</h4>
          <div class="services-template__container">
            <?php echo file_get_contents( get_template_directory() . '/dist/img/docker.svg' ); ?>
            <p>We <strong>maintain</strong> all website updates, data backups, and monitor security through secured managed hosting, version control and a global Content Delivery Network.</p>
          </div>
        </div>
        <div class="well well--shadowed well--no-padding">
          <h4 class="services-template__title">Support</h4>
          <div class="services-template__container">
            <?php echo file_get_contents( get_template_directory() . '/dist/img/support.svg' ); ?>
            <p>We <strong>provide</strong> consulting on strategic technical planning, routine maintenance work, and quick turnaround times</p>
          </div>
        </div>
      </div>
    </div>
    <div class="services-template__creative centered">
      <h2 class="title-box title-box--blue">
        <div class="title-box__title">Creative</div>
      </h2>
      <div class="services-template__content">
        <div class="well well--shadowed well--no-padding">
          <h4 class="services-template__title">User Experience Design</h4>
          <div class="services-template__container">
            <?php echo file_get_contents( get_template_directory() . '/dist/img/ui-ux.svg' ); ?>
            <p>We <strong>increase user involvement</strong> by improving the usability and accessibility through behavioral, aesthetic, and visual design patterns.</p>
          </div>
        </div>
        <div class="well well--shadowed well--no-padding">
          <h4 class="services-template__title">Branding</h4>
          <div class="services-template__container">
            <?php echo file_get_contents( get_template_directory() . '/dist/img/branding.svg' ); ?>
            <p>A <strong>successful brand</strong> helps establish a relationship between you and your customers.</p>
          </div>
        </div>
        <div class="well well--shadowed well--no-padding">
          <h4 class="services-template__title">Design</h4>
          <div class="services-template__container">
            <?php echo file_get_contents( get_template_directory() . '/dist/img/design.svg' ); ?>
            <p>A <strong>great design</strong> can separate you from your competition.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="services-template__marketing centered">
      <h2 class="title-box title-box--purple">
        <div class="title-box__title">Marketing</div>
      </h2>
      <div class="services-template__content">
        <div class="well well--shadowed well--no-padding">
          <h4 class="services-template__title">Search Engine Optimization</h4>
          <div class="services-template__container">
            <?php echo file_get_contents( get_template_directory() . '/dist/img/seo.svg' ); ?>
            <p>We <strong>optimize</strong> your on and off-site channels to gain relevance and visibility so visitors convert into qualified leads.</p>
          </div>
        </div>
        <div class="well well--shadowed well--no-padding">
          <h4 class="services-template__title">Copywriting</h4>
          <div class="services-template__container">
            <?php echo file_get_contents( get_template_directory() . '/dist/img/copy.svg' ); ?>
            <p>We <strong>refine</strong> your content based off of focused market research to drive organic placement.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

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
