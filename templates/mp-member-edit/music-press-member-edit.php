<?php

if ( ! defined('ABSPATH')) exit;  // if direct access 


if(isset($_GET['id'])){
	
	$user_id = sanitize_text_field($_GET['id']);
	//var_dump($user_id);
	}
else{
	
	$user_id = get_current_user_id(); 
	}


?>


<div class="music-press-member-edit">

<?php

if(is_user_logged_in()):

	do_action('music_press_member_action_music_press_member_edit_main');

else:

	do_action('music_press_member_action_music_press_member_edit_loggout');

endif;
?>
    
</div>