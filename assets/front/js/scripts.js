jQuery(document).ready(function($) {
	



	$(document).on('change', '.music-press-member-edit form', function() {
		
		//alert(form_id);
			 form_id = $(this).attr('id');
			 console.log(form_id);
		
		//alert(form_id);
		
		//
		})





	$('.music-press-member-tooltip').tooltipster();


	$(document).on('click', '.music-press-member-edit .remove', function() {
		
		$(this).parent().remove();
		
		})



	
	$(document).on('click', '.music_press_member_date', function() {
		
		$(this).datepicker({ dateFormat : 'yy-mm-dd' });
		
		})
	$(document).on('click', '.mp_add_to', function() {

		$(this).parent().find('.mp_box_add').toggleClass('active');

		})

	// is solved 	
	$(document).on('click', '.mp_follow', function() {
		
		var artist_id 	= $(this).attr('artist_id');
		
		
		//alert('Hello');
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:music_press_member_ajax.music_press_member_ajaxurl,
		data: {
			"action"	: "music_press_member_ajax_follow",
			"artist_id"	: artist_id,
		},
		success: function(data) {
			
			var html = JSON.parse(data)
			
			//$(this).html( html['html'] );
						
			mpresults_html = html['mpresults_html'];
			action = html['action'];
			
			if(action=='in_wishlist'){
				
				if($(this).hasClass('in_wishlist')){
					
					$(this).removeClass('in_wishlist');
					
					}
				$(this).text('In wishlist');
				$(this).addClass(action);
				
				}
			else{
				
				}
			$('.mpresults').html(mpresults_html);
			$('.mpresults').stop().fadeIn(400).delay(3000).fadeOut(400);
			
		}
			});
	})
	$(document).on('click', '.mp_btn_add_song', function() {

		var song_id 	= $(this).attr('song_id');
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:music_press_member_ajax.music_press_member_ajaxurl,
		data: {
			"action"	: "music_press_member_ajax_wishlist",
			"song_id"	: song_id
		},
		success: function(data) {

			var html = JSON.parse(data)

			//$(this).html( html['html'] );

			mpresults_html = html['mpresults_html'];
			action = html['action'];

			if(action=='unfollow'){

				if($(this).hasClass('following')){

					$(this).removeClass('following');

					}
				$(this).text('Follow');
				$(this).addClass(action);

				}
			else if(action=='following'){

				if($(this).hasClass('unfollow')){

					$(this).removeClass('unfollow');

					}
				$(this).text('Following');

				$(this).addClass(action);
				}
			else{

				}
			$('.mpresults').html(mpresults_html);
			$('.mpresults').stop().fadeIn(400).delay(3000).fadeOut(400);

		}
			});
	})



});	


