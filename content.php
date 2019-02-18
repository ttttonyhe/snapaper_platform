							<?php 
							if (barley_get_setting('home-style')=='style-gird-4'){
								$col='col-sm-6 col-md-4 col-lg-3';
								$image =zb_get_background_image($post->ID,300,200);
							}
							if (barley_get_setting('home-style')=='style-list'){
								$col='col-lg-6';
								$entrymeta=$catnametex;
								$divstart='<div class="entry-wrapper">';
								$divend='</div>';
								$postlist='post-list';
								$image =zb_get_background_image($post->ID,300,200);
							}
							if (barley_get_setting('home-style')=='style-gird-2'){
								$col='col-lg-6';
								$entrymeta=$catnametex;
								$divstart='<div class="entry-wrapper">';
								$divend='</div>';
								$postlist='style-gird-2';
								if(get_the_post_thumbnail_url($post->ID, 'full') != ''){
									$image = get_the_post_thumbnail_url($post->ID, 'full');
								}else{
									$image = 'https://static.ouorz.com/placeholder.png';
								}
							}
							$categories = get_the_category();
							if ( ! empty( $categories ) ) {
								$catnametex='<div class="entry-meta"><span class="meta-category"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" rel="category"><i class="dot category-color-1"></i>' . esc_html( $categories[0]->name ) . '</a></span></div>';
							}
							?>
							<div class="<?php echo $col;?>">
								<article class="hentry <?php echo $postlist;?>">
									<div class="entry-media">
										<div class="placeholder" style="padding-bottom: 250px;border-radius: 4px;">
											<a href="<?php the_permalink();?>">
												<img class="lazyload" data-srcset="<?php echo $image;?>" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?php the_title();?>" style="height:250px">
											</a>
										</div>
										<div class="entry-format">
											<?php echo the_article_icon();?>
										</div>
										<?php if(empty(get_post_meta($post->ID,"payment",true))){ ?>
										<div class="entry-format" style="left: 50px;background: rgba(35, 211, 147, 0.7411764705882353);width: 65px;border-radius: 80px;font-weight: 700;">Free</div>
										<?php } ?>
										<?php if(!empty(get_post_meta($post->ID,"payment",true)) && empty(get_post_meta($post->ID,"payment_amount",true))){ ?>
										<div class="entry-format" style="left: 50px;background: rgba(0, 169, 241, 0.72);width: 120px;border-radius: 80px;font-weight: 700;">Membership</div>
										<?php } ?>
									</div>
									<?php echo $divstart;?>
										<header class="entry-header">
											<?php echo $entrymeta;?>
											<em class="post-meta-tag"><a style="color: #888;" href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" rel="category"><i class="dot category-color-1"></i><?php echo esc_html( $categories[0]->name ); ?></a></em>
											<em class="post-meta-tag"><?php echo the_article_type(); ?></em>
											<h2 class="entry-title" style="margin-top:20px">
												<a href="<?php the_permalink();?>" rel="bookmark"><?php the_title();?></a>
											</h2>  
										</header>
										<div class="category-excerpt entry-excerpt u-text-format">
											<?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 90,"...");?>
										</div>
										<div class="category-footer entry-footer">
										    <a><b><?php echo get_the_author(); ?></b><time itemprop="datePublished" datetime="<?php echo get_the_date( 'c' );?>" style="font-weight: 600;margin-left: 10px;"><?php echo get_the_date('M d,Y');?></time></a>
										</div>
									<?php echo $divend;?>
								</article>
							</div>