<section id="partners" class="front-page partners bg-grey p-5 clear">
    <div class="container">
    	<h5 class='text-center'><?php esc_html_e('PARTNERS', 'wp-bootstrap-starter-sitelook');?></h5>
    </div>
    	<div class="row clear">
	        <?php $partners = new WP_Query( array(
	            'post_type' => 'partner',
	            'posts_per_page' => 4,
	            'orderby' => 'id',
				'order'   => 'ASC',
				'no_found_rows' => false,
	        ) );
	        while ($partners->have_posts()) : $partners->the_post(); ?>
	            <div class="col20 p-3">
           			<?php the_post_thumbnail('post-thumbnail');?>
	            </div>
	        <?php endwhile; ?>
	        <div class="col20 p-3 view-partners-container">
	        	<div class="view-partners p-2">
	        		<a href='/partners'><?php esc_html_e('View All Partners', 'wp-bootstrap-starter-sitelook');?></a>
	        	</div>
	        </div>
	    </div>
</section>