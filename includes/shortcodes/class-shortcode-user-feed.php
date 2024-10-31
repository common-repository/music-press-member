<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_music_press_member_user_feed{
	
    public function __construct(){
		add_shortcode( 'music_press_member_feed', array( $this, 'music_press_member_display' ) );
   	}	
	
	public function music_press_member_display($atts, $content = null ) {
			
		$atts = shortcode_atts( array(
					
		), $atts);

		ob_start();
		include( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/user-profile-feed/user-profile-feed.php');
		return ob_get_clean();
	}
	
} 

new class_music_press_member_user_feed();