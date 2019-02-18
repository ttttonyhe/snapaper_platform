<?php
/*
* Template Name: 会员开通页面
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
<?php
    
    if(is_user_logged_in()){
        global $current_user;
        $user_id = $current_user->ID;
        $user_email = $current_user->user_email;
        $user_name = $current_user->nickname; 
        $membership = get_membership_array($user_id);
?>
		<div class="site-content" style="padding-top:20px">
			<div class="content-area" uk-scrollspy="target: > div; cls:uk-animation-slide-bottom-small; delay: 200">
			    
			    <div style="width: 70%;margin-left: auto;margin-right: auto;margin-bottom: 2vh;" class="wap-mem-header">
                    <img style="width:100%" src="https://res.soulhost.cn/wp-content/uploads/2019/01/2019011609121457.png" />
                </div>
			    
				<div class="content small wap-mem-list" uk-scrollspy="target: > div; cls:uk-animation-slide-bottom-small; delay: 200" style="display: flex;width: 70%;margin-left: auto;margin-right: auto;">


<div class="uk-card uk-card-default uk-width-1-2@m wap-mem-list-div" id="div-1">
    <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle uk-grid uk-grid-stack" uk-grid="">
            
            <div class="uk-width-expand uk-first-column" style="padding: 0px;">
                <h3 class="uk-card-title uk-margin-remove-bottom">One Month</h3>
                <p class="uk-text-meta uk-margin-remove-top"><time>Membership Ownership</time></p>
            </div>
        </div>
    </div>
    <div class="uk-card-body">
        <p style="color: #999;"><b style="font-size: 3rem;font-weight: 600;color: #333;">¥9.9</b> / 31 Days</p>
        <p style="letter-spacing: .2px;">Become a Snapaper member to get unlimited access to the finest videos and useful study notes you won’t find anywhere else.
        </p>
        <p style="letter-spacing: 0px;font-weight: 600;color: #666;">
            √ All Videos Full HD Playback<br><br/><br/>
        </p>
    </div>
    <div class="uk-card-footer">
        <div id="day-1"></div>
        <a href="https://platform.snapaper.com/pay?post=VIP&user=<?php echo $user_id; ?>&mem=1" class="uk-button uk-button-text" style="color: #333;font-weight:700" id="1">Get Started</a>
    </div>
</div>

<div class="uk-card uk-card-default uk-width-1-2@m wap-mem-list-div" style="margin-left:3%" id="div-2">
    <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle uk-grid uk-grid-stack" uk-grid="">
            
            <div class="uk-width-expand uk-first-column" style="padding: 0px;">
                <h3 class="uk-card-title uk-margin-remove-bottom">Six Month</h3>
                <p class="uk-text-meta uk-margin-remove-top"><time>Membership Ownership</time></p>
            </div>
        </div>
    </div>
    <div class="uk-card-body">
        <p style="color: #999;"><b style="font-size: 3rem;font-weight: 600;color: #333;">¥50</b> / 180 Days</p>
        <p style="letter-spacing: .2px;">Become a Snapaper member to get unlimited access to the finest videos and useful study notes you won’t find anywhere else.
        </p>
        <p style="letter-spacing: 0px;font-weight: 600;color: #666;">
            √ All Videos Full HD Playback<br>
            √ All Posts Free to Read<br><br/>
        </p>
    </div>
    <div class="uk-card-footer">
        <div id="day-2"></div>
        <a href="https://platform.snapaper.com/pay?post=VIP&user=<?php echo $user_id; ?>&mem=2" class="uk-button uk-button-text" style="color: #333;font-weight:700" id="2">Get Started</a>
    </div>
</div>

<div class="uk-card uk-card-default uk-width-1-2@m wap-mem-list-div" style="margin-left:3%" id="div-3">
    <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle uk-grid uk-grid-stack" uk-grid="">
            
            <div class="uk-width-expand uk-first-column" style="padding: 0px;">
                <h3 class="uk-card-title uk-margin-remove-bottom">One Year</h3>
                <p class="uk-text-meta uk-margin-remove-top"><time>Membership Ownership</time></p>
            </div>
        </div>
    </div>
    <div class="uk-card-body">
        <p style="color: #999;"><b style="font-size: 3rem;font-weight: 600;color: #333;">¥90</b> / 365 Days</p>
        <p style="letter-spacing: .2px;">Become a Snapaper member to get unlimited access to the finest videos and useful study notes you won’t find anywhere else.
        </p>
        <p style="letter-spacing: 0px;font-weight: 600;color: #666;">
            √ All Videos Full HD Playback<br>
            √ All Posts Free to Read<br>
            √ High priority customer service<br>
        </p>
    </div>
    <div class="uk-card-footer">
        <div id="day-3"></div>
        <a href="https://platform.snapaper.com/pay?post=VIP&user=<?php echo $user_id; ?>&mem=3" class="uk-button uk-button-text" style="color: #333;font-weight:700" id="3">Get Started</a>
    </div>
</div>


    
    
</div>

    <div style="width: 70%;margin-left: auto;margin-right: auto;margin-top: 6vh;" class="wap-mem-notice">
        
        <ul style="font-size: 1rem;font-weight: 300;line-height: 1.7;">
            <li style="margin-bottom: 5px;">The above membership rights will be unlocked for you after clicking the 'Get Started' button and pay, and once the user has successfully paid, the user has agreed to all the terms and conditions that we have posted on the website.</li>
            <li style="margin-bottom: 5px;">Please note that not all member types include all member rights. For example, monthly members will not be entitled to free reading of all articles, but members who pay annually or half a year will enjoy this right.</li>
            <li style="margin-bottom: 5px;">We will do our best to ensure the privacy of each user, but we will not be able to provide users with data protection and refund services due to security issues such as force majeure or man-made cyber attacks and data intrusion.</li>
            <li style="margin-bottom: 5px;">When the user is already a member, the above list will display the 'Renew' button at the corresponding location. When the old membership invoice has not expired, the next membership invoice paid by the user will increase the corresponding membership usage time for the user. When the old membership invoice has expired, the next membership invoice paid by the user will increase the the corresponding membership usage time from the moment of payment.</li>
            <li style="margin-bottom: 5px;">Please note that when the membership type of the two payments is different, the user membership type will be changed for the user. For example, if a user previously owns a monthly membership, when he purchased an annual membership, the user would be upgraded to an annual membership.</li>
            </ul><p></p>
    </div>

			</div>
		</div>
	
		<script>
		    $('#<?php echo $membership[0]['mem_type']; ?>')[0].innerHTML = 'Renew';
		    $('#div-<?php echo $membership[0]['mem_type']; ?>').css({'border':'2px solid #55c1f5','border-radius':'4px'});
		    $('#day-<?php echo $membership[0]['mem_type']; ?>')[0].innerHTML = '<b style="color: #00aaee;float: left;font-weight: 600;letter-spacing: 0px;text-transform: capitalize;" class="uk-button uk-button-text"><?php echo get_membership_time(time(),$membership[0]['mem_duration']); ?> days Left</b>';
		    $('#<?php echo $membership[0]['mem_type']; ?>').css('float','right');
		</script>
		
		<?php if(($_GET['pay_return'] && $membership[0]['type'] !== 0) || ($_GET['pay_check'] && $membership[0]['type'] !== 0)){ ?>
            <script>UIkit.modal.confirm('<div style="     padding: 10px 20px; "><h1 style="     margin-bottom: 0px;     font-weight: 600;     color: #444;     font-size: 2.4rem; ">Thanks for your purchase!</h1><p style="     margin-bottom: 20px;     font-size: 1rem;     color: #777; ">Members featured content you own will be unlocked immediately</p><p style="     font-size: 1rem;     color: #777;           ">If you encounter any problems, please contact our customer service email:<b style="     font-weight: 600;     ">he@holptech.com</b>, we will reply you as soon as possible.</p></div>')</script>
        <?php }elseif(($_GET['pay_return'] && $membership[0]['type'] !== 0) || ($_GET['pay_check'] && $membership[0]['type'] !== 0)){ ?>
            <script>UIkit.modal.confirm('<div style="     padding: 10px 20px; "><h1 style="     margin-bottom: 0px;     font-weight: 600;     color: #444;     font-size: 2.4rem; ">Payment failed!</h1><p style="     margin-bottom: 20px;     font-size: 1rem;     color: #777; ">There is no consumption record for this transaction in our database</p><p style="     font-size: 1rem;     color: #777;           ">If you have already paid, please contact our customer service email:<b style="     font-weight: 600;     ">he@holptech.com</b>, we will reply you as soon as possible.</p></div>')</script>
        <?php } ?>
        
        
		
		
		<?php }else{ wp_redirect( site_url() ); } ?>
<?php get_footer();?>
