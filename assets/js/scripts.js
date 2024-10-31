(function ($) {

    "use strict";
	
	var scrolltopbar_loaded = false,
		scrolltopbar_scrollPosition = 0,	
		scrolltopbar_scrolledByClick = false,
		scrolltopbar_containerBlock = $(".scrolltopbar"),
		scrolltopbar_containerArrow = scrolltopbar_containerBlock.find('i'),
		scrolltopbar_containerCaption = scrolltopbar_containerBlock.find('u'),
		scrolltopbar_scroll_count = 0;
		
	function scrolltopbar_visibility_update() {
        if ( typeof scrolltopbar_containerBlock !== "undefined" && scrolltopbar_containerBlock)
	    {
			if ($(window).scrollTop() >= scrolltopbar_scroll_offset) {
				if(!scrolltopbar_containerBlock.is(':animated')) { 
					var scrolltopbar_loadtime = scrolltopbar_fadein_speed;
					if(!scrolltopbar_loaded && scrolltopbar_fadein_instant_on_load) scrolltopbar_loadtime = 0;
					scrolltopbar_containerBlock.fadeIn( scrolltopbar_loadtime );
				}
			} else if(!scrolltopbar_scrolledByClick) {
				scrolltopbar_containerBlock.fadeOut( scrolltopbar_fadeout_speed );
			}
		}
    }
	
	scrolltopbar_containerBlock.click(function(){
		if(scrolltopbar_scrollPosition == 0 && $(window).scrollTop() != 0 && scrolltopbar_allow_user_back)
		{
			scrolltopbar_scrollPosition = $(window).scrollTop();
			$("html, body").animate({scrollTop: 0}, 0);
			scrolltopbar_containerArrow.removeClass('icon-up').addClass('icon-down');
			scrolltopbar_containerCaption.hide();
			scrolltopbar_scrolledByClick = true;
		}
		else
		{
			$("html, body").animate({scrollTop: scrolltopbar_scrollPosition}, 0);
			scrolltopbar_containerArrow.removeClass('icon-down').addClass('icon-up');
			scrolltopbar_containerCaption.show();
			scrolltopbar_scrollPosition = 0;
		}
	});
	
	$(document).ready(function () {
		scrolltopbar_visibility_update();
		scrolltopbar_loaded = true;
	});
	
	$(window).scroll(function() {
		scrolltopbar_visibility_update();
			
		if (scrolltopbar_scrolledByClick && $(window).scrollTop() != 0) {
			scrolltopbar_scrolledByClick = false;
			scrolltopbar_scrollPosition = 0;
			scrolltopbar_containerArrow.removeClass('icon-down').addClass('icon-up');
			scrolltopbar_containerCaption.show();
		}
		
		scrolltopbar_scroll_count++;
	});

})(jQuery);