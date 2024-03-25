<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

$bg = get_the_post_thumbnail_url();

?>

<div class="col-12 col-lg-6 p-3 post-wrapper">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="row p-0 m-0">
			<div class="col-12 col-sm-6 p-0">
				<div class="post-thumbnail" <?php if ($bg):?> style="background: url('<?php echo $bg;?>') center center no-repeat; background-size: cover;"<?php endif;?>>
				</div>
			</div>
			<div class="col-12 col-sm-6 p-3">
				<?php if ( 'post' === get_post_type() ) : ?>
					<footer class="entry-footer">
						<?php wp_bootstrap_starter_sitelook_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				<?php endif;?>

				<header class="entry-header pt-3">
					<?php
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif; ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php
						echo wp_bootstrap_starter_sitelook_get_excerpt(180);
					?>
				</div><!-- .entry-content -->

				<header class="entry-header pt-3">
					<div class="entry-meta">
						<?php wp_bootstrap_starter_sitelook_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->
			</div>
		</div>
	</article><!-- #post-## -->
</div>