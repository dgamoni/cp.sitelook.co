<?php
    global $wp;  
    $page_url = $wp->request;
    $blog_page = false;
    if ($page_url == "blog" || strpos($page_url, 'blog/page') !== false)
    	$blog_page = true;
?>

<section id="primary" class="content-area col-sm-12 col-lg-12">
	<main id="main" class="site-main" role="main">
		<div id="categories-wrapper" class="pr-3 pl-3 bg-white">
			<ul id="categories" class="p-0">
				<li <?php if ($blog_page) echo "class='current-cat'";?>><a href='/blog'>ALL</a></li>
				<?php wp_list_categories( array('title_li' => '') );?>
			</ul>
		</div>
		<div id="blog-content" class="row">

			<?php
				if ($blog_page)
					query_posts('post_type=post&post_status=publish&posts_per_page=4&paged='. get_query_var('paged'));
			?>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'blog' );

			endwhile;
			?>
		</div>

		<div class="navigation">
			<span class="newer"><?php previous_posts_link(__('« Newer','wp-bootstrap-starter-sitelook')) ?></span> <span class="older"><?php next_posts_link(__('Older »','wp-bootstrap-starter-sitelook')) ?></span>
		</div><!-- /.navigation -->

	</main><!-- #main -->
</section><!-- #primary -->
