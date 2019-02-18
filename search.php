<?php
get_header();?>
		<div class="search-bar s-wap-header">
			<h1 class="term-title" style="font-size: 2.4rem;font-weight:600;margin: 0px;color: #666;"><?php if(!empty($_GET['s'])){ global $wp_query; echo $wp_query->found_posts . ' Articles Found'; }else{ echo 'Search'; }?></h1>
			<div class="search-form-box s-wap-search" style="margin-bottom: 1%;margin-top: 2%;width: 37%;">
			    <form method="get" action="https://platform.snapaper.com" role="search" style="display: flex;">
	                <input class="form-search" type="text" name="s" value="<?php echo $_GET['s']; ?>" style="background: #eee;border-radius: 4px 0 0 4px;margin-right: -10px;margin: 0px;">
	                <button type="submit" id="btn-search" style="border-radius: 4px;padding: 5px 10px;background: #999;border: none;color: #fff;font-size: 1.4rem;right: 40%;"><i class="icon-search"></i> </button>
                </form>
			 </div>
		</div>
		<div class="site-content s-wap-content">
			<div class="content-area">
				<main class="site-main">
	 				<div class="section module_post_grid">
	 					<div class="container">
							<div class="module grid u-module-margin">
								<div class="row" uk-scrollspy="target: > div; cls:uk-animation-slide-bottom-small; delay: 300">
								<?php if ( have_posts() ) : while ( have_posts() ) :the_post();
									if(wp_is_mobile()){
									    get_template_part( 'content', get_post_format() );
									}else{
									    get_template_part( 'content_search', get_post_format() );
									}
								endwhile;?>
            					</div>
								<div class="numeric-pagination">
									<ul class="page-numbers">
										<?php echo paginate_links(array('prev_text'=> '<i class="icon-navigate_before"></i>','next_text'=> '<i class="icon-navigate_next"></i>',) ); ?>
									</ul>
								</div>
								<?php  endif; ?>
          					</div>
          				</div>
          			</div>
				</main>
			</div>
		</div>
<?php get_footer();?>
