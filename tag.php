<?php 
get_header();
	$cureent_tag = get_current_tag_id();
	$args=array('include' => $cureent_tag);
	$tags = get_tags($args);
      foreach ($tags as $tag){
        $name = $tag -> name; 
        $tagid = $tag -> term_id;
      }?>
		<div class="term-bar lazyload visible" style="width: 100%;text-align: center;padding: 70px 0 30px 0;margin-top: 7px;font-size: 1rem;color: #999;">
			<h1 class="term-title" style="font-size: 1.5rem;color: #555;font-weight: 400;"><b style="font-size: 3rem;font-weight: 600;margin-left: 5px;"><?php echo $name; ?></b></h1>
            <p><?php echo get_tag_post_count_by_id($tagid); ?> Posts</p>
		</div>
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