/*------------------------------------*\
	GLOBAL
\*------------------------------------*/

var site_wrapper = document.getElementById('site-wrapper');
site_wrapper.style.opacity = '1';
		
function stats_fade_in( content ){	
	var window_scroll = window.pageYOffset || document.documentElement.scrollTop,
		content_top_pos = jQuery(content).offset().top,
		content_height = jQuery(content).outerHeight();
	
	if( content_top_pos + content_height < window_scroll + (window.innerHeight * 0.9) ){
		jQuery(content).css('opacity', 1);
	}
}
	
(function($){
	
	'use strict';
	
	/*------------------------------------*\
		STATS FADE IN
	\*------------------------------------*/
	
	jQuery(window).on('load', function(){
		
		jQuery('.stats .content, .item-grid .content').each(function(){
			stats_fade_in( jQuery(this) );
		});
		
	});
	
})(jQuery);