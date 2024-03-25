<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header();

get_template_part( 'template-parts/content', 'section-areas' );
get_template_part( 'template-parts/content', 'section-resources' );
get_template_part( 'template-parts/content', 'section-articles' );
get_template_part( 'template-parts/content', 'section-partners' );
get_template_part( 'template-parts/content', 'section-therapists' );

get_footer();
