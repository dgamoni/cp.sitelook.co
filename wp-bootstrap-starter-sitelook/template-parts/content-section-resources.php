<section id="therapy-resources" class="front-page therapy-resources p-5 clear">
    <div class="container">
    	<h5 class='text-center'><?php esc_html_e('LATEST RESOURCES', 'wp-bootstrap-starter-sitelook');?></h5>
    	<div class="row">
	        <?php
	        $course = new WP_Query( array(
	            'post_type' => 'therapy_course',
	            'posts_per_page' => 1,
				'no_found_rows' => false,
	        ) );
	        while ($course->have_posts()) : $course->the_post(); ?>
	        	<?php 
	        		$bg = get_the_post_thumbnail_url();
	        	?>
	            <div class="col-12 col-md-6 p-3">
	            	<div class="therapy-course p-4" <?php if ($bg):?> style="background: url('<?php echo $bg;?>') center center no-repeat; background-size: cover;"<?php endif;?>>
	            		<div class="therapy-subtitle mt-3 mb-3"><?php esc_html_e('Latest Course', 'wp-bootstrap-starter-sitelook');?></div>
	            		<div class="therapy-title mt-3 mb-3">
	            			<?php the_title(); ?>
            			</div>
	            		<div class="therapy-desc mt-3 mb-3">
	            			<?php the_excerpt(); ?>
            			</div>
	            		<div class="therapy-more mt-5 mb-3">
	            			<a href="<?php the_permalink(); ?>" class="btn blue"><?php esc_html_e('Learn more', 'wp-bootstrap-starter-sitelook');?> <i class="fa fa-arrow-right"></i></a>
	            		</div>
	            	</div>
	            </div>
	        <?php endwhile; ?>

	        <?php
	        $book = new WP_Query( array(
	            'post_type' => 'therapy_book',
	            'posts_per_page' => 1,
				'no_found_rows' => false,
	        ) );
	        while ($book->have_posts()) : $book->the_post(); ?>
	        	<?php 
	        		$bg = get_the_post_thumbnail_url();
	        	?>
	            <div class="col-12 col-md-6 p-3">
	            	<div class="therapy-book p-4" <?php if ($bg):?> style="background: url('<?php echo $bg;?>') center center no-repeat; background-size: cover;"<?php endif;?>>
	            		<div class="therapy-subtitle mt-3 mb-3"><?php esc_html_e('Latest Book', 'wp-bootstrap-starter-sitelook');?></div>
	            		<div class="therapy-title mt-3 mb-3">
	            			<?php the_title(); ?>
            			</div>
	            		<div class="therapy-desc mt-3 mb-3">
	            			<?php the_excerpt(); ?>
            			</div>
	            		<div class="therapy-more mt-5 mb-3">
	            			<a href="<?php the_permalink(); ?>" class="btn blue mb-3"><?php esc_html_e('View book', 'wp-bootstrap-starter-sitelook');?></a><br>
	            			<a href="/books" class="btn transparent"><?php esc_html_e('See All Books', 'wp-bootstrap-starter-sitelook');?></a>
	            		</div>
	            	</div>
	            </div>
	        <?php endwhile; ?>	        
	    </div>
	</div>
</section>