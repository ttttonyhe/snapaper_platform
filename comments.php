<div class="bottom-area">
<div class="container small">
<?php
if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
	return;
}
?>
<div id="comments" class="comments-area">
	<h3 class="comments-title" style="font-size: 1.5rem;"><?php echo number_format_i18n( get_comments_number() );?> Comments</h3>
	<div class="commentshow">
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
				    //'callback'    =>'comment',
					'avatar_size' => 96,
					'per_page' => get_option('comments_per_page'),
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => '<span class="icon-reply"></span> Reply',
				) );
			?>
		</ol>
		<?php
		$ajaxopen = barley_get_setting('ajax_comment_nav');
		if( $ajaxopen ){
			$cpage = get_query_var('cpage') ? get_query_var('cpage') : 1;
			if( $cpage > 1 ) {
				echo '<nav class="commentnav" role="navigation"><div class="nav-links"><span class="cnav-item zb_comment_loadmore">More Comments</span></div></nav>
				<script>
				var parent_post_id = ' . get_the_ID() . ',
				cpage = ' . $cpage . '
				</script>';
			} 
		}else{ 
			zb_comment_nav();
		}?>
	</div>
	<?php 
	
	if(is_user_logged_in()){
	    
	    global $current_user; 
        $author_id = $current_user->ID; 
        $author_name = $current_user->nickname; 
	    $comment_header = get_avatar($author_id,96,'','user-avatar',array('width'=>120,'height'=>120,'rating'=>'X','class'=>array('header-avatar','uc-avatar','comments-avatar'),'extra_attr'=>'title="user-avatar"','scheme'=>'https') ).'<h4 class="comments-author">'.$author_name.'</h4><a class="comments-logout" href="'.wp_logout_url(get_permalink()).'">Log Out</a>';
	    
	}else{
	    
	    $comment_header = '';
	    
	}
	?>
	
	
		<?php 
		$comments_args = array(
        'label_submit'=>'Send',
		
        'title_reply'=>$comment_header,
		
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" rows="8" aria-required="true" style="height: 100px;"></textarea></p><div class="row comment-author-inputs">',

        'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
			  '<div class="col-md-4"><p class="comment-form-author"><label for="author">Name*</label>'  .
			  '<input id="author" class="blog-form-input" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			  '" size="30" aria-required="true" /></p></div>',

			'email' =>
			  '<div class="col-md-4"><p class="comment-form-email"><label for="email">Email*</label>'.
			  '<input id="email" class="blog-form-input" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			  '" size="30" aria-required="true"/></p></div>',

			'url' =>
			  ''.$geetestdiv1.''.
			  ''.$geetestdiv2.''
		)),
	);
	comment_form($comments_args);?>
</div>
</div>
</div>