<?php
if ( ! defined('ABSPATH')) exit;  // if direct access
?>
<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".sprintf(__('%s Help', 'music-press-member'), MUSIC_PRESS_MEMBER_PLUGIN_NAME)."</h2>";?>
		
	<div class="para-settings qa-admin-help">
    
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active"><i class="fa fa-hand-o-right"></i> <?php _e('Help & Support', 'music-press-member'); ?></li>

        </ul> <!-- tab-nav end -->      
    
		<ul class="box">
        
            <li style="display: block;" class="box1 tab-box active">
            
				<div class="option-box">
                    <p class="option-info">
                    </p>
                    <h3><?php echo esc_html_e('Default page','music-press-member');?></h3>
                    <p>
                        <?php echo esc_html_e('Plugin activated will auto create "Profile page" and "Edit profile" ','music-press-member');?>
                    </p>
                     <h3><?php echo esc_html_e('Use Shortcode','music-press-member');?></h3>
                    <p>
                    <?php echo esc_html_e('Profile page shortcode: ','music-press-member');?><strong>[music_press_member_profile]</strong>
                    </p>
                    <p>
                    <?php echo esc_html_e('Edit Profile shortcode: ','music-press-member');?><strong>[music_press_member_edit]</strong>
                    </p>
                    <p>
                    <?php echo esc_html_e('You can copy this shortcode and paste in any page you want to show profile member.','music-press-member');?>
                    </p>
                    <h3><?php echo esc_html_e('Get Support','music-press-member');?></h3>
                    <p>
                        <?php echo esc_html_e('If you want to support you can get our support from ','music-press-member');?>
                        <a href="https://wpmusicpress.com/" target="_blank">wpmusicpress.com</a>
                    </p>
                    
                </div>
            </li>
            
       </ul>
    
    </div>

</div>
