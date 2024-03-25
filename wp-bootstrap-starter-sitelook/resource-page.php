<?php
/**
* Template Name: Resource Page
 */

get_header(); ?>
<section id="primary" class="content-area col-sm-12">
	<main id="main" class="site-main" role="main">

		<?php
			get_template_part( 'template-parts/content', 'section-resources' );
			get_template_part( 'template-parts/content', 'section-articles' );
		?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
