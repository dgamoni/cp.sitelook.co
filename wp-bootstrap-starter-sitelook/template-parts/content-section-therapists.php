<section id="therapіsts" class="front-page therapіsts p-5 clear">
    <div class="container">
    	<h5 class='text-center'><?php esc_html_e('CATHOLIC PSYCH INSTITUTE THERAPISTS', 'wp-bootstrap-starter-sitelook');?></h5>
    	<div class="row">
	        <?php $therapіsts = new WP_Query( array(
	            'post_type' => 'therapist',
	            'posts_per_page' => 8,
	            //'orderby' => 'title',
				//'order'   => 'ASC',
				'no_found_rows' => false,
	        ) );
	        while ($therapіsts->have_posts()) : $therapіsts->the_post(); ?>
	            <div class="col-12 col-sm-6 col-lg-3 p-3">
	            	<div class="therapist bg-white text-center p-0">
	            		<div class="image-container mt-3 mb-3 pt-3 pl-3 pr-3">
	            			<?php the_post_thumbnail('post-thumbnail', array('class' => 'img-circle'));?>
	            		</div>
	            		<div class="therapy-title mt-3 mb-3 pl-3 pr-3">
	            			<?php the_title(); ?>
            			</div>
	            		<div class="therapy-desc mt-3 mb-3 pl-3 pr-3">
	            			social links
            			</div>
	            		<div class="therapy-more mt-5 mb-3 pt-3">
	            			<a href="<?php the_permalink(); ?>"><?php esc_html_e('Learn more', 'wp-bootstrap-starter-sitelook');?></a>
	            		</div>
	            	</div>
	            </div>
	        <?php endwhile; ?>
	    </div>
	</div>
</section>
