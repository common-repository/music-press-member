<?php
if ( ! defined('ABSPATH')) exit;  // if direct access 


$class_music_press_member_functions = new class_music_press_member_functions();

$profile_navs = $class_music_press_member_functions->profile_navs();

if(isset($_GET['nav'])){
	
	$nav = $_GET['nav'];
	
	}
else{$nav='about';}

if(isset($_GET['id'])){
	
	$user_id = sanitize_text_field($_GET['id']);
	//var_dump($user_id);
	}
else{
	if(is_author()){
		$user_id =get_the_author_meta( 'ID' );
		}
	else{
		$user_id = get_current_user_id();
		}
	}
$music_press_member_page_id = get_option('music_press_member_page_id');
$music_press_member_page_url = get_permalink($music_press_member_page_id);

?>
<div class="profile-header-navs">
    <?php do_action('music_press_member_action_before_profile_navs'); ?>
    <?php
	foreach($profile_navs as $nav_key=>$navs){
		//if(empty($nav))
		$title = $navs['title'];
		?><a class="<?php if($nav==$nav_key) echo 'active';?>" href="<?php echo $music_press_member_page_url.'?id='.$user_id.'&nav='.$nav_key;?>"><?php echo $title; ?></a><?php
		}
	?>   
	<?php do_action('music_press_member_action_after_profile_navs', $user_id); ?>
</div>
