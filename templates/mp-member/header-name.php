<?php

if ( ! defined('ABSPATH')) exit;  // if direct access

if(is_user_logged_in()){
	
	$logged_user_id = get_current_user_id(); 
	
	//var_dump($logged_user_id);
	}

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
	$user_avatar = get_avatar($user_id, 200);
	$user = get_user_by('ID', $user_id);
	$display_name = $user->display_name;
?>
   
    <div class="name"> <?php echo apply_filters('music_press_member_filter_user_name', $display_name, $user_id); ?></div>

