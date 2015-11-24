jQuery(function($){
	$(document).ready(function(){
		$('.style-parallax').each(function(){
			var $bgobj = $(this);
			$window = $(window);
			$(window).scroll(function() {
				var yPos = -($window.scrollTop() / '10'); 
				var coords = '50% '+ yPos + 'px';
				$bgobj.css({ backgroundPosition: coords });
			}); 
    	});
	});
});