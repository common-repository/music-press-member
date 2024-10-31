<?php
if ( ! defined('ABSPATH')) exit;  // if direct access 


if(is_user_logged_in()){
	
	$logged_user_id = get_current_user_id(); 
	
	//var_dump($logged_user_id);
	}


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

	$music_press_member_img_id = get_the_author_meta( 'music_press_member_img', $user_id );

	if(!empty($music_press_member_img_id)){
		
			$music_press_member_img =  wp_get_attachment_url($music_press_member_img_id);
			$user_avatar_src = $music_press_member_img;
		
		}
	else{
			$user_avatar_src = get_avatar_url($user_id, array('size'=>250));

		}

			//$user = get_user_by('ID', $user_id);	
			//$display_name = $user->display_name;	
	


	$user_avatar = '<img src="'.$user_avatar_src.'" />';
?>

    
    <div class="thumb">
    
		<?php
        
        if(get_current_user_id()==$user_id):
        
        ?>
		<div class="thumb-upload">
                
        <?php
        
            $field_id = 'profile_img';
        
        
            echo '<div id="plupload-drag-drop'.$field_id.'" ><span id="plupload-browse-'.$field_id.'" class="clipart-upload button tooltip" title="'.__('Upload profile image.', 'music-press-member').'"><i class="fa fa-upload"></i></span></div>';
        
        
          $plupload_init = array(
            'runtimes'            => 'html5,silverlight,flash,html4',
            'browse_button'       => 'plupload-browse-'.$field_id.'',
            //'multi_selection'	  =>false,
           // 'container'           => 'plupload-'.$field_id.'',
            'drop_element'        => 'plupload-drag-drop'.$field_id.'',
            'file_data_name'      => 'async-upload',
            'multiple_queues'     => true,
            'max_file_size'       => wp_max_upload_size().'b',
            'url'                 => admin_url('admin-ajax.php'),
            //'flash_swf_url'       => includes_url('js/plupload/plupload.flash.swf'),
            //'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
            'filters'             => array(array('title' => __('Allowed Files', 'music-press-member'), 'extensions' => 'gif,png,jpg,jpeg')),
            'multipart'           => true,
            'urlstream_upload'    => true,
        
            // additional post data to send to our ajax hook
            'multipart_params'    => array(
              '_ajax_nonce' => wp_create_nonce('upload_profile_img'),
              'action'      => 'music_press_member_upload_profile_img',            // the ajax action name
            ),
          );
        
          // we should probably not apply this filter, plugins may expect wp's media uploader...
          $plupload_init = apply_filters('plupload_init', $plupload_init);
          
          
          echo '
                    
                 <script>
                
                    jQuery(document).ready(function($){
                
                      // create the uploader and pass the config from above
                      var uploader_'.$field_id.' = new plupload.Uploader('.json_encode($plupload_init).');
                
                      // checks if browser supports drag and drop upload, makes some css adjustments if necessary
                      uploader_'.$field_id.'.bind("Init", function(up){
                        var uploaddiv = $("#plupload-'.$field_id.'");
                
                        if(up.features.dragdrop){
                          uploaddiv.addClass("drag-drop");
                            $("#plupload-drag-drop'.$field_id.'")
                              .bind("dragover.wp-uploader", function(){ uploaddiv.addClass("drag-over"); })
                              .bind("dragleave.wp-uploader, drop.wp-uploader", function(){ uploaddiv.removeClass("drag-over"); });
                
                        }else{
                          uploaddiv.removeClass("drag-drop");
                          $("#plupload-drag-drop'.$field_id.'").unbind(".wp-uploader");
                        }
                      });
                
                      uploader_'.$field_id.'.init();
                
                      // a file was added in the queue
                      uploader_'.$field_id.'.bind("FilesAdded", function(up, files){
						  
						$(".mpresults").html("'.__('Please wait.', 'music-press-member').'");
						$(".mpresults").stop().fadeIn(400);
						  
                        var hundredmb = 100 * 1024 * 1024, max = parseInt(up.settings.max_file_size, 10);
                
                        plupload.each(files, function(file){
                          if (max > hundredmb && file.size > hundredmb && up.runtime != "html5"){
                            // file size error?
                            console.log("Error...");
                          }else{
        
                            
                          }
                        });
                
                        up.refresh();
                        up.start();
                      });
                
                      // a file was uploaded 
                      uploader_'.$field_id.'.bind("FileUploaded", function(up, file, response) {
        
						$(".mpresults").fadeOut(400);
		
                        var result = $.parseJSON(response.response);
        
                        var attach_url = result.html.attach_url;
                        var attach_id = result.html.attach_id;
                        var attach_title = result.html.attach_title;
                        
                        //alert(attach_url);
                        
                        
                        
                        var html_new = "<img src="+attach_url+" />";
                        
                        $(".profile-avatar").html(html_new);
                         
                      });
                
                    });   
                
                  </script>';
        
        
        ?>
                
        
        
        </div>
<?php

	endif;
	?>
        <div class="profile-avatar"><?php echo apply_filters('music_press_member_filter_user_avatar', $user_avatar); ?>
        </div>
       
    </div>

