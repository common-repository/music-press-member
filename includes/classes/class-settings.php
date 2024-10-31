<?php

if ( ! defined('ABSPATH')) exit;  // if direct access 


class class_qa_settings  {
	
	public function __construct(){

		add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
    }
	
	public function admin_menu() {
        add_menu_page(
            'Music  Member',
            'Music  Member',
            'manage_options',
            'music-press-member',
            array( $this, 'settings' ), // Callback, leave empty
            MUSIC_PRESS_PRO_PLUGIN_URL . '/assets/images/music-press.png',
            11 // Position
        );

		//add_dashboard_page( '', '', 'manage_options', 'qa-setup', '' );
		add_submenu_page( 'music-press-member', __( 'Help', 'music-press-member' ), __( 'Help', 'music-press-member' ), 'manage_options', 'help', array( $this, 'help' ) );
		
		
		do_action( 'qa_action_admin_menus' );
		
	}
	
	public function settings(){
		include( MUSIC_PRESS_MEMBER_PLUGIN_DIR. 'includes/admin/settings.php' );
	}	

	
	public function help(){
		include( MUSIC_PRESS_MEMBER_PLUGIN_DIR. 'includes/admin/help.php' );
	}
	
} new class_qa_settings();

