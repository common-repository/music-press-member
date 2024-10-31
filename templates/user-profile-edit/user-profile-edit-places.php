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

if(isset($_POST['music_press_member_places_hidden'])){
	
	
	
	$nonce = $_POST['_wpnonce'];
	if(wp_verify_nonce( $nonce, 'nonce_music_press_member_places' )){
		
		$music_press_member_places = stripslashes_deep($_POST['music_press_member_places']);
		update_user_meta( $user_id, 'music_press_member_places', $music_press_member_places );
		
		$status_html.= '<span class="success"><i class="fa fa-check"></i> '.__('Saved successful.', 'music-press-member').'</span>';
		}
		
	}
else{
	$music_press_member_places = get_the_author_meta( 'music_press_member_places', $user_id );
	
	}


?>





<div class="section places">
   <h2><?php echo __('Places', 'music-press-member'); ?></h2>
   
	<div class="status">
	<?php echo $status_html; ?>
    </div>
   
   		<form id="user-profile-places" class="" action="#user-profile-places" method="post">
        
        	<input name="music_press_member_places_hidden" type="hidden" value="Y" />
        
   		<div class="add-places button"><?php echo __('Add', 'music-press-member'); ?></div>
   		<div class="places-list sortable">
        
        
       <?php
        if(!empty($music_press_member_places)):
		foreach($music_press_member_places as $index=>$work){
			
			$location = $work['location'];
			$address = $work['address'];			
		
						
			
			?>
            <div class="item">
                <span class="remove user-profile-tooltip" title="<?php echo __('Delete', 'music-press-member'); ?>"><i class="fa fa-times"></i></span>
                <span class="move user-profile-tooltip" title="<?php echo __('Sort', 'music-press-member'); ?>"><i class="fa fa-bars" aria-hidden="true"></i></span>
                <input placeholder="<?php echo __('Location', 'music-press-member'); ?>" type="text" name="music_press_member_places[<?php echo $index; ?>][location]" value="<?php echo $location; ?>" />
                <input placeholder="<?php echo __('Address', 'music-press-member'); ?>" type="text" name="music_press_member_places[<?php echo $index; ?>][address]" value="<?php echo $address; ?>" />

                
            </div>
            
            
            <?php

			}
		else:
		
		?>
            <div class="item"><?php echo __('Please add places here.', 'music-press-member'); ?></div>
        <?php
		
		
		
		endif;
		?> 
        
        
        
        
        
        
            
            
            
                    
        
        
        </div>
        
        
        <?php wp_nonce_field( 'nonce_music_press_member_places' ); ?>
        <input type="submit" value="<?php echo __('Update', 'music-press-member'); ?>" />
        
        </form>
        
 <script>
    jQuery(document).ready(function($){
        $(function() {
            $( ".sortable" ).sortable({ handle: '.move' });
        //$( ".items-container" ).disableSelection();
        });


    $(document).on('click', '.add-places', function(){

        now = $.now();


        html = '<div class="item"><span class="remove"><i class="fa fa-times"></i></span> <span class="move"><i class="fa fa-bars" aria-hidden="true"></i></span> <input placeholder="Location" type="text" name="music_press_member_places['+now+'][location]" value="" /> <input placeholder="Address" type="text" name="music_press_member_places['+now+'][address]" value="" /> </div>';

        $('.places-list').append(html);

        })
    });
</script>
   
   
</div>