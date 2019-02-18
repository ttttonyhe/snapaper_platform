<?php 

/* Template Name: 个人中心 */ 

get_header()

?>

<?php if(!is_user_logged_in()) { ?>
<script type="text/javascript">
    window.location.href = 'https://platform.snapaper.com/login';
</script>
<?php }else{ ?>
<?php     
        global $current_user; 
        $author_id = $current_user->ID; 
        $author_name = $current_user->nickname; 
        $user_email = $current_user->user_email;
        $membership = get_membership_array($author_id); //用户会员信息
 ?>



<div class="container" style="margin: 9vh auto 15vh auto;display: flex;padding: 0 14vh;">
    <div class="uk-width-1-2@m uk-card uk-card-default uk-animation-slide-bottom-small" style="box-shadow: 0px 1px 6px #ccc;flex-basis: 50%;margin-right: 20px;">
        
        <div class="uk-card-header" style="padding: 60px 0px;">
        <div class="uk-grid-small uk-flex-middle uk-grid" uk-grid="" style="width: 60%;margin-left: auto;margin-right: auto;">
            <div class="uk-width-auto uk-first-column">
                <?php echo get_avatar($author_id,96,'','user-avatar',array('width'=>120,'height'=>120,'rating'=>'X','class'=>array('uk-card','uk-card-default','uk-card-hover','uc-avatar'),'extra_attr'=>'title="user-avatar"','scheme'=>'https') ); ?>            
            </div>
            <div class="uk-width-expand">
                <h3 class="uk-card-title uk-margin-remove-bottom" style="font-size: 2rem;width: 140%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><?php echo $author_name; ?></h3>
                <p class="uk-text-meta uk-margin-remove-top" style="overflow: hidden;text-overflow: ellipsis;"><email><?php echo $user_email; ?></email></p>
            </div>
        </div>
        <div style="text-align: center;padding-top: 30px;width: 60%;margin: 0 auto;">
                

                <a href="/editinfo" style="text-align: center;">
                    <button style="font-size: .9rem;border-radius: 4px;border: 1px solid #888;color: #777;padding: 6px 12px;font-weight: 500;background: #fff;">Change Profile</button>
                </a>
                <a href="<?php echo wp_logout_url(get_permalink()); ?>" style="text-align: center;margin-left: 10px;">
                    <button style="font-size: .9rem;border-radius: 4px;border: 1px solid #888;color: #777;padding: 6px 15px;font-weight: 500;background: #fff;"><svg width="13" height="13" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-left" style="margin-right: 5px;"><polyline fill="none" stroke="#555" points="10 14 5 9.5 10 5" style="width: 2px;"></polyline><line fill="none" stroke="#555" x1="16" y1="9.5" x2="5" y2="9.52"></line></svg>Sign Out</button>
                </a>
            </div>
    </div>
    
        <?php $payment = get_payment_record_array($author_id); ?>
        <div style="text-align: center;background: #f1f2f3;font-size: 1.1rem;letter-spacing: 1px;color: #777;padding: 10px 0;">
            <p style="margin: 0px;">- Payment Record -</p>
        </div>
    
    <div>
        <?php for($i=0;$i<count($payment);$i++){ ?>
        <div class="uc-record">
            <h3>¥<?php echo $payment[$i]['amount']; ?></h3>
            <p>
                <b><?php
                        if($payment[$i]['post_id'] !== 'VIP')
                            echo get_post($payment[$i]['post_id'])->post_title;
                        else
                            echo 'Membership Ownership';
                    ?></b><br>
                <em><?php echo date("Y-m-d",$payment[$i]['time']); ?></em>
            </p>
        </div>
        <?php }
            if(count($payment)==0){ ?>
        <div class="uc-record">
            <p>
                <b>Nothing Here</b><br>
                <em>Continue to Explore More?</em>
            </p>
        </div>
        <?php } ?>
        
        
    </div>
    
    <div style="text-align: center;background: #f1f2f3;font-size: 1.1rem;letter-spacing: 1px;color: #777;padding: 10px 0;">
            <p style="margin: 0px;">- User Stats -</p>
        </div>
    
    <div style="display: flex;">
    <div class="uc-stats">
        <h3><?php echo count($payment); ?></h3>
        <p>
            <em>Total</em>
            <br>Payment</p>
    </div>
    <div class="uc-stats" style="border-left: 1px solid #eee;">
        <h3><?php echo get_user_comments_count($author_id); ?></h3>
        <p>
            <em>Total</em>
            <br>Comment</p>
    </div>
    </div>
    
    
    </div>
    
<div class="uk-width-1-2@m uk-card uk-card-default uk-animation-slide-bottom-small" style="box-shadow: 0px 1px 6px #ccc;margin-left: 20px;flex-basis: 50%;width: 478.99px;height: 559.38px;">
       <ul uk-tab="" class="uk-tab" style="margin: 0;text-align: center;margin-right: -20px;">
    <li aria-expanded="true" class="uk-active" style="flex-basis: 33.3333333333333%;"><a href="#">Collection</a></li>
    <li aria-expanded="false" class="" style="flex-basis: 33.3333333333333%;"><a href="#">Comments</a></li>
    <li aria-expanded="false" class="" style="flex-basis: 33.3333333333333%;"><a href="#">Membership</a></li>
</ul>

<ul class="uk-switcher uk-margin" style="margin: 0px !important;">
    <li style="width: 478.99px;overflow-y: auto;height: 520px;">
        
        
        <div style="text-align: center;background: #f1f2f3;font-size: 1.1rem;letter-spacing: 1px;color: #777;padding: 10px 0;">
            <p style="margin: 0px;">- Posts Collection -</p>
        </div>
        <?php 
            /* 文章收藏 */
            $posts = get_the_author_meta('mark_post',$author_id);
            $posts_array = explode(',',$posts);
            $posts_array_length = count($posts_array);
            if($posts_array_length == 1){
                if($posts_array[0] == ''){
                    $av = 1;
                }else{
                    $posts_array[0] = $posts;
                }
            }
            /* 文章收藏结束 */

if(count($posts_array)>=1 && $av != 1){
    for($i=0;$i<count($posts_array);$i++){
        $postid = $posts_array[$i];
        $img_id = get_post_thumbnail_id($postid); 
        $img_url = wp_get_attachment_image_src($img_id);
        $img_url = $img_url[0];
        $author = get_post($postid)->post_author;
        $author = get_the_author_meta('display_name',$author);
        $title = get_post($postid)->post_title;
        $url = get_post($postid)->post_name;
        $time = get_post($postid)->post_date;
?>

        <div class="uc-record">
            <h3 style="margin-top: -9px;"><img src="<?php echo $img_url; ?>" style="border: 1px solid #eee;border-radius: 4px;"></h3>
            <p style="border: none;padding-left: 5px;">
                <b><a href="<?php echo $url; ?>" style="color:#666"><?php echo $title; ?></a></b><br>
                <em><?php echo $time; ?>&nbsp;|&nbsp;<?php echo $author; ?></em>
            </p>
        </div>
<?php }}else{ ?>
<div class="uk-placeholder uk-text-center" style="margin:0;">Nothing Here</div>
<?php } ?>


    </li>
    
    
    <li style="width: 478.99px;overflow-y: auto;height: 520px;">
        <div style="text-align: center;background: #f1f2f3;font-size: 1.1rem;letter-spacing: 1px;color: #777;padding: 10px 0;">
            <p style="margin: 0px;">- User Comments -</p>
        </div>
        <?php
    $args = array(
        'user_id' => $author_id,
    );
    $comments = get_comments( $args );
    if(count($comments)>=1){
?>
<?php 
    foreach ( $comments as $comment ):
        $content_c = $comment->comment_content; 
        $postid_c = $comment->comment_post_ID; 
        $title_c = get_post($postid_c)->post_title;
        $url_c = get_post($postid_c)->post_name;
        $time_c = lb_time_since(strtotime($comment->comment_date)); 
?>
        <div class="uc-record" style="display: block;width: 100%;">
            <p style="border: none;padding: 0px;line-height: 17px;box-shadow: 0px 0.5px 4px 0px rgba(0,0,0,0.2);padding: 13px;border-radius: 4px;margin-bottom: 15px;"><a style="color:#666" href="<?php echo $url_c; ?>"><?php echo $title_c; ?></a></p>
            <b style="line-height: 50px;color:#444;white-space: normal;line-height: 25px;"><?php echo $content_c; ?></b>
            <em style="margin-left: 10px;"><?php echo $time_c; ?></em>
        </div>
<?php
    endforeach;
?>
<?php }else{ ?>
<div class="uk-placeholder uk-text-center" style="margin:0;">Nothing Here</div>
<?php } ?>
    </li>
    <li style="width: 478.99px;">
        <div style="text-align: center;background: #f1f2f3;font-size: 1.1rem;letter-spacing: 1px;color: #777;padding: 10px 0;">
            <p style="margin: 0px;">- User Membership -</p>
        </div>
        <?php if(empty($membership[0]['mem_type'])){ ?>
        <div class="uc-mem">
            <div class="uc-mem-center">
              <div class="glyph glyph-enterprise" style="margin-top: 44px;display: inline-block;vertical-align: middle;color: #333;background-position: center -174px;font-size: 2.5rem;font-weight: 600;">Membership</div>
              <div class="subtitle" style="margin-top: 15px;color: #888;opacity: 0.8;font-size: 1.1rem;letter-spacing: .4px;line-height: 24px;">Snapaper for people who love to study</div>
              <div class="uc-mem-price-wrapper">
                <span class="uc-mem-price-low">Only for</span>
                <span class="uc-mem-price-symbol">¥</span>
                
                  <span class="uc-mem-price-number">9.9</span>
                  <span class="uc-mem-price-unit">／Mo</span>
                
              </div>
              <div class="uc-mem-price-note">(Monthly)</div>
              <div class="uc-mem-buttons">
                  <div>
                      <a href="/membership" target="_blank" class="uc-mem-button">Get Started</a>
                    </div>
              </div>
            </div>
        </div>
        <?php }else{ 
            switch($membership[0]['mem_type']){
                case 1:
                    $type = 'Monthly Member';
                    break;
                case 2:
                    $type = 'Half-Anual Member';
                    break;
                case 3:
                    $type = 'Anual Member';
                    break;
                default:
                    break;
            }
        ?>
        <div class="uc-mem-already" style="background-image: linear-gradient(211deg, rgb(65, 58, 4) 0%, rgb(44, 48, 51)) !important;margin-top:30px">
            <h2 class="uc-mem-type"><?php echo $type; ?></h2>
            <p class="uc-mem-expire">Expire Time <?php echo date("Y-m-d",$membership[0]['mem_duration']); ?></p>
            <p class="uc-mem-expire-days"><?php echo get_membership_time(time(),$membership[0]['mem_duration']); ?> Left</p>
            <img src="https://res.soulhost.cn/wp-content/uploads/2019/01/2019011713062144.png" class="uc-mem-crown">
        </div>
        <div class="uc-mem-already">
            <h2 class="uc-mem-type">&yen;<?php echo $membership[0]['amount']; ?></h2>
            <p class="uc-mem-expire">Starts From <?php echo date("Y-m-d",$membership[0]['timenum']); ?></p>
            <p class="uc-mem-expire-days"><a href="/membership" style="color:#fff">Renew</a></p>
            <img src="https://res.soulhost.cn/wp-content/uploads/2019/01/2019011714285415.png" class="uc-mem-money">
        </div>
        <?php } ?>
        
    </li>
</ul> 
        
    
    
    
    
    
    </div>
</div>

<script>(function(i,s,o,g,r,a,m){i["DaoVoiceObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;a.charset="utf-8";m.parentNode.insertBefore(a,m)})(window,document,"script",('https:' == document.location.protocol ? 'https:' : 'http:') + "//widget.daovoice.io/widget/e5b69a59.js","daovoice")</script>
<script>
daovoice('init', {
  app_id: "e5b69a59",
  user_id: "<?php echo $author_id; ?>", // 必填: 该用户在您系统上的唯一ID
  email: "<?php echo $user_email; ?>", // 选填:  该用户在您系统上的主邮箱
  name: "<?php echo $author_name; ?>" // 选填: 用户名
});
daovoice('update');
		</script>


<?php } ?>

<?php get_footer(); ?>