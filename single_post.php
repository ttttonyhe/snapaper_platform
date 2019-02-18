
<?php get_header();
/*
    payment字段判断是否是付费文章
    payment_amount字段判断是否单文章收费
    
    已登录
        单文章付费
            未付费
                展示单文章价格
                无内容
            已付费
                展示加入会员推广
                有内容
        单文章无需付费(需要会员资格)
            会员身份
                展示到期时间差
                有内容
            无会员身份
                展示加入会员推广
                无内容
    未登录
        展示登录提示
*/

?>
<?php if ( have_posts() ) :?><?php while ( have_posts() ) : the_post(); ?>

<?php 
	$pid = $post->ID;
	$author= get_the_author();
	$categories = get_the_category(); ?>
	
		<div class="container small container-wap" style="margin-top: 8vh;">
			<?php if(get_the_post_thumbnail_url($post->ID, 'full') != ''){ ?>
				<div class="single-image" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>);border: 1px solid #eee;">
    			</div>
    		<?php } ?>
			<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>" rel="category"><p class="single-title-cate"><?php echo esc_html( $categories[0]->name ); ?></p></a>
    		<h2 class="single-title"><?php echo get_the_title() ?></h2>
    		<p class="info-wap"><b class="single-date"><?php echo human_time_diff(get_the_date('U')); ?></b> Before | Posted by <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="single-title-info"><?php echo get_avatar(get_the_author_meta( 'ID' ) ).$author ?></a> | <b class="single-view"><?php echo custom_the_views(get_the_ID()); ?></b> Page Views</p>
		</div>







        <div class="site-content site-content-wap">
          <div class="container">
		    <div class="row">
              <div class="col-lg-12">
				<div class="content-area">
                  <main class="site-main">
					<article <?php post_class( 'post' ); ?>>
                    <div class="container small">
                        <div class="entry-wrapper">
                          <div class="entry-content u-text-format u-clearfix" style="margin-bottom: 8vh;">
    <?php
        if(get_post_meta($post->ID,"payment",true)==1){ //付费类型文章
            if(is_user_logged_in()){ //已登录
            global $current_user;
            $user_id = $current_user->ID;
            $amount_needed = get_post_meta($post->ID,"payment_amount",true);
            if(!empty($amount_needed)){
                $post_payment = 1; //单文章需要付费
            }
            $amount = get_payment_array($post->ID,$user_id); //用户已付费用
            $membership = get_membership_array($user_id); //用户会员信息
            if(!empty($amount) && (float)$amount['amount'] == (float)get_post_meta($post->ID,"payment_amount",true)){
                //单文章已付费(会员状态未知)
                the_content();
                if((int)$membership[0]['timenum'] < (int)$membership[0]['mem_duration']){ //单片付费且会员
            ?>
                          				
                          	<div class="video-pay" style="border-radius: 4px;background: #23d393;">
		                        <em class="video-pay-em"><b><?php echo get_membership_time(time(),$membership[0]['mem_duration']); ?> days</b>VIP Membership &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/membership"><button class="video-pay-btn" style="background:#00aaee">Renew</button></a>
                            </div>
                            
                          	<?php }else{ //单片付费但不是会员 ?>
                          	
                          	<div class="video-pay" style="border-radius: 4px;background: #23d393;">
		                        <em class="video-pay-em"><b>Membership</b>Get Unlimited Access to All the Posts &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/membership"><button class="video-pay-btn" style="background:#00aaee">Learn More</button></a>
                            </div>
                          	
                          	<?php }}elseif((int)$membership[0]['timenum'] < (int)$membership[0]['mem_duration'] && $membership[0]['mem_type'] != 1 && !empty($membership[0]['mem_type'])){
                          	    //单文章未付费但有会员身份且未到期且不是月付
                          	        the_content(); ?>
                          				
                          	<div class="video-pay" style="border-radius: 4px;background: #23d393;">
		                        <em class="video-pay-em"><b><?php echo get_membership_time(time(),$membership[0]['mem_duration']); ?> days</b>VIP Membership &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/membership"><button class="video-pay-btn" style="background:#00aaee">Renew</button></a>
                            </div>

                                <?php }elseif($membership[0]['mem_type'] == 1 && !empty($membership[0]['mem_type'])){ //若为月付会员，展示升级会员推广 ?>
                                
                                <div>
                          	        <p class="post-payment-notice">
                          	            <b>Higher Membership Required</b>
                          	            <br><br>Become a Snapaper Yearly member to get unlimited access to all the posts you won’t find anywhere else
                          	        </p>
                          	    </div>
                                <div class="video-pay" style="border-radius: 0 0 4px 4px;">
                                <em class="video-pay-em"><b>Yearly Membership</b>Unlimited Access to All the Posts &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/membership"><button class="video-pay-btn">Learn More</button></a>
                                </div>
                                
                                <?php }else{ //单文章未付费&无会员身份 ?>
                                
                                <?php if($post_payment == 1){ //单文章需付费 ?>
                                
                          	    <div>
                          	        <p class="post-payment-notice">
                          	            <b>Payment Required</b>
                          	            <br><br>When you encounter a problem or payment failure, please contact our customer service email : he@holptech.com
                          	        </p>
                          	    </div>
                                <div class="video-pay" style="border-radius: 0 0 4px 4px;">
		                        <em class="video-pay-em"><b>¥<?php echo get_post_meta($post->ID,"payment_amount",true); ?></b>Paid Content &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/pay?post=<?php echo $post->ID; ?>&user=<?php echo $user_id; ?>"><button class="video-pay-btn">Purchase</button></a>
                                </div>
                                
                                <?php }else{ //单文章无需付费，但需要会员 ?>
                                
                                <div>
                          	        <p class="post-payment-notice">
                          	            <b>Membership Required</b>
                          	            <br><br>Become a Snapaper member to get unlimited access to the finest videos and useful study notes you won’t find anywhere else
                          	        </p>
                          	    </div>
                                <div class="video-pay" style="border-radius: 0 0 4px 4px;">
                                <em class="video-pay-em"><b>Membership</b>Unlimited Access to All the Posts &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/membership"><button class="video-pay-btn">Learn More</button></a>
                                </div>
                                
                                <?php } ?>
                                
                          	<?php }}else{ ?>
                          	
                          		<div class="video-pay" style="border-radius: 4px;">
		                        <em class="video-pay-em">Sign In to View the Content &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/login"><button class="video-pay-btn">Sign In</button></a>
                                </div>
                          		
                          	<?php }}else{ the_content(); } ?>
                          	
                          </div>
                          <div class="entry-action">
                            <?php echo post_share();?>
                          </div>
                        </div>
                      </div>
                    </div>
                    </article>
                    <?php endwhile; endif; ?>
                  </main>
                </div>
              </div>
            </div>
          </div>
          
          
          
          <?php if(($_GET['pay_return'] && $access == 1) || ($_GET['pay_check'] && $access == 1)){ ?>
            <script>UIkit.modal.confirm('<div style="     padding: 10px 20px; "><h1 style="     margin-bottom: 0px;     font-weight: 600;     color: #444;     font-size: 2.4rem; ">Thanks for your purchase!</h1><p style="     margin-bottom: 20px;     font-size: 1rem;     color: #777; ">The paid content you purchased will be unlocked instantly</p><p style="     font-size: 1rem;     color: #777;           ">If you encounter any problems, please contact our customer service email:<b style="     font-weight: 600;     ">he@holptech.com</b>, we will reply you as soon as possible.</p></div>')</script>
        <?php }elseif(($_GET['pay_return'] && $access == 0) || ($_GET['pay_check'] && $access == 0)){ ?>
            <script>UIkit.modal.confirm('<div style="     padding: 10px 20px; "><h1 style="     margin-bottom: 0px;     font-weight: 600;     color: #444;     font-size: 2.4rem; ">Payment failed!</h1><p style="     margin-bottom: 20px;     font-size: 1rem;     color: #777; ">There is no consumption record for this transaction in our database</p><p style="     font-size: 1rem;     color: #777;           ">If you have already paid, please contact our customer service email:<b style="     font-weight: 600;     ">he@holptech.com</b>, we will reply you as soon as possible.</p></div>')</script>
        <?php } ?>
          
          
          
          <?php if(barley_get_setting('related_posts')):echo zb_related_posts();endif;?>
          <?php if ( comments_open() || get_comments_number() ) :
            comments_template();
              endif;
          ?>
        </div>
<?php get_footer();?>
