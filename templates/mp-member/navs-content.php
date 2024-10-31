<?php
if ( ! defined('ABSPATH')) exit;  // if direct access 


$class_music_press_member_functions = new class_music_press_member_functions();

$profile_navs = $class_music_press_member_functions->profile_navs();


if(isset($_GET['nav'])){
	
	$nav = $_GET['nav'];
	
	}
else{$nav='about';}
?>
<div class="navs-content">
	<?php do_action('music_press_member_action_before_profile_content'); ?>
    <?php
	foreach($profile_navs as $nav_key=>$navs){
		$html = $navs['html'];
		?>
        <div class="nav-content <?php echo $nav_key; ?> <?php if($nav==$nav_key) echo 'active';?>">
        <?php
		echo $html;
		?>
        </div>
        <?php
		}

	?>   
	<?php do_action('music_press_member_action_after_profile_content'); ?>
</div>
