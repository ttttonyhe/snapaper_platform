jQuery.extend(jQuery.fn, {
	validate: function () {
		if (jQuery(this).val().length < 2) {jQuery(this).addClass('errormessage');return false} else {jQuery(this).removeClass('errormessage');return true}
	},
	validateEmail: function () {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
		    emailToValidate = jQuery(this).val();
		if (!emailReg.test( emailToValidate ) || emailToValidate == "") {
			jQuery(this).addClass('errormessage');return false
		} else {
			jQuery(this).removeClass('errormessage');return true
		}
	},
});
jQuery(function($){
	$( '#commentform' ).submit(function(){
		var button = $('#submit'),
		    respond = $('#respond'),
		    commentlist = $('.comment-list'),
		    cancelreplylink = $('#cancel-comment-reply-link');
			
		if( $( '#author' ).length )
			$( '#author' ).validate();
 
		if( $( '#email' ).length )
			$( '#email' ).validateEmail();
		
		$( '#comment' ).validate();
 
		if ( !button.hasClass( 'loadingform' ) && !$( '#author' ).hasClass( 'errormessage' ) && !$( '#email' ).hasClass( 'errormessage' ) && !$( '#comment' ).hasClass( 'errormessage' ) ){

			$.ajax({
				type : 'POST',
				url : comment_objc.ajaxurl, // admin-ajax.php URL
				data: $(this).serialize() + '&action=ajaxcomments', // send form data + action parameter
				beforeSend: function(xhr){
					button.addClass('loadingform').val('Loading...');
				},
				error: function (request, status, error) {
					if( status == 500 ){
						alert( 'Faild' );
					} else if( status == 'timeout' ){
						alert('Faild');
					} else {
						var wpErrorHtml = request.responseText.split("<p>"),
							wpErrorStr = wpErrorHtml[1].split("</p>");
 
						alert( wpErrorStr[0] );
					}
				},
				success: function ( addedCommentHTML ) {
 
					if( commentlist.length > 0 ){
 
						if( respond.parent().hasClass( 'comment' ) ){
 
							if( respond.parent().children( '.children' ).length ){	
								respond.parent().children( '.children' ).append( addedCommentHTML );
							} else {
								addedCommentHTML = '<ol class="children">' + addedCommentHTML + '</ol>';
								respond.parent().append( addedCommentHTML );
							}
							cancelreplylink.trigger("click");
						} else {
							commentlist.append( addedCommentHTML );
						}
					}else{
						addedCommentHTML = '<ol class="comment-list">' + addedCommentHTML + '</ol>';
						respond.before( $(addedCommentHTML) );
					}
					$('#comment').val('');
				},
				complete: function(){
					button.removeClass( 'loadingform' ).val( 'Send' );
				}
			});
		}
		return false;
	});
});
jQuery(function($){
	$('.zb_comment_loadmore').click( function(){
		var button = $(this);
		cpage--;
 
		$.ajax({
			url : comment_objc.ajaxurl,
			data : {
				'action': 'cloadmore',
				'post_id': parent_post_id,
				'cpage' : cpage,
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...');
			},
			success : function( data ){
				if( data ) {
					$('ol.comment-list').append( data );
					button.text('More comments'); 
					if ( cpage == 1 )
						button.remove();
				} else {
					button.remove();
				}
			}
		});
		return false;
	});
 
});