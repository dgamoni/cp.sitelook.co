<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
	<?php if(!is_front_page()):?>
			</div><!-- .row -->
		</div><!-- .container -->
	<?php endif; ?>	
	</div><!-- #content -->
    <?php get_template_part( 'footer-widget' ); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container pt-3 pb-3">
            <div class="site-info">
                Catholic Psych Institute<br>
				<a href='mailto:info@catholicpsych.com'>info@catholicpsych.com</a>  | (347) 705.0406<br>
				179 Hamilton Ave Greenwich, CT 06830
            </div><!-- close .site-info -->
		</div>
	</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>