jQuery(function($){
	$(document).ready(function(){
		function sympleFadeIn() {
			$('.symple-fadein').each( function(i){
				var bottom_of_object = $(this).position().top + $(this).outerHeight();
				var bottom_of_window = $(window).scrollTop() + $(window).height();
				if( bottom_of_window > bottom_of_object ){
					$(this).delay(500).animate({'opacity':'1'}, 600);
				}
			});
		} sympleFadeIn();
		$(window).scroll( function(){
			sympleFadeIn();
		});
	});
});