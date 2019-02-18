<?php 
get_header();
$term = get_queried_object();
	$args=array(
	'cat' => $term->name,
	'posts_per_page' => 1,
	);
query_posts($args);if(have_posts()) : while (have_posts()) : the_post();?>
		<div class="term-bar lazyload visible" style="width: 100%;text-align: center;padding: 70px 0 30px 0;margin-top: 7px;font-size: 1rem;color: #999;">
			<h1 class="term-title" style="font-size: 1.5rem;color: #555;font-weight: 400;"><b style="font-size: 3rem;font-weight: 600;margin-left: 5px;"><?php echo $term->name;?></b></h1>
			<p><?php 
				echo wt_get_category_count();
			?> Posts</p>
			
			<div class="cate-tags">
			<?php
			$categoryID = $cat;
			$custom_query = new WP_Query(array(
			    'post_type' => array('post','company','product','any other custom post type'),
			    'cat' => $categoryID,
			    'posts_per_page' => -1
			)); 
			if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); $posttags = get_the_tags(); if ($posttags) { foreach($posttags as $tag) { $all_tags[] = $tag->term_id; }} endwhile; endif;
            $tags_arr = array_unique($all_tags);
            $tags_str = implode(",", $tags_arr);
            $args = array('include'   => $tags_str);
            wp_tag_cloud($args);
            ?></div>
		</div>
		<?php  endwhile; endif; wp_reset_query(); ?>
		<div class="site-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="content-area">
							<main class="site-main">
								<div class="row posts-wrapper indexList">
								<?php if ( have_posts() ) :while ( have_posts() ) :the_post();
									get_template_part( 'content', get_post_format() );
								endwhile;endif;?>
								</div>
								<div class="numeric-pagination">
									<ul class="page-numbers">
										<?php echo paginate_links(array('prev_text'=> '<i class="icon-navigate_before"></i>','next_text'=> '<i class="icon-navigate_next"></i>',) ); ?>
									</ul>
								</div>
							</main>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php get_footer();?>