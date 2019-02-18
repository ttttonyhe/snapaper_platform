<?php get_header();?>

<!-- 播放器资源 -->
<script type="text/javascript" src="https://player.dogecloud.com/js/loader"></script>
<!-- 播放器资源结束 -->

<?php 
/*
    payment字段判断是否是付费文章
    payment_amount字段判断是否单文章收费
    
    已登录
        单文章付费
            未付费
                展示单文章价格
                access为0,post_payment为1
                视频剪辑
            已付费
                展示加入会员推广
                access为1,post_payment为1
                视频全集
        单文章无需付费(需要会员资格)
            无会员身份
                展示加入会员推广
                access为0,post_payment为0
                视频剪辑
            会员身份
                展示到期时间差
                access为1,post_payment为0
                视频全集
    未登录
        展示登录提示
*/
?>

<?php if ( have_posts() ) :?>
<?php while ( have_posts() ) : the_post(); ?>

<?php 
	$pid = $post->ID;
	$author= get_the_author();
	$categories = get_the_category();
	$payment = get_post_meta($post->ID,"payment",true);
	$amount_needed = get_post_meta($post->ID,"payment_amount",true);
	if($payment==1){ //付费类型文章
	    if(!empty($amount_needed)){
	        $post_payment = 1; //单文章付费类型文章
	    }
        if(is_user_logged_in()){
            global $current_user;
            $user_id = $current_user->ID;
            $amount = get_payment_array($post->ID,$user_id); //用户已付费用
            $membership = get_membership_array($user_id); //用户会员信息
            if(!empty($amount) && (float)$amount['amount'] == (float)$amount_needed){
                $access = 1; //单文章已付费
                if((int)$membership[0]['timenum'] < (int)$membership[0]['mem_duration']){
                    $mem_status = 1; //单篇文章已付费且会员已付费
                }
            }elseif((int)$membership[0]['timenum'] < (int)$membership[0]['mem_duration']){
                $access = 1; //单文章未付费但会员未过期
                $mem_status = 1; //会员已付费
            }else{
                $access = 0; //单文章未付费&会员未付费或已过期
            }
            $login = 1; //用户已登录
        }else{
                $access = 0; //用户未登录
                $login = 0; //用户未登录
        }
	}else{ //免费文章
	    if(is_user_logged_in()){
	        $access = 1; //用户已登录
	        $login = 1; //用户已登录
	        global $current_user;
            $user_id = $current_user->ID;
	        $membership = get_membership_array($user_id); //用户会员信息
	        if((int)$membership[0]['timenum'] < (int)$membership[0]['mem_duration']){
                $mem_status = 1; //免费且会员已付费
            }
	    }else{
	        $access = 0; //用户未登录
	        $login = 0; //用户未登录
	    }
	}
