<?php

if ( ! defined('ABSPATH')) exit;  // if direct access 

if(isset($_GET['id'])){
	
	$user_id = sanitize_text_field($_GET['id']);
	//var_dump($user_id);
	}
else{
	
	if(is_author()){
		$user_id =get_the_author_meta( 'ID' );
		}
	else{
		$user_id = get_current_user_id();
		}
	}
	
$is_following = '';
$follow_text = __('Follow', 'music-press-member');
$follow_class = '';
if(is_user_logged_in()){
	
	$logged_user_id = get_current_user_id();
	
	}
	$follow_text = __('Message', 'music-press-member');
	$user_avatar = get_avatar($user_id, 200);
	$user = get_user_by('ID', $user_id);

?>
   
    <div user_id="<?php echo $user_id; ?>" class="message <?php echo $follow_class; ?>"> 
    
    <?php
    
	echo $follow_text;	
	?>
    
    </div>    

