<?php

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


if(isset($_POST['music_press_member_basic_info_hidden'])){
	
	
	$nonce = $_POST['_wpnonce'];
	if(wp_verify_nonce( $nonce, 'nonce_music_press_member_basic_info' )){
		
		$music_press_member_basic_info = stripslashes_deep($_POST['music_press_member_basic_info']);
		
		//var_dump($music_press_member_basic_info);
		$first_name= $music_press_member_basic_info['first_name'];
		$last_name= $music_press_member_basic_info['last_name'];
	
		update_user_meta( $user_id, 'music_press_member_basic_info', $music_press_member_basic_info );
		
		wp_update_user( array( 'ID' => $user_id, 'display_name' => $first_name.' '.$last_name ) );
		
		$status_html.= '<span class="success"><i class="fa fa-check"></i> '.__('Saved successful.', 'music-press-member').'</span>';
		}
	
	
	}

else{
	$music_press_member_basic_info = get_the_author_meta( 'music_press_member_basic_info', $user_id );
			
	
	}

	

		if(!empty($music_press_member_basic_info['first_name'])){
			$first_name= $music_press_member_basic_info['first_name'];
			}
		else{
			$first_name = '';
			}		
		
		if(!empty($music_press_member_basic_info['last_name'])){
			$last_name= $music_press_member_basic_info['last_name'];
			}
		else{
			$last_name = '';
			}		
		
		if(!empty($music_press_member_basic_info['birth_date'])){
			$birth_date= $music_press_member_basic_info['birth_date'];
			}
		else{
			$birth_date = '';
			}
		
		
		if(!empty($music_press_member_basic_info['religious'])){
			$religious= $music_press_member_basic_info['religious'];
			}
		else{
			$religious= '';
			}
		
		if(!empty( $music_press_member_basic_info['gender'])){
			$gender= $music_press_member_basic_info['gender'];
			}
		else{
			$gender= '';
			}
		
		if(!empty( $music_press_member_basic_info['relationship'])){
			$relationship= $music_press_member_basic_info['relationship'];
			}
		else{
			$relationship= '';
			}
		
		if(!empty( $music_press_member_basic_info['website'])){
			$website= $music_press_member_basic_info['website'];
			}
		else{
			$website= '';
			}
        if(!empty( $music_press_member_basic_info['introduce'])){
            $introduce= $music_press_member_basic_info['introduce'];
        }
        else{
            $introduce= '';
        }
		$class_music_press_member_functions = new class_music_press_member_functions();
		$user_relationship = $class_music_press_member_functions->user_relationship();
		$user_gender = $class_music_press_member_functions->user_gender();
?>





<div class="section basic-info">
	<h2><?php echo __('Basic Info', 'music-press-member'); ?></h2>
        <div class="status">
        <?php echo $status_html; ?>
        </div>

   		<form id="music-press-member-basic-info" class="" action="#music-press-member-basic-info" method="post">
        
        	<input name="music_press_member_basic_info_hidden" type="hidden" value="Y" />
   
			<p>
            <label>
            <?php echo __('First name', 'music-press-member'); ?>
            </label>
            <input class="" placeholder="Jhon" type="text" name="music_press_member_basic_info[first_name]" value="<?php echo $first_name; ?>" />
            
            <label>
            <?php echo __('Last name', 'music-press-member'); ?>
            </label>
            <input class="" placeholder="Doe" type="text" name="music_press_member_basic_info[last_name]" value="<?php echo $last_name; ?>" />

            </p>                 
                

			<p>
            <label>
            <?php echo __('Birth date', 'music-press-member'); ?>
            </label>
            <input class="music_press_member_date" placeholder="2017-02-09" type="text" name="music_press_member_basic_info[birth_date]" value="<?php echo $birth_date; ?>" />
            </p> 

			<p>
            <label>
            <?php echo __('Relationsship', 'music-press-member'); ?>
            </label>
            
            <select name="music_press_member_basic_info[relationship]">
            
            <?php
            foreach($user_relationship as $index=>$relation){
				
				$title = $relation['title'];
				
				?>
                <option <?php if($relationship == $index) echo 'selected'; ?>  value="<?php echo $index; ?>" ><?php echo $title; ?></option>
                <?php
				
				}
			
			?>
            </select>

            </p> 


			<p>
            <label>
            <?php echo __('Gender', 'music-press-member'); ?>
            </label>
            
            <select name="music_press_member_basic_info[gender]">
                
            <?php
            foreach($user_gender as $index=>$gend){
				
				$title = $gend['title'];
				
				
				?>
                <option <?php if($gender == $index) echo 'selected'; ?>  value="<?php echo $index; ?>" ><?php echo $title; ?></option>
                <?php
				
				}
			
			?>
                                
            </select>

            </p>
			<p>
            <label>
             <?php echo __('Religious', 'music-press-member'); ?>
            </label>
            <input placeholder="Religious" type="text" name="music_press_member_basic_info[religious]" value="<?php echo $religious; ?>" />
            </p>  
            
			<p>
            <label>
             <?php echo __('Website', 'music-press-member'); ?>
            </label>
            <input placeholder="http://mydomain.com" type="text" name="music_press_member_basic_info[website]" value="<?php echo $website; ?>" />
            </p>

			<p>
            <label>
             <?php echo __('Introduce', 'music-press-member'); ?>
            </label>
                <textarea type="textarea" name="music_press_member_basic_info[introduce]"><?php echo $introduce; ?></textarea>
            </p>
        <?php wp_nonce_field( 'nonce_music_press_member_basic_info' ); ?>
        <input type="submit" value="<?php echo __('Update', 'music-press-member'); ?>" />
        
        </form>
   
</div>