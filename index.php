<?php
get_header();?>
		<div class="site-content uk-animation-slide-bottom-small">
			<div class="content-area">
				<main class="site-main">
					<?php if ( barley_get_setting('home_cate') && $paged == 0 ){?>
					<div class="section widget_magsy_module_category_boxes">
						<div class="container" style="padding-left: 0px;">
						    <div class="sub-title-div" style="margin-bottom: 50px;margin-left: 10px;">
                                <h1 class="sub-title-h1" style="display: inline-block;">All Categories</h1>
    	                        <p class="sub-title-p">Choose a category and start exploring</p>
                            </div>
							<div class="module category-boxes owl">
								<?php get_category_posts_list();?>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if($paged == 0) $word = 'All The Latest'; else $word = 'Page&nbsp;'.$paged ?>
	 				<div class="section module_post_grid">
	 					<div class="container">
							<div class="sub-title-div" style="margin-left: 0px !important;margin-bottom: 80px;">
                                <h1 class="sub-title-h1" style="display: inline-block;"><?php echo $word; ?></h1>
                                <a href="https://platform.snapaper.com/?s" class="index-search"><svg width="25" height="25" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="search"><circle fill="none" stroke="#666" stroke-width="1.5" cx="9" cy="9" r="7"></circle><path fill="none" stroke="#666" stroke-width="1.5" d="M14,14 L18,18 L14,14 Z"></path></svg> Search</a>
    	                        <p class="sub-title-p">Choose a post and start exploring</p>
                            </div>
							<div class="module grid u-module-margin">
								<div class="row posts-wrapper" uk-scrollspy="target: > div; cls:uk-animation-slide-bottom-small; delay: 300">
								<?php if ( have_posts() ) :while ( have_posts() ) :the_post();
									get_template_part( 'content', get_post_format() );
								endwhile;endif;?>
            					</div>
								<div class="numeric-pagination">
									<ul class="page-numbers">
										<?php echo paginate_links(array('prev_text'=> '<i class="icon-navigate_before"></i>','next_text'=> '<i class="icon-navigate_next"></i>',) ); ?>
									</ul>
								</div>
          					</div>
          				</div>
          			</div>
				</main>
			</div>
		</div>
<?php get_footer();?>
