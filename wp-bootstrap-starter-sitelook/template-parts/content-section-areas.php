<section id="therapy-areas" class="front-page therapy-areas p-5 clear bg-white">
    <div class="container">
    	<h5 class='text-center'><?php esc_html_e('AREAS OF THERAPY', 'wp-bootstrap-starter-sitelook');?></h5>
    	<div class="row col-12 col-md-10 offset-md-1">
	        <?php $areas = new WP_Query( array(
	            'post_type' => 'therapy_area',
	            'posts_per_page' => 6,
	            'orderby' => 'id',
				'order'   => 'ASC',
				'no_found_rows' => false,
	        ) );
	        while ($areas->have_posts()) : $areas->the_post(); ?>
	            <div class="col-6 col-md-4 p-3">
	            	<div class="therapy-area bg-green text-center p-0">
	            		<div class="image-container mt-3 mb-3 pt-4 pl-4 pr-4">
	            			<?php the_post_thumbnail('post-thumbnail', array('class' => 'img-circle'));?>
	            		</div>
	            		<div class="therapy-title mt-3 mb-3 pl-4 pr-4">
	            			<?php the_title(); ?>
            			</div>
	            		<div class="therapy-desc mt-3 mb-3 pl-4 pr-4">
	            			<?php the_excerpt(); ?>
            			</div>
	            		<div class="therapy-more mt-5 mb-3">
	            			<a href="<?php the_permalink(); ?>" class="btn transparent"><?php esc_html_e('Learn more', 'wp-bootstrap-starter-sitelook');?></a>
	            		</div>
	            	</div>
	            </div>
	        <?php endwhile; ?>
	    </div>
	</div>
</section>