?>


        <div class="site-content" style="padding-bottom:0px">
          <div class="container">
		    <div class="row">
              <div class="col-lg-12">
				<div class="content-area">
                  <main class="site-main">
					<article <?php post_class( 'post' ); ?>>
                    <div class="container small">
                        <div class="video-left-bar">
                            
                            <div class="uk-inline">
                                <button class="qrcode" target="_blank" type="button"><i class="icon-ellipsis"></i></button>
                                <div uk-dropdown="pos: left;mode:click" class="mark-view">
                                    <img src="http://qr.liantu.com/api.php?text=<?php echo get_the_permalink(); ?>" />
                                </div>
                            </div>
                            <?php if(is_user_logged_in()){ ?>
                            <?php require 'interact/mark.php'; } ?>
                            
                            
                            
                        </div>
                        <div class="entry-wrapper">
                            <div style="margin-bottom: 20px;">
                                <?php if(!empty($payment)) echo '<em class="video-status-1">Paid Content</em>'; else echo '<em class="video-status">Free</em>';  ?>
                                <em class="video-status-text"><?php if($access) echo 'Full HD Video'; else echo 'Video Excerpt' ?> &gt;</em>
                                <em class="video-status-text video-views"><?php echo custom_the_views(get_the_ID()); ?> Views</em>
                            </div>
                          <div class="entry-content u-text-format u-clearfix">
                          	<div id="sticky-container" style="box-shadow: rgb(229, 233, 239) 0px 0px 8px;">
		                    <!--<iframe class="sticky-container__object" src="<?php //echo get_post_meta( $post->ID, 'zb_post_video', 1 ,true); ?>" frameborder=0 "allowfullscreen" allow="autoplay; encrypted-media"></iframe> -->
		                    <div id="player"></div>
                            <script type="text/javascript">
                            var player = new DogePlayer({
                                container: document.getElementById('player'),
                                userId: 123,
                                vcode: '<?php echo get_post_meta( $post->ID, 'zb_post_video', 1 ,true); ?>',
                                playToken:'<?php echo encrypt_video(get_post_meta( $post->ID, 'zb_post_video', 1 ,true),$access); ?>',
                                autoPlay: false,
                                theme: '#ff0000',
                                <?php 
                                if($login == 0){
                                    echo "logo:{gravity: 'NorthEast',text: 'Sign in to see Full video'},";
                                }elseif($access == 0){
                                    echo "logo:{gravity: 'NorthEast',text: 'Pay to see Full HD video'},";
                                }
                                ?>
                                switcher: {
                                    controllerAutoHide: true,
                                    full: true,
                                    webfull: true
                                },
                                contextmenu: [
                                    {
                                        text: 'Play/Pause',
                                        op: 'toggle'
                                    },
                                    {
                                        text: 'Snapaper',
                                        op: 'url',
                                        data: 'https://www.snapaper.com'
                                    }
                                ]
                            });
                            </script>
                            
                          </div>

	                        <div class="container small" style="padding: 5vh 4vh 3vh 4vh;box-shadow: rgb(229, 233, 239) 0px 0px 8px;">
			                    <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>" rel="category"><p class="single-title-cate" style="margin-bottom: -5px;font-size: 1.2rem;"><?php echo esc_html( $categories[0]->name ); ?></p></a>
    		                    <h2 class="single-title video-wap-h2" style="margin: 15px 0 20px 0px;font-size: 2.4rem;line-height: 2.6rem;"><?php echo get_the_title() ?></h2>
    		                    <p style="line-height: 38px;overflow-x: auto;" class="video-wap-tags">
    		                        <em class="video-lable">Video</em>
    		                        <em class="video-lable" style="border: 1px solid #999;"><?php the_tags('#&nbsp;','',''); ?></em>
    		                        <?php if($access ==0){ ?>
    		                            <em class="video-lable">Excerpt</em>
    		                        <?php }else{ ?>
    		                            <em class="video-lable">Full Version</em>
    		                        <?php } ?>
    		                        <em class="video-lable"><?php echo human_time_diff(get_the_date('U')); ?> Before</em></p>
		                    </div>
		                    
		                    <?php 
		                        if(is_user_logged_in()){ //用户已登录
		                        
		                            if($access){ //可观看状态
		                                //用户不是会员(单文章已付费或免费)，展示会员推广
		                                if($mem_status != 1){
		                    ?>
		                    
		                    <div class="video-pay">
		                        <em class="video-pay-em"><b>Membership</b>Get Unlimited Access to All the Videos &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/membership"><button class="video-pay-btn">Learn More</button></a>
                            </div>
                            
                            <?php
                                //用户为会员(单文章已付费或使用会员)，展示会员期限
                                }elseif($mem_status == 1){ ?>
		                    
		                    <div class="video-pay">
		                        <em class="video-pay-em"><b><?php echo get_membership_time(time(),$membership[0]['mem_duration']); ?> days</b>VIP Membership &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/membership"><button class="video-pay-btn">Renew</button></a>
                            </div>
		                    
                            
                            <?php 
                                //不可观看状态
                                }}elseif($access == 0){
                                //需要单文章付费，展示价格
                                if($post_payment == 1){ ?>
                            
                            <div class="video-pay">
		                        <em class="video-pay-em"><b>¥<?php echo get_post_meta($post->ID,"payment_amount",true); ?></b>Full HD video playback &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/pay?post=<?php echo $post->ID; ?>&user=<?php echo $user_id; ?>"><button class="video-pay-btn">Purchase</button></a>
                            </div>
                            
                            <?php
                                //单文章无需付费但需要会员，展示会员推广
                                }else{ ?>
                            
                            <div class="video-pay">
		                        <em class="video-pay-em"><b>Membership</b>Get Unlimited Access to All the Videos &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="https://platform.snapaper.com/membership"><button class="video-pay-btn">Learn More</button></a>
                            </div>

                            <?php }}}else{ //用户未登录 ?>
                            
                            <div class="video-pay" style="background: #23d393;">
		                        <em class="video-pay-em">Full HD video playback &gt;</em>
                                <a style="float: right;margin-top: -2px;" href="login"><button class="video-pay-btn" style="color: #555;background: #fff;">SignIn</button></a>
                            </div>
                            
                            <?php } ?>
                            <div class="video-content">
                                <?php the_content(); ?>
                                <?php echo zb_related_posts();?>
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
          
          
          <script>
    
    $(document).ready(function(){
    var navH = $('.video-content').offset().top;
        $(window).scroll(function(){
            var scroH = $(this).scrollTop();
            if(scroH >= navH){
                $('.video-left-bar').css({display:'none'});
            }else{
                $('.video-left-bar').css({display:'initial'});
            }
        });
    });
    
</script>
          
          
          <?php if(barley_get_setting('related_posts')):echo zb_related_posts();endif;?>
          <?php if ( comments_open() || get_comments_number() ) :
            comments_template();
              endif;
          ?>
        </div>
        
        <?php if(($_GET['pay_return'] && $access == 1) || ($_GET['pay_check'] && $access == 1)){ ?>
            <script>UIkit.modal.confirm('<div style="     padding: 10px 20px; "><h1 style="     margin-bottom: 0px;     font-weight: 600;     color: #444;     font-size: 2.4rem; ">Thanks for your purchase!</h1><p style="     margin-bottom: 20px;     font-size: 1rem;     color: #777; ">The paid content you purchased will be unlocked instantly</p><p style="     font-size: 1rem;     color: #777;           ">If you encounter any problems, please contact our customer service email:<b style="     font-weight: 600;     ">he@holptech.com</b>, we will reply you as soon as possible.</p></div>')</script>
        <?php }elseif(($_GET['pay_return'] && $access == 0) || ($_GET['pay_check'] && $access == 0)){ ?>
            <script>UIkit.modal.confirm('<div style="     padding: 10px 20px; "><h1 style="     margin-bottom: 0px;     font-weight: 600;     color: #444;     font-size: 2.4rem; ">Payment failed!</h1><p style="     margin-bottom: 20px;     font-size: 1rem;     color: #777; ">There is no consumption record for this transaction in our database</p><p style="     font-size: 1rem;     color: #777;           ">If you have already paid, please contact our customer service email:<b style="     font-weight: 600;     ">he@holptech.com</b>, we will reply you as soon as possible.</p></div>')</script>
        <?php } ?>
        
<?php get_footer();?>