<?php

if ( ! defined('ABSPATH')) exit;  // if direct access 

/* Profile Header */

add_action('music_press_member_action_music_press_member_main','music_press_member_action_music_press_member_main_header');
add_action('music_press_member_action_profile_header','music_press_member_action_music_press_member_main_header_cover');
add_action('music_press_member_action_profile_header','music_press_member_action_music_press_member_main_header_thumb');
add_action('music_press_member_action_profile_header','music_press_member_action_music_press_member_main_header_name');

add_action('music_press_member_action_music_press_member_main','music_press_member_action_music_press_member_main_header_navs');

add_action('music_press_member_action_music_press_member_main','music_press_member_action_music_press_member_main_header_navs_content');

add_action('music_press_member_action_music_press_member_main','music_press_member_action_music_press_member_main_footer');
add_action('music_press_member_action_music_press_member_main','music_press_member_action_music_press_member_main_mpresults');

function music_press_member_action_music_press_member_main_header(){

    mp_member_get_template(  'mp-member/header.php');
	
	}

function music_press_member_action_music_press_member_main_header_cover(){

    mp_member_get_template(  'mp-member/header-cover.php');
	
	}

function music_press_member_action_music_press_member_main_header_thumb(){

    mp_member_get_template(  'mp-member/header-thumb.php');
	
	}
	
function music_press_member_action_music_press_member_main_header_name(){

    mp_member_get_template(  'mp-member/header-name.php');
	
	}	
	
//function music_press_member_action_music_press_member_main_header_follow_button(){
//
//	require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/mp-member/header-follow-button.php');
//
//	}

function music_press_member_action_music_press_member_main_header_navs(){

    mp_member_get_template(  'mp-member/header-navs.php');
	
	}


function music_press_member_action_music_press_member_main_header_navs_content(){

    mp_member_get_template(  'mp-member/navs-content.php');
	
	}



function music_press_member_action_music_press_member_main_footer(){

    mp_member_get_template(  'mp-member/footer.php');
	
	}


function music_press_member_action_music_press_member_main_mpresults(){

    mp_member_get_template(  'mp-member/mpresults.php');
	
	}
