<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

/* Profile Header */

add_action('music_press_member_action_music_press_member_main','music_press_member_action_music_press_member_main_header');
add_action('music_press_member_action_profile_header','music_press_member_action_music_press_member_main_header_cover');
add_action('music_press_member_action_profile_header','music_press_member_action_music_press_member_main_header_thumb');
add_action('music_press_member_action_profile_header','music_press_member_action_music_press_member_main_header_name');
//add_action('music_press_member_action_profile_header','music_press_member_action_music_press_member_main_header_follow_button');
//add_action('music_press_member_action_profile_header','music_press_member_action_music_press_member_main_header_message_button');



add_action('music_press_member_action_music_press_member_main','music_press_member_action_music_press_member_main_header_navs');




add_action('music_press_member_action_music_press_member_main','music_press_member_action_music_press_member_main_header_navs_content');

add_action('music_press_member_action_music_press_member_main','music_press_member_action_music_press_member_main_footer');
add_action('music_press_member_action_music_press_member_main','music_press_member_action_music_press_member_main_toast');

function music_press_member_action_music_press_member_main_header(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile/header.php');
	
	}

function music_press_member_action_music_press_member_main_header_cover(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile/header-cover.php');
	
	}

function music_press_member_action_music_press_member_main_header_thumb(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile/header-thumb.php');
	
	}
	
function music_press_member_action_music_press_member_main_header_name(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile/header-name.php');
	
	}	
	
//function music_press_member_action_music_press_member_main_header_follow_button(){
//
//	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile/header-follow-button.php');
//
//	}
	
	
function music_press_member_action_music_press_member_main_header_message_button(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile/header-message-button.php');
	
	}	
	

function music_press_member_action_music_press_member_main_header_navs(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile/header-navs.php');
	
	}


function music_press_member_action_music_press_member_main_header_navs_content(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile/navs-content.php');
	
	}



function music_press_member_action_music_press_member_main_footer(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile/footer.php');
	
	}


function music_press_member_action_music_press_member_main_toast(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile/toast.php');
	
	}
