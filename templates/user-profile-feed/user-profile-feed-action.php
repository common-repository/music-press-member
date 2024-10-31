<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

/* Profile Header */

add_action('music_press_member_action_user_feed_main','music_press_member_action_user_feed_main');



function music_press_member_action_user_feed_main(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile-feed/feed-items.php');
	
	}

