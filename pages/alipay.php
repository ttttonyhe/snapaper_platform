<?php 
/*
	Template Name: AliPay
*/
//过渡文件，前端GET提交到本文件，再用POST提交到支付提交文件

?>
<div style="display:none;">
<?php
    wp_head();
    
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
</div>
<script>
    console.log('<?php echo $allow; ?>');
</script>
<form method="POST" action="/alipay.php" id="submit">
	<input type="hidden" name='user' value='<?php echo (int)$_GET['user'] ?>'>
	<input type="hidden" name='post' value='<?php echo (string)$_GET['post'] ?>'>
	<input type="hidden" name='order_name' value='Snapaper | Alipay Online Payment'>
	<?php if(!empty($_GET['mem'])){ ?>
	
	<input type="hidden" name='amount' value='<?php
	    switch($_GET['mem']){
	        case 1: echo 9.9; break; //包月
	        case 2: echo 50; break; //半年
	        case 3: echo 90; break; //一年
	        default: echo 10000; break;
	    }
	?>'>
	<input type="hidden" name='duration' value='<?php
	    switch($_GET['mem']){
	        case 1: echo strtotime('+31day',time()); break; //包月
	        case 2: echo strtotime('+180day',time()); break; //半年
	        case 3: echo strtotime('+365day',time()); break; //一年
	        default: echo time(); break;
	    }
	?>'>
	<input type="hidden" name='mem_type' value='<?php
	    switch($_GET['mem']){
	        case 1: echo 1; break; //包月
	        case 2: echo 2; break; //半年
	        case 3: echo 3; break; //一年
	        default: echo 0; break;
	    }
	?>'>
	
	<?php }else{ ?>
	    <input type="hidden" name='amount' value='<?php echo get_post_meta((int)$_GET['post'],"payment_amount",true); ?>'>
	<?php } ?>
</form>

<script>
	document.getElementById('submit').submit();
</script>

<?php }else{ ?>

<script>
	window.location.href='https://platform.snapaper.com';
</script>

<?php } ?>
