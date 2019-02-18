<?php 
global $current_user;
$user_id = $current_user->ID;
$postid = $post->ID;
$posts_array = get_mark_posts($user_id);
if( in_array( $postid,$posts_array ) ){ ?>

<div class="uk-inline">
    <button class="report" id="markbutton" type="button"><i class="icon-favorite_border"></i></button>
    <div uk-dropdown="pos: left;mode:click" id="mark_view" class="mark-view">
        <h3 style="margin-bottom:5px">Remove from Collection</h3>
        <p>Are you sure you want to remove this article from your collection?</p>
        <button onclick="doing();" class="uk-button uk-button-secondary" style="width: 100%" id="op-btn">Remove</button>
        <button onclick="UIkit.dropdown(mark_view).hide();" class="uk-button uk-button-default" style="width: 100%;margin-top: 5px;">Not Now</button>
    </div>
</div>         
<!-- 文章收藏 -->
<script>
var change = document.getElementById('markbutton');
change.innerHTML = '<i class="icon-favorite" style="color: #ee561d;"></i>';

var doing = function(){
        var post = "<?php echo $postid; ?>";
        var user_id ="<?php echo $user_id; ?>";
        
        jQuery.ajax({
         type:     'GET'
         ,url:     '?action=mark_api&post_id=' + post + '&user_id=' + user_id + '&type=de'
         ,cache:    false
         ,dataType: 'json'
         ,contentType: 'application/json; charset=utf-8'
         ,success:   function(data){
            if(data.success == '1'){
                $('#op-btn').attr('onclick','UIkit.dropdown(mark_view).hide();');
                $('#op-btn')[0].innerHTML = 'Succeed';
                setTimeout('location.reload()',200);
            }
         }
         ,error:    function(data){
            if(data.success == '0'){
                $('#op-btn')[0].innerHTML = 'Faild';
                location.reload();
            }
         }
        });
    }

</script>
<!-- 文章收藏结束 -->



<?php }else{ ?>


<div class="uk-inline">
    <button class="report" id="markbutton" type="button"><i class="icon-favorite_border"></i></button>
    <div uk-dropdown="pos: left;mode:click" id="mark_view" class="mark-view">
        <h3 style="margin-bottom:5px">Add to Collection</h3>
        <p>Are you sure you want to add this article to your collection?</p>
        <button onclick="doing();" class="uk-button uk-button-secondary" style="width: 100%" id="op-btn">Add</button>
        <button onclick="UIkit.dropdown(mark_view).hide();" class="uk-button uk-button-default" style="width: 100%;margin-top: 5px;">Not Now</button>
    </div>
</div>
<!-- 文章收藏 -->
<script>

var doing = function(){
        var post = "<?php echo $postid; ?>";
        var user_id ="<?php echo $user_id; ?>";
        
        jQuery.ajax({
         type:     'GET'
         ,url:     '?action=mark_api&post_id=' + post + '&user_id=' + user_id + '&type=add'
         ,cache:    false
         ,dataType: 'json'
         ,contentType: 'application/json; charset=utf-8'
         ,success:   function(data){
            if(data.success == '1'){
                $('#op-btn').attr('onclick','UIkit.dropdown(mark_view).hide();');
                $('#op-btn')[0].innerHTML = 'Succeed';
                setTimeout('location.reload()',200);
            }
         }
         ,error:    function(data){
            if(data.success == '0'){
                $('#op-btn')[0].innerHTML = 'Faild';
                location.reload();
            }
         }
        });
    }
/* ajax 提交收藏结束 */

</script>
<!-- 文章收藏结束 -->

<?php } ?>