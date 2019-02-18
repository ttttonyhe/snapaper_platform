<?php 
/*
Template Name: 会员添加
*/
get_header();?>
<?php wp_no_robots(); ?>
<?php
    global $current_user;
	$author_id = $current_user->ID;
    if($author_id !== 1){ ?>
        <script type="text/javascript">
            window.location.href = 'https://platform.snapaper.com/login';
        </script>
<?php }else{
    
    
    
    if($_POST['check'] == 'check'){
        

        $type = $_POST['type'];
        $op = $_POST['operate'];
        $id = $_POST['user'];
        
        $url = 'localhost';
        $user = 'root';
        $passwd = 'Goodhlp616877';
        $con = mysqli_connect($url,$user,$passwd,'snapaper',3306);
        $sql1='SELECT mem_duration FROM snap_payment_user WHERE user_id = "'.$id.'" AND post_id = "VIP"';
        $current=mysqli_query($con,$sql1);
        $current_duration=mysqli_fetch_array($current,MYSQLI_ASSOC);
        mysqli_free_result($current);
        
        switch ($type){
                case 1:
                    $add_time = '+31day';
                    break;
                case 2:
                    $add_time = '+180day';
                    break;
                case 3:
                    $add_time = '+365day';
                    break;
                default:
                    $error.='type不对<br/>';
                    break;
            }
            
        switch($op){
                case 'new':
                    if(empty($current_duration['mem_duration'])){
                        $sql = 'insert into snap_payment_user (post_id,user_id,amount,timenum,mem_duration,mem_type) values("VIP","'.(int)$id.'","0.01","'.time().'","'.strtotime($add_time,time()).'","'.(int)$type.'")';
                    }else{
                        $error.='用户开通过会员,无法插入<br/>';
                    }
                        break;
                case 'con':
                    if(!empty($current_duration['mem_duration'])){
                        $sql = 'UPDATE snap_payment_user SET mem_duration="'.strtotime($add_time,(int)$current_duration['mem_duration']).'",mem_type="'.$type.'",amount="0.01" WHERE user_id="'.(int)$id.'" AND post_id = "VIP"';
                    }else{
                        $error.='用户没开通会员,无法更新<br/>';
                    }
                    break;
                default:
                    $error.='operate不对<br/>';
                    break;
            }
        
        if(!mysqli_query($con,$sql)){
            $error .='失败'.$op.'了'.$id.'为类型'.$type.'<br/>';
        }else{
            $error .='成功'.$op.'了'.$id.'为类型'.$type.'<br/>';
        }
        mysqli_close($con);
        
        
        
    }
    
?>

<script>
    function close_error(){
        var change=document.getElementById('error');
        change.style.display="none";
    }
</script>


<?php the_content(); ?>
<?php if(!empty($error)) {
  echo '<div id="error" class="intro"><div class="intro-bg animations-fadeIn-bg"></div><div id="close_error" class="intro-area animations-fadeInUp-focus" style="border-radius: 3px;box-shadow:0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12)"><div class="intro-content" style="width: 510px;max-height: calc(100vh - 5px * 2);"><div class="intro-content-container" style="font-size: 18px;padding: 40px 30px;text-align:center" id="report_container"><div class="intro-content-header"><div class="intro-content-title">提示</div></div><p style="text-align: center;font-size: 19px;">'.$error.'</p><div class="intro-content-button"><button onclick="close_error();" class="intro-button">Close</button></div></div></div></div></div>';
} ?>
<style>
    .form{
        margin: 20vh auto;
        width: 40%;
    }
    .form-sub{
        margin-bottom: 20vh;
    }
    label{
        padding: 0px !important;
        margin-right: 10px !important;
    }
</style>
<div class="uk-container">
<form class="form" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">

    <fieldset class="uk-fieldset form-sub">

        <legend class="uk-legend">Membership Administration</legend>

        <div class="uk-margin">
            <select class="uk-select" name="user">
                <?php 
                    $args = array('orderby' => 'display_name');
                    $wp_user_query = new WP_User_Query($args);
                    $authors = $wp_user_query->get_results();
                    foreach ($authors as $author) {
                        $author_info = get_userdata($author->ID);
                        echo '<option value="'.$author->ID.'">'.$author_info->nickname.'('.$author->ID.')'.'</option>';
                    }
                ?>
            </select>
        </div>
        

        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            <label><input class="uk-radio" type="radio" name="operate" value="new" checked> Insert</label>
            <label><input class="uk-radio" type="radio" name="operate" value="con"> Update</label>
        </div>

        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            <label><input class="uk-radio" type="radio" name="type" value="1" checked> Monthly</label>
            <label><input class="uk-radio" type="radio" name="type" value="2"> Half Annual</label>
            <label><input class="uk-radio" type="radio" name="type" value="3"> Annual</label>
        </div>
        
        <input type="hidden" name="check" value="check" />
        <input type="submit" name="submit" value="Submit" />

    </fieldset>
</form>
</div>
<?php get_footer(); }?>