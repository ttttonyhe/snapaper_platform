<?php
/*
* Template Name: 资金收入页面
*/
get_header();?>
<script>(function(i,s,o,g,r,a,m){i["DaoVoiceObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;a.charset="utf-8";m.parentNode.insertBefore(a,m)})(window,document,"script",('https:' == document.location.protocol ? 'https:' : 'http:') + "//widget.daovoice.io/widget/e5b69a59.js","daovoice")</script>
<script>
daovoice('init', {
  app_id: "e5b69a59",
  user_id: "<?php echo $user_id; ?>", // 必填: 该用户在您系统上的唯一ID
  email: "<?php echo $user_email; ?>", // 选填:  该用户在您系统上的主邮箱
  name: "<?php echo $user_name; ?>" // 选填: 用户名
});
daovoice('update');
		</script>
		

<div class="uk-container" style="margin: 20vh auto;">
    
    <div style="height: 110px;margin: 0 auto;text-align: center;" class="pay-wap-header">
        <h2 style="color: #444;font-size: 2.5rem;margin-bottom: 5px;" class="pay-wap-h2">Financial Statements</h2>
        <p style="color: #888;font-size: 1.1rem;" class="pay-wap-p">Total Revenue: <?php echo (get_total_payment_amount('alipay') + get_total_payment_amount('wechat')); ?></p>
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
<em class="up-author-status wt-info-status" style="color: #999;font-style: normal;">Total Revenue</em>

                    </p>
                </div>
                <div> <a style="padding: 8px 13px 8px 13px;border-radius: 4px;color: #666;border: 1px solid #999;font-size: 1rem;z-index:5"><?php echo get_total_payment_amount('alipay'); ?></a>

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
<em class="up-author-status wt-info-status" style="color: #999;font-style: normal;">Total Revenue</em>

                    </p>
                </div>
                <div> <a style="padding: 8px 13px 8px 13px;border-radius: 4px;color: #666;border: 1px solid #999;font-size: 1rem;z-index:5"><?php echo get_total_payment_amount('wechat'); ?></a>

                </div>
            </div>
        </div>
    </div>
</div>		



<?php get_footer();?>
