<?php

if ( ! defined('ABSPATH')) exit;  // if direct access 

/* Profile Header */

add_action('music_press_member_action_music_press_member_edit_main','music_press_member_action_music_press_member_edit_main_basic_info');

add_action('music_press_member_action_music_press_member_edit_main','music_press_member_action_music_press_member_edit_main_contacts');
//add_action('music_press_member_action_music_press_member_edit_main','music_press_member_action_music_press_member_edit_main_work');
//add_action('music_press_member_action_music_press_member_edit_main','music_press_member_action_music_press_member_edit_main_education');
//add_action('music_press_member_action_music_press_member_edit_main','music_press_member_action_music_press_member_edit_main_places');

add_action('music_press_member_action_music_press_member_edit_loggout','music_press_member_action_music_press_member_edit_loggout');



function music_press_member_action_music_press_member_edit_main_basic_info(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/mp-member-edit/music-press-member-edit-basic-info.php');
	
	}


function music_press_member_action_music_press_member_edit_main_contacts(){
	
	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/mp-member-edit/music-press-member-edit-contacts.php');
	
	}

function music_press_member_action_music_press_member_edit_loggout(){

	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/mp-member-edit/music-press-member-edit-loggout.php');

}
	
	
	
