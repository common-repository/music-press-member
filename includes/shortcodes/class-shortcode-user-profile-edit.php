<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_music_press_member_music_press_member_edit{
	
    public function __construct(){
		add_shortcode( 'music_press_member_edit', array( $this, 'music_press_member_edit_display' ) );
   	}	
	
	public function music_press_member_edit_display($atts, $content = null ) {
			
		$atts = shortcode_atts( array(
					
		), $atts);

		ob_start();
        mp_member_get_template(  'user-profile-edit/user-profile-edit.php');
		return ob_get_clean();
	}
	
} 

new class_music_press_member_music_press_member_edit();