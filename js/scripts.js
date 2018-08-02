(function ($, root, undefined) {

	$(function () {

		'use strict';

		/*------------------------------------*\
			SCROLL ICON FADE IN
		\*------------------------------------*/

		var scroll_down = document.getElementById('scroll-down');
		if(scroll_down){
			var home_first = $('#home-banner-1');
			if(home_first){
				var next_section = $(home_first).next('section');
				if(next_section){
					var section_top = $(next_section).offset().top;
				}
			}
		}

		setTimeout(function(){
			$(scroll_down).addClass('active');
		}, 1300);

		$(scroll_down).click(function(){
			$('html, body').animate({
				scrollTop: section_top
			});
		});

		/*------------------------------------*\
			SEARCH MODAL
		\*------------------------------------*/
		$('#search-modal').on('shown.bs.modal', function(){
			$(this).addClass('active');
			$('#search-modal input[type=text]').focus();
		});

		$('#search-modal').on('hide.bs.modal', function(){
			$(this).removeClass('active');
		})

		/*------------------------------------*\
			MOBILE LOGO
		\*------------------------------------*/

		$(document).on('scroll', function(){
			var window_scroll = window.pageYOffset || document.documentElement.scrollTop;
			var mobile_logo = document.getElementById('mobile-logo');
			if( window_scroll > 0 ){
				$(mobile_logo).addClass('disable');
			} else {
				$(mobile_logo).removeClass('disable');
			}
		});

		/*------------------------------------*\
			Banner Awards Slider
		\*------------------------------------*/

		$('.banner .awards ul').bxSlider(
		{
			mode: 'vertical',
			controls: false,
			pager: false,
			auto: true,
			speed: 1000,
			easing: 'cubic-bezier(0.77, 0, 0.175, 1)',
			touchEnabled: false
		});

		/*------------------------------------*\
			STATS FADE IN
		\*------------------------------------*/

		$(window).on('scroll', function(){

			jQuery('.stats .content, .item-grid .content').each(function(){
				stats_fade_in( jQuery(this) );
			});

		});

		/*------------------------------------*\
			Footer To Top
		\*------------------------------------*/

		var back_top = document.getElementById('footer-back-top');

		function to_top_toggle(){
			if($(window).scrollTop() + $(window).height() >= $(document).height()) {
				$(back_top).removeClass('disable');
			} else {
				$(back_top).addClass('disable');
			}
		}

		function scroll_top(){
			$("html, body").animate({ scrollTop: 0 }, "slow");
		}

		$(back_top).click(function(e){
			e.preventDefault();
			scroll_top();
		});

		$(document).on('load scroll', function(){
			to_top_toggle();
		});


	});

})(jQuery, this);
