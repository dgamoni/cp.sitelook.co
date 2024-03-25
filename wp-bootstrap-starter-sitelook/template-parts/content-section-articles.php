<?php 
	wp_register_script( 'wp-bootstrap-starter-bootstrap-sitelook-js', get_stylesheet_directory_uri() . '/assets/js/ImageScrollLight.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'wp-bootstrap-starter-bootstrap-sitelook-js' );
?>

<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			$('#therapy-articles .scroll-next').click(function() {
			    $('#therapy-articles .scroll-container').imageScroll({
			      orientation:"left",
			      speed:300,
			      interval:1500,
			      hoverPause:true,
			      callback:function(){ return false;}
			    });
			});

			$('#therapy-articles .scroll-prev').click(function() {
			    $('#therapy-articles .scroll-container').imageScroll({
			      orientation:"right",
			      speed:300,
			      interval:1500,
			      hoverPause:true,
			      callback:function(){ return false;}
			    });
			});
		});
	})( jQuery );
</script>

<section id="therapy-articles" class="front-page therapy-articles p-5 clear">
    <div class="container bg-white p-0">
    	<div class="therapy-articles-header pt-4 pr-4 pl-4 pb-2 mb-3 scroll-nav-wrapper">
    		<h5><?php esc_html_e('LATEST ARTICLES', 'wp-bootstrap-starter-sitelook');?></h5>
    		<div class="scroll-nav">
    			<a href='javascript: void(0);' class='scroll-prev'><i class="fa fa-caret-left"></i></a><a href='javascript: void(0);' class='scroll-next'><i class="fa fa-caret-right"></i></a>
    		</div>
    	</div>
    	<div class="row pl-4 pr-4 pb-3 scroll-container">
	        <?php $posts = new WP_Query( array(
	            'post_type' => 'post',
	            'posts_per_page' => 20,
	        ) );
	        while ($posts->have_posts()) : $posts->the_post(); ?>
	            <div class="col-12 col-sm-6 col-md-3 p-0">
	            	<div class="therapy-article">
		            	<div class="pr-4 pl-4">
		            		<div class="image-container">
		            			<?php the_post_thumbnail('post-thumbnail');?>
		            		</div>
		            		<div class="therapy-category mt-3 clear">
		            			<?php the_category(); ?>
	            			</div>
		            		<div class="therapy-title mb-3">
		            			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	        <?php endwhile; ?>
	    </div>
	</div>
</section>