<?php 
if( has_post_format( 'video' ) ){
	get_template_part('single_video' );
}else{
	get_template_part('single_post' );
}
?>