<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



class class_music_press_member_addons{
	
	
    public function __construct(){
		
    }
	
	

	public function addons_data($addons_data = array()){
		
		$addons_data_new = array(

			'online-users'=>array(	'title'=>'Online users',
			                          'version'=>'1.0.0',
			                          'price'=>'0',
			                          'content'=>'',
			                          'item_link'=>'https://wordpress.org/plugins/user-profile-online-users/',
			                          'thumb'=>MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/admin/images/addons/online-users.png',
			),

			'verified-users'=>array(	'title'=>'Verified users',
										'version'=>'1.0.0',
										'price'=>'19',
										'content'=>'',										
										'item_link'=>'https://www.pickplugins.com/item/user-profile-verified-users/',
										'thumb'=>MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/admin/images/addons/verified-users.png',
			),	


			'user-directory'=>array(	'title'=>'User directory',
										'version'=>'1.0.0',
										'price'=>'19',
										'content'=>'',										
										'item_link'=>'https://www.pickplugins.com/item/user-profile-user-directory/',
										'thumb'=>MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/admin/images/addons/user-directory.png',
			),






			/*
			 *
						 'message'=>array(	'title'=>'Message',
													'version'=>'1.0.0',
													'price'=>'0',
													'content'=>'',
													'item_link'=>'#',
													'thumb'=>MUSIC_PRESS_MEMBER_PLUGIN_URL.'assets/admin/images/addons/message.png',
						),
			 * */




		);
		
		$addons_data = array_merge($addons_data_new,$addons_data);
		
		$addons_data = apply_filters('music_press_member_filters_addons_data', $addons_data);
		
		return $addons_data;
		
		
		}



	public function qa_addons_html(){
		
		$html = '';
		
		$addons_data = $this->addons_data();
		
		foreach($addons_data as $key=>$values){
			
			$html.= '<div class="single '.$key.'">';
			$html.= '<div class="thumb"><a href="'.$values['item_link'].'"><img src="'.$values['thumb'].'" /></a></div>';			
			$html.= '<div class="title"><a href="'.$values['item_link'].'">'.$values['title'].'</a></div>';
			$html.= '<div class="content">'.$values['content'].'</div>';						
			$html.= '<div class="meta version"><b>'.__('Version:', 'music-press-member').'</b> '.$values['version'].'</div>';
			
			if($values['price']==0){
				
				$price = __('Free', 'music-press-member');
				}
			else{
				$price = '$'.$values['price'];
				
				}		
			$html.= '<div class="meta price"><b>'.__('Price:', 'music-press-member').'</b> '.$price.'</div>';
			$html.= '<div class="meta download"><a href="'.$values['item_link'].'">'.__('Download', 'music-press-member').'</a></div>';
			
			
			
			$html.= '</div>';
			
		
			
			}
		
		$html.= '';		
		
		return $html;
		}







}

new class_music_press_member_addons();




	
	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".sprintf(__('%s - Addons', 'music-press-member'), MUSIC_PRESS_MEMBER_PLUGIN_NAME)."</h2>";?>

		<div class="user-profile-addons">
        
			<?php
            
            $class_music_press_member_addons = new class_music_press_member_addons();
            
            echo $class_music_press_member_addons->qa_addons_html();
            
            
            ?>
        
        
        </div>

</div>
