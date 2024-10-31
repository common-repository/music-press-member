<?php

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_music_press_member_user_profile{
	
    public function __construct(){
		add_shortcode( 'music_press_member_profile', array( $this, 'music_press_member_display' ) );
   	}	
	
	public function music_press_member_display($atts, $content = null ) {
			
		$atts = shortcode_atts( array(
					
		), $atts);

		ob_start();
        mp_member_get_template(  'mp-member/member-profile.php');
		return ob_get_clean();
	}
}
new class_music_press_member_user_profile();