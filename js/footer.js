// jQuery dependent scripts

(function(window, document, $) {
	
	window.html5_storage = function() {
		try {
			return 'localStorage' in window && window['localStorage'] !== null;
		} catch (e) {
			return false;
		}
	}
	
	window.googleTranslateInit = function() {
		
		window.googleTranslateElementInit = function() {
				new google.translate.TranslateElement({
					pageLanguage: 'en',
					autoDisplay: false,
					// gaTrack: true,
					// gaId: 'UA-32851833-1',
					layout: google.translate.TranslateElement.InlineLayout.SIMPLE
				}, 'translate_google');
		}
		
		$.getScript('//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit');
		
		$('#translate').remove();
		
		if(html5_storage()) {
			localStorage.setItem('translate', '1');
		}
		
	}
	
	$(document).on('ready', function() {
		
		// auto-submits the segmentation form whenever a dropdown is changed and uses jQuery UI
		
		var segmentation = $('#segmentation');
		
		var segmentation_submit = function() {
			segmentation.submit();
		}
		
		segmentation.find('select').on('change', segmentation_submit).selectmenu({
			width: 135,
			change: segmentation_submit
		});
		
		// YouTube videos on single.php
		
		if(typeof youtube === 'object' && typeof youtube.video === 'string') {
			
			window.onYouTubePlayerReady = function() {
				youtube.player.setPlaybackQuality('hd720');
				$('#single--content').fitVids();
			};
				  
			window.onYouTubePlayerAPIReady = function() {
			
				youtube.player = new YT.Player('ytplayer', {
					height: '403',
					width: '717',
					videoId: youtube.video,
					events: {
					  'onReady': window.onYouTubePlayerReady
					},
					playerVars: {
						rel: 0,
						showinfo: 0
					}
				});
			
			};
			
			$.getScript('https://www.youtube.com/player_api');
			
		} else { // for videos not using the custom field
			$('#single--content').fitVids();
		}
		
		// sidebar videos on audience home
		
		if($('#tax_audience--sidebar--videos li').length > 0) {
			
			window.onYouTubePlayerAPIReady = function() {
												
				jQuery('#tax_audience--sidebar--videos li').each(function() {
					var id = jQuery(this).data('youtube');
					if(id != '') {
						jQuery(this).prepend('<div id="ytplayer-'+id+'"></div>');
						var player = new YT.Player('ytplayer-'+id, {
							height: '159',
							width: '282',
							videoId: id,
							playerVars: {
								rel: 0,
								showinfo: 0
							}
						});
					}
				});
				
				jQuery('#tax_audience--sidebar--videos').fitVids();
			
			};
			
			$.getScript('https://www.youtube.com/player_api');
			
		}
		
		// images on single.php
		
		$('#single--content').find('img').parent('a').addClass('lightbox');
		
		$('#single--content').find('a.lightbox').imageLightbox({
			quitOnImgClick: true,
			animationSpeed: 200,
			onStart: function() {
				$('body').append('<div id="imagelightbox-overlay" style="display:none;"></div>');
				$('#imagelightbox-overlay').fadeIn(250);
			},
			onEnd: function() { 
				$('#imagelightbox-overlay').fadeOut(250, function() { $(this).remove(); }); 
			}
		});
		
		// FitVids for homepage video
		
		$('#index--main').fitVids();
		
		// Translate button
		
		if(html5_storage() && localStorage.getItem('translate') == '1') {
			window.googleTranslateInit();
		} else {
			$('#translate').on('click', window.googleTranslateInit);
		}
		
	});
	
})(window, document, jQuery);