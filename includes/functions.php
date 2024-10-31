<?php
if ( ! defined('ABSPATH')) exit;  // if direct access 

add_action('wp_ajax_music_press_member_upload_cover_img', function(){

		check_ajax_referer('upload_cover_img');
		
		// you can use WP's wp_handle_upload() function:
		$file = $_FILES['async-upload'];
		
		$status = wp_handle_upload($file, array('action' => 'music_press_member_upload_cover_img'));

		$file_loc = $status['file'];
		$file_name = basename($status['name']);
		$file_type = wp_check_filetype($file_name);
	
		$attachment = array(
			'post_mime_type' => $status['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($file['name'])),
			'post_content' => '',
			'post_status' => 'inherit'
		);
	
		$attach_id = wp_insert_attachment($attachment, $file_loc);
		$attach_data = wp_generate_attachment_metadata($attach_id, $file_loc);
		wp_update_attachment_metadata($attach_id, $attach_data);
		//echo $attach_id;
	
	
		$user_id = get_current_user_id();
		
		update_user_meta( $user_id, 'music_press_member_cover', $attach_id );
		//$attach_title = get_the_title($attach_id);
	
		$html['attach_url'] = wp_get_attachment_url($attach_id);
		$html['attach_id'] = $attach_id;
		$html['attach_title'] = get_the_title($attach_id);	
	
		$response = array(
			'status'=>'ok',
			'html'=>$html,
			);
	
		echo json_encode($response);

  exit;
});

	


add_action('wp_ajax_music_press_member_upload_profile_img', function(){

		check_ajax_referer('upload_profile_img');
		
		// you can use WP's wp_handle_upload() function:
		$file = $_FILES['async-upload'];
		
		$status = wp_handle_upload($file, array('action' => 'music_press_member_upload_profile_img'));

		$file_loc = $status['file'];
		$file_name = basename($status['name']);
		$file_type = wp_check_filetype($file_name);
	
		$attachment = array(
			'post_mime_type' => $status['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($file['name'])),
			'post_content' => '',
			'post_status' => 'inherit'
		);
	
		$attach_id = wp_insert_attachment($attachment, $file_loc);
		$attach_data = wp_generate_attachment_metadata($attach_id, $file_loc);
		wp_update_attachment_metadata($attach_id, $attach_data);
		//echo $attach_id;
	
	
		$user_id = get_current_user_id();
		
		update_user_meta( $user_id, 'music_press_member_img', $attach_id );
		//$attach_title = get_the_title($attach_id);
	
		$html['attach_url'] = wp_get_attachment_url($attach_id);
		$html['attach_id'] = $attach_id;
		$html['attach_title'] = get_the_title($attach_id);
		$response = array(
			'status'=>'ok',
			'html'=>$html,
		);
	
		echo json_encode($response);

  exit;
});

function music_press_member_ajax_wishlist(){
    $song_id = sanitize_text_field($_POST['song_id']);
    $response 	= array();
    $gmt_offset = get_option('gmt_offset');
    $datetime = date('Y-m-d h:i:s', strtotime('+'.$gmt_offset.' hour'));

    if(is_user_logged_in()):

        $logged_user_id = get_current_user_id();

//		if($logged_user_id==$artist_id):
//			$response['mpresults_html'] = __("You can not follow yourself.", 'music-press-member');

//		else:

        global $wpdb;
        $table = $wpdb->prefix . "music_press_member_wishlist";
        $follow_result = $wpdb->get_results("SELECT * FROM $table WHERE song_id = '$song_id' AND member_id = '$logged_user_id'", ARRAY_A);

        $already_insert = $wpdb->num_rows;
        if($already_insert > 0 ):
            $response['mpresults_html'] = 'added ';
            $response['member_id'] = $logged_user_id;
        else:
            $wpdb->query( $wpdb->prepare("INSERT INTO $table 
												( id, member_id, song_id, datetime)
										VALUES	( %d, %d, %d, %s)",
                array	( '', $logged_user_id, $song_id,  $datetime )
            ));
            $response['mpresults_html'] = 'add ';
            $response['action'] = 'in_wishlist';
            $response['member_id'] = $logged_user_id;
        endif;
    else:
        $response['mpresults_html'] = __('Please login first.', 'music-press-member');

    endif;
    echo json_encode($response);
    die();
}

add_action('wp_ajax_music_press_member_ajax_wishlist', 'music_press_member_ajax_wishlist');

function music_press_member_ajax_follow(){

	$artist_id = sanitize_text_field($_POST['artist_id']);
	$response 	= array();
	$user_info = get_userdata( $artist_id );
	$gmt_offset = get_option('gmt_offset');
	$datetime = date('Y-m-d h:i:s', strtotime('+'.$gmt_offset.' hour'));
	
	if(is_user_logged_in()):
		
		$logged_user_id = get_current_user_id();
		
		$total_follower = (int)get_the_author_meta( 'total_follower', $artist_id );
		$total_following = (int)get_the_author_meta( 'total_following', $logged_user_id );
		
//		if($logged_user_id==$artist_id):
//			$response['mpresults_html'] = __("You can not follow yourself.", 'music-press-member');

//		else:
		
			global $wpdb;
			$table = $wpdb->prefix . "music_press_member_follow";
			$follow_result = $wpdb->get_results("SELECT * FROM $table WHERE artist_id = '$artist_id' AND follower_id = '$logged_user_id'", ARRAY_A);
			
			$already_insert = $wpdb->num_rows;
			if($already_insert > 0 ):
						
					$wpdb->delete( $table, array( 'artist_id' => $artist_id, 'follower_id' => $logged_user_id), array( '%d','%d' ) );
					//$wpdb->query("UPDATE $table SET followed = '$followed' WHERE author_id = '$authorid' AND follower_id = '$follower_id'");
	
					$response['mpresults_html'] = 'You are not following <strong>'. $user_info->display_name.'</strong>';
					$response['action'] = 'unfollow';
					$response['follower_id'] = $logged_user_id;
					
					$total_follower -=1; 
					
					if($total_follower<0){$total_follower = 0; }
					update_user_meta( $artist_id, 'total_follower', $total_follower );
	
					$total_following -=1; 
					
					if($total_following<0){$total_following = 0; }
					update_user_meta( $logged_user_id, 'total_following', $total_following );	
	
	
			else:
				
					$wpdb->query( $wpdb->prepare("INSERT INTO $table 
												( id, artist_id, follower_id, datetime)
										VALUES	( %d, %d, %d, %s)",
										array	( '', $artist_id, $logged_user_id,  $datetime )
												));
												
					$response['mpresults_html'] = 'Thanks for following <strong>'.$user_info->display_name.'</strong>';
					$response['action'] = 'following';
					$response['follower_id'] = $logged_user_id;
					//$html['html'] = '<div class="follower follower-'.$logged_user_id.'">'.get_avatar( $logged_user_id, 32 ).'</div>';
	
					$total_follower +=1; 
					update_user_meta( $artist_id, 'total_follower', $total_follower );
	
					$total_following +=1; 
					update_user_meta( $logged_user_id, 'total_following', $total_following );	
	
	
			endif;
			
//		endif;
		
	else:
			$response['mpresults_html'] = __('Please login first.', 'music-press-member');
		
	endif;
	

	
	echo json_encode($response);
	die();
}

add_action('wp_ajax_music_press_member_ajax_follow', 'music_press_member_ajax_follow');
//add_action('wp_ajax_nopriv_music_press_member_ajax_follow', 'music_press_member_ajax_follow');