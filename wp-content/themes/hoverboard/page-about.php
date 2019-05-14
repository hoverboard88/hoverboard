<?php
/* Template Name: About */
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hoverboard-v2
 */

get_header(); ?>

	<div id="primary" class="main main--content site-content content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
			<div class="wrap wrap--green-dark wrap--pattern">
				<section class="services container">
					<div class="services__content">
						<h3 class="services__header">What We Do</h3>
						<p class="services__title">We strive to deliver a high quality service to our clients within the digital landscape that range from software development to DevOps and hosting.</p>
						<a href="/services/" class="btn">Our Services</a>
					</div>
				</section>
			</div>

			<div class="wrap">
	      <div class="container container--medium container--padded">
	        <div class="well well--no-padding centered">
	          <div class="flex-row">
	            <div class="flex-column">
	              <h3 class="black h2 base-font single-spaced">Want to start a project?</h3>
	              <p class="italicized-callout">We would love to hear from you about a new project or challenge you need a digital solution to.</p>
	              <p><a href="#contact" class="btn single-spaced">Contact Us</a></p>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
