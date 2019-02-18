<?php
/*
	Template Name: Pay
*/
get_header();

$post_id = $_GET['post'];
$user_id = $_GET['user'];
$mem = $_GET['mem'];

$user_obj = get_user_by('ID',$_GET['user']);
$user_id = $user_obj->ID;
    
$allow = 1;
if(empty(get_post_meta((int)$_GET['post'],"payment_amount",true)) && (string)$_GET['post'] !== 'VIP'){
    $allow = 0;
}elseif(empty($user_id)){
    $allow = 0;
}else{
    $allow = 1;
}

if($allow){

?>

<div class="uk-container" style="margin: 20vh auto;" uk-scrollspy="target: > div; cls:uk-animation-slide-bottom-small; delay: 200">
    
    <div style="height: 110px;margin: 0 auto;text-align: center;" class="pay-wap-header">
        <h2 style="color: #444;font-size: 2.5rem;margin-bottom: 5px;" class="pay-wap-h2">Just a little paperwork</h2>
        <p style="color: #888;font-size: 1.1rem;" class="pay-wap-p">We’ll have you studying again shortly</p>
    </div>
    
    <div class="uk-card uk-card-default uk-width-1-2@m" style="height: 110px;margin: 0 auto;">
        <div class="uk-card-header" style="border: none;">
            <div class="uk-grid-small uk-flex-middle uk-grid uk-flex">
                <div class="uk-width-auto uk-first-column" style="padding: 0px;">
                    <a>
                        <img src="https://static.ouorz.com/QQ20190112-174001@2x.png" style="width: 55px;height: 55px;border-radius: 50%;margin-top: 6px;">
                    </a>
                </div>
                <div class="uk-width-expand" style="padding-left: 20px;">
                     <h3 class="uk-card-title uk-margin-remove-bottom wt-info-name pay-wap-h3" style="font-size: 1.8rem;">Alipay</h3>

                    <p class="uk-text-meta uk-margin-remove-top">
<em class="up-author-status wt-info-status" style="color: #999;font-style: normal;">Alipay.com</em>

                    </p>
                </div>
                <div> <a href="https://platform.snapaper.com/alipay?post=<?php echo $post_id; ?>&user=<?php echo $user_id; ?><?php if(!empty($mem)) echo '&mem='.$mem; ?>" style="padding: 8px 13px 8px 13px;border-radius: 4px;color: #666;border: 1px solid #999;font-size: 1rem;z-index:5">Check Out</a>

                </div>
            </div>
        </div>
    </div>
    
    <div class="uk-card uk-card-default uk-width-1-2@m" style="height: 110px;margin: 20px auto;">
        <div class="uk-card-header" style="border: none;">
            <div class="uk-grid-small uk-flex-middle uk-grid uk-flex">
                <div class="uk-width-auto uk-first-column" style="padding: 0px;">
                    <a>
                        <img src="https://static.ouorz.com/QQ20190112-174956@2x.png" style="width: 55px;height: 55px;border-radius: 50%;margin-top: 6px;">
                    </a>
                </div>
                <div class="uk-width-expand" style="padding-left: 20px;">
                     <h3 class="uk-card-title uk-margin-remove-bottom wt-info-name pay-wap-h3" style="font-size: 1.8rem;">WeChat Pay</h3>

                    <p class="uk-text-meta uk-margin-remove-top">
<em class="up-author-status wt-info-status" style="color: #999;font-style: normal;">Pay.weixin.qq.com</em>

                    </p>
                </div>
                <div> <a href="https://platform.snapaper.com/wechatpay?post=<?php echo $post_id; ?>&user=<?php echo $user_id; ?><?php if(!empty($mem)) echo '&mem='.$mem; ?>" style="padding: 8px 13px 8px 13px;border-radius: 4px;color: #666;border: 1px solid #999;font-size: 1rem;z-index:5">Check Out</a>

                </div>
            </div>
        </div>
    </div>
</div>
<?php }else{ ?>

<script>
	window.location.href='https://platform.snapaper.com';
</script>

<?php } get_footer(); ?>