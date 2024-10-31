<?php
/*
Plugin Name: Music Press Member
Plugin URI: https://wpmusicpress.com/
Description: Member Profile for music press pro
Version: 1.0
Text Domain: music-press-member
Author: tuyennv
Author URI: https://wpmusicpress.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class MusicPressMember{
	
	public function __construct(){
	
		$this->music_press_member_define_constants();
        include('includes/music-press-member-core-functions.php');
		$this->music_press_member_declare_classes();
		$this->music_press_member_declare_shortcodes();
		$this->music_press_member_declare_actions();
		
		$this->music_press_member_loading_script();
		//$this->music_press_member_loading_plugin();
		//$this->music_press_member_loading_widgets();
		$this->music_press_member_loading_functions();
		
		register_activation_hook( __FILE__, array( $this, 'music_press_member_activation' ) );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ));


	}
    static function music_press_member_template_path()
    {
        return apply_filters('music_press_member_template_path', 'music-press-member/');

    }
    public function music_press_member_plugin_path() {
        return untrailingslashit( plugin_dir_path( MUSIC_PRESS_MEMBER_FILE ) );
    }
	
	public function music_press_member_activation() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		$table = $wpdb->prefix .'music_press_member_follow';
		$table_playlist = $wpdb->prefix .'music_press_member_playlist';
		$table_wishlist = $wpdb->prefix .'music_press_member_wishlist';

		$sql = "CREATE TABLE IF NOT EXISTS ".$table ." (
			id int(100) NOT NULL AUTO_INCREMENT,
			artist_id int(100) NOT NULL,
			follower_id int(100) NOT NULL,
			datetime datetime NOT NULL,
				
			UNIQUE KEY id (id)
		) $charset_collate;";
        $sql2 = "CREATE TABLE IF NOT EXISTS ".$table_playlist ." (
                    id int(100) NOT NULL AUTO_INCREMENT,
                    song_id int(100) NOT NULL,
                    member_id int(100) NOT NULL,
                    playlist_type varchar(255) NOT NULL,
                    datetime datetime NOT NULL,
                        
                    UNIQUE KEY id (id)
                ) $charset_collate;";
        $sql2 = "CREATE TABLE IF NOT EXISTS ".$table_wishlist ." (
                    id int(100) NOT NULL AUTO_INCREMENT,
                    member_id int(100) NOT NULL,
                    song_id int(100) NOT NULL,
                    album_id int(100) NOT NULL,
                    datetime datetime NOT NULL,
                        
                    UNIQUE KEY id (id)
                ) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		dbDelta( $sql2 );

        if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'edit-profile'", 'ARRAY_A' ) ) {

            $current_user = wp_get_current_user();

            // create post object

            $page = array(

                'post_title'  => __( 'Edit Profile' ),

                'post_content'  => '[music_press_member_profile]',

                'post_status' => 'publish',

                'post_author' => $current_user->ID,

                'post_type'   => 'page',

            );

            // insert the post into the database

            wp_insert_post( $page );

        }

        if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'profile-page'", 'ARRAY_A' ) ) {

            $current_user = wp_get_current_user();

            // create post object

            $page = array(

                'post_title'  => __( 'Profile page' ),

                'post_content'  => '[music_press_member_edit]',

                'post_status' => 'publish',

                'post_author' => $current_user->ID,

                'post_type'   => 'page',

            );

            // insert the post into the database

            wp_insert_post( $page );

        }

	}

	public function load_textdomain() {
		
		load_plugin_textdomain( 'music-press-member', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
	}
	
	public function music_press_member_loading_widgets() {

		add_action( 'widgets_init', array( $this, 'music_press_member_widget_register' ) );
	}
	
	public function music_press_member_widget_register() {

	}
	
	public function music_press_member_loading_functions() {
		
		require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'includes/functions.php');
	}
	
	public function music_press_member_loading_plugin() {
		
		
		
	}
	
	public function music_press_member_loading_script() {
	
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
		add_action( 'wp_enqueue_scripts', array( $this, 'music_press_member_front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'music_press_member_admin_scripts' ) );
	}

	
	public function music_press_member_declare_actions() {


		require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/mp-member/music-press-member-action.php');
		require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'templates/mp-member-edit/music-press-member-edit-action.php');

		
	}
	
	public function music_press_member_declare_shortcodes() {

		require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'includes/shortcodes/class-shortcode-member-profile.php');
		require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'includes/shortcodes/class-shortcode-member-profile-edit.php');

	}
	
	public function music_press_member_declare_classes() {

		require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'includes/classes/class-functions.php');
		require_once( MUSIC_PRESS_MEMBER_PLUGIN_DIR . 'includes/classes/class-settings.php');

	}
	
	public function music_press_member_define_constants() {
        if ( ! defined( 'MUSIC_PRESS_MEMBER_FILE' ) ) {
            define( 'MUSIC_PRESS_MEMBER_FILE', __FILE__ );
        }

		$this->define('MUSIC_PRESS_MEMBER_PLUGIN_URL', plugins_url('/', __FILE__)  );
		$this->define('MUSIC_PRESS_MEMBER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		$this->define('MUSIC_PRESS_MEMBER_PLUGIN_NAME', __('Music Press Member', 'music-press-member') );
		$this->define('MUSIC_PRESS_MEMBER_PLUGIN_SUPPORT', 'https://wpmusicpress.com/'  );
		
	}
	
	private function define( $name, $value ) {
		if( $name && $value )
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
	public function music_press_member_front_scripts(){
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script( 'jquery-ui-core' );
		
			
		wp_enqueue_script('music_press_member_front_js', plugins_url( '/assets/front/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script('music_press_member_front_js', 'music_press_member_ajax', array( 'music_press_member_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		wp_enqueue_style('music_press_member_style', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/front/css/user-profile.css');
//		wp_enqueue_style('music_press_member_edit_style', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/front/css/music-press-member-edit.css');

		wp_enqueue_style('tooltipster.bundle.min', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/front/css/tooltipster.bundle.min.css');
		
		wp_enqueue_script('tooltipster.bundle.min', plugins_url( '/assets/front/js/tooltipster.bundle.min.js' , __FILE__ ) , array( 'jquery' ));		
		//global
		wp_enqueue_style('font-awesome', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/global/css/font-awesome.css');
		wp_enqueue_style('jquery-ui', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/global/css/jquery-ui.css');
		
		wp_enqueue_script('plupload-all');
		
		//wp_enqueue_style('music_press_member_global_style', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/global/css/style.css');

		
		// ParaAdmin
		//wp_enqueue_script('music_press_member_ParaAdmin', plugins_url( '/assets/global/ParaAdmin/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		//wp_enqueue_style('music_press_member_paraAdmin', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/global/ParaAdmin/ParaAdmin.css');
		
		//wp_enqueue_script('plupload-all');	
		//wp_enqueue_script('plupload_js', plugins_url( '/assets/global/js/scripts-plupload.js' , __FILE__ ) , array( 'jquery' ));
		
		//
	}

	public function music_press_member_admin_scripts(){
		
		wp_enqueue_script('jquery');
		
		//wp_enqueue_script('music_press_member_admin_js', plugins_url( '/assets/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		//wp_localize_script( 'music_press_member_admin_js', 'music_press_member_ajax', array( 'music_press_member_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		//wp_enqueue_style('music_press_member_admin_style', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/admin/css/style.css');
			
		
		wp_enqueue_script('music_press_member_ParaAdmin', plugins_url( '/assets/admin/ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_style('music_press_member_paraAdmin', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/admin/ParaAdmin/css/ParaAdmin.css');
		
		//global
		wp_enqueue_style('font-awesome', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/global/css/font-awesome.css');
		wp_enqueue_style('addons', MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/admin/css/addons.css');
		
		//wp_enqueue_style( 'wp-color-picker' );
		//wp_enqueue_script( 'music_press_member_color_picker', plugins_url('/assets/admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	}
	
	
}
$GLOBALS['music_press_member'] = new MusicPressMember();