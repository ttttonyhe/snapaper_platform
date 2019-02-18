<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link href="https://static.zeo.im/uikit.min.css" rel="stylesheet">
<link href="https://static.zeo.im/uikit-rtl.min.css" rel="stylesheet">
<script type="text/javascript" src="https://static.zeo.im/uikit.min.js"></script>
<script src="https://static.ouorz.com/jquery.min.js"></script>
<link rel="Shortcut Icon" href="https://static.ouorz.com/snapaper_logo.ico" type="image/x-icon">
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="site">
		<header class="header-div">
			<div class="uk-container" style="margin-top: 1px;">
		<ul class="nav-1">
			<li>
				<a href="https://platform.snapaper.com" style="text-decoration:none">
					<h3 class="nav-title">
					<img src="https://static.ouorz.com/snapaper-logo.png" class="nav-title-img">napaper<b style="margin-left: 10px;font-weight: 200;letter-spacing: 1px;font-size: 1.4rem;">Platform</b></h3>
				</a>
			</li></ul>
		<ul class="nav-2">
		<li class="nav-2-icon1" style="padding: 1px 12px;border-radius: 4px;font-size: .8rem;margin-right: 15px;background-color: #fff;font-weight: 600;border: 1px solid #666;">
		    <a href="https://platform.snapaper.com/about-us" style="color: #666;">V0.15<b style="margin-left: 3px;"></b></a></li>
		<li class="nav-2-icon1">
			<a href="https://platform.snapaper.com/?s"><svg width="25" height="25" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="search"><circle fill="none" stroke="#666" stroke-width="1.5" cx="9" cy="9" r="7"></circle><path fill="none" stroke="#666" stroke-width="1.5" d="M14,14 L18,18 L14,14 Z"></path></svg></a></li>
			
		</ul>
	</div>
	</header>
	<div class="cap-nav">
    <div class="uk-container">
      <div class="cap-nav-right">
        <ul class="nav">
          <li>
              <a class="cap-nav-a" href="https://platform.snapaper.com" style="border-left: 1px solid #eee;">
                Home
                </a>          
          </li>
          <li>
              <a class="cap-nav-a" href="https://platform.snapaper.com/about-us">
                About
                </a>          
          </li>
          <?php 
          if(is_user_logged_in()){
              global $current_user; 
              $author_id = $current_user->ID;
              $author_name = $current_user->nickname;
              $membership = get_membership_array($author_id); //用户会员信息
          ?>
          <li>
              <a class="cap-nav-a" href="https://platform.snapaper.com/membership">
                Membership
                </a>          
          </li>
          <li>
              <a class="cap-nav-a <?php if(!empty($membership[0]['mem_type'])) echo 'a-mem'; ?>" href="/updates" style="color: #777;letter-spacing: 0px;font-weight: 600;">
                <?php echo get_avatar($author_id,96,'','user-avatar',array('width'=>120,'height'=>120,'rating'=>'X','class'=>array('header-avatar','uc-avatar'),'extra_attr'=>'title="user-avatar"','scheme'=>'https') ); ?><?php echo $author_name; ?></a>
          </li>
          <?php }else{ ?>
          <li>
              <a class="cap-nav-a" href="/login">
                Sign In
                </a>
          </li>
          <?php } ?>
        </ul>
      </div>
      <div class="cap-nav-left">
        <ul class="nav">
          <li>
              <a class="cap-nav-post" href="https://www.snapaper.com">
                Past Papers
                </a>          
          </li>
        </ul>
      </div>
    </div>
  </div>