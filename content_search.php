<?php 
							$col='col-lg-6';
							$entrymeta=$catnametex;
							$divstart='<div class="entry-wrapper">';
							$divend='</div>';
							$postlist='post-list';
							$image =zb_get_background_image($post->ID,300,200);
							
							$categories = get_the_category();
							if ( ! empty( $categories ) ) {
								$catnametex='<div class="entry-meta"><span class="meta-category"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" rel="category"><i class="dot category-color-1"></i>' . esc_html( $categories[0]->name ) . '</a></span></div>';
							}
							?>
							<div class="<?php echo $col;?>">
								<article class="hentry <?php echo $postlist;?>">
									<div class="entry-media">
										<div class="placeholder" style="padding-bottom: 66.666666666667%;">
											<a href="<?php the_permalink();?>">
												<img class="lazyload" data-srcset="<?php echo $image;?>" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?php the_title();?>">
											</a>
										</div>
										<div class="entry-format">
											<?php echo the_article_icon();?>
										</div>
									</div>
									<?php echo $divstart;?>
										<header class="entry-header">
											<?php echo $entrymeta;?>
											<h2 class="entry-title" style="font-size: 1.7rem;">
												<a href="<?php the_permalink();?>" rel="bookmark"><?php the_title();?></a>
											</h2>  
										</header>
										<div class="category-excerpt entry-excerpt u-text-format" style="font-size: .9rem;">
											<?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 45,"...");?>
										</div>
										<div class="category-footer entry-footer">
										    <a style="color: #777;" href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" rel="category"><i class="dot category-color-1"></i><?php echo esc_html( $categories[0]->name ); ?>
										    <time style="margin-left: 10px;font-weight: 600;color: #999;text-transform: capitalize;" itemprop="datePublished" datetime="<?php echo get_the_date( 'c' );?>"><?php echo get_the_date('M d,Y');?></time></a>
										</div>
									<?php echo $divend;?>
								</article>
							</div>