<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



	if(is_user_logged_in()){
		
		$logged_user_id = get_current_user_id(); 
		$user_id = get_current_user_id();
		//var_dump($logged_user_id);
		}
	else{
		return;
		}
	
		
$status_html = '';
	
	
    if(isset($_POST['music_press_member_contacts_hidden'])){
		
		$nonce = $_POST['_wpnonce'];
		if(wp_verify_nonce( $nonce, 'nonce_music_press_member_contacts' )){
			
			$music_press_member_contacts = stripslashes_deep($_POST['music_press_member_contacts']);
			
			//var_dump($music_press_member_contacts);
			
			update_user_meta( $user_id, 'music_press_member_contacts', $music_press_member_contacts );
			
			
			$status_html.= '<span class="success"><i class="fa fa-check"></i> '.__('Saved successful.', 'music-press-member').'</span>';
			
			}
        

        
        }
    else{
        $music_press_member_contacts = get_the_author_meta( 'music_press_member_contacts', $user_id );
        
        }
    
	
	$class_music_press_member_functions = new class_music_press_member_functions();
	$contact_methods = $class_music_press_member_functions->contact_methods();
	
	
	
	
    ?>




<div class="section contacts">
   <h2><?php echo __('Contacts', 'music-press-member'); ?></h2>
   
	<div class="status">
	<?php echo $status_html; ?>
    </div>







   
   		<form id="user-profile-contacts" class="" action="#user-profile-contacts" method="post">
        
        	<input name="music_press_member_contacts_hidden" type="hidden" value="Y" />
        
   		<div class="add-contacts button"><?php echo __('Add', 'music-press-member'); ?></div>
   		<div class="contacts-list sortable">
        
        
       <?php
        if(!empty($music_press_member_contacts)):
		foreach($music_press_member_contacts as $index=>$work){
			
			$username = $work['username'];
			$profile_link = $work['profile_link'];			
			$network = $work['network'];			
						
			
			?>
            <div class="item">
                <span class="remove user-profile-tooltip" title="<?php echo __('Delete', 'music-press-member'); ?>"><i class="fa fa-times"></i></span>
                <span class="move user-profile-tooltip" title="<?php echo __('Sort', 'music-press-member'); ?>"><i class="fa fa-bars" aria-hidden="true"></i></span>
                <input placeholder="<?php echo __('Location', 'music-press-member'); ?>" type="text" name="music_press_member_contacts[<?php echo $index; ?>][username]" value="<?php echo $username; ?>" />
                <input placeholder="<?php echo __('Address', 'music-press-member'); ?>" type="text" name="music_press_member_contacts[<?php echo $index; ?>][profile_link]" value="<?php echo $profile_link; ?>" />
				<select name="music_press_member_contacts[<?php echo $index; ?>][network]">
                 	
                    <?php
                    if(!empty($contact_methods)):
					foreach($contact_methods as $index=>$methods){
						
						$title = $methods['title'];
						
						?>
                        <option <?php if($network == $index) echo 'selected'; ?>  value="<?php echo $index; ?>"><?php echo $title;?></option>
                        <?php
						
						}
						
					endif;
					?>
                    
                                   
                   
                    
                </select>
                
            </div>
            
            
            <?php

			}
		else:
		
		?>
        <div class="item"><?php echo __('Please add contacts here.', 'music-press-member'); ?></div>
        <?php
		
		
		
		endif;
		?> 
        
        
        
        
        
        
            
            
            
                    
        
        
        </div>
        
        
        <?php wp_nonce_field( 'nonce_music_press_member_contacts' ); ?>
        <input type="submit" value="<?php echo __('Update', 'music-press-member'); ?>" />
        
        </form>
        
 <script>
jQuery(document).ready(function($){
	$(function() {
		$( ".sortable" ).sortable({ handle: '.move' });
	//$( ".items-container" ).disableSelection();
	});
	
	
$(document).on('click', '.add-contacts', function(){
	
	now = $.now();
	
	<?php 
	$network_option = '';
	foreach($contact_methods as $index=>$methods){
		
		$title = $methods['title'];
		
		$network_option.='<option value="'.$index.'">'.$title.'</option>';
		
	}
	
	?>
	
	html = '<div class="item"><span class="remove"><i class="fa fa-times"></i></span> <span class="move"><i class="fa fa-bars" aria-hidden="true"></i></span> <input placeholder="Username" type="text" name="music_press_member_contacts['+now+'][username]" value="" /> <input placeholder="Profile link" type="text" name="music_press_member_contacts['+now+'][profile_link]" value="" />				<select name="music_press_member_contacts['+now+'][network]"><?php echo $network_option; ?></select></div>';
	
	$('.contacts-list').append(html);
	
	})
	
	
	
	

});
</script>
   
   
</div>