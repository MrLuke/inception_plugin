(function ($) {
	$.fn.inception = function() {

		$(this).click(function(e){

			//prevent default click behaviour
			e.preventDefault();

			var $inception = $('<audio/>', {
				id: 'inception', 
				src: plugin_url+'inception.mp3',	//plugin_url is defined in header.php
				preload: 'auto',
				autoplay: 'autoplay',
			}),
				address = $(this).attr('href');

			//if there's an href value, redirect, otherwise, do nothing.
			if(address != null){
				setTimeout(function() {
					window.location.href = address;
				}, 3500);
			}
			
		});

		//return the jquery object for chaining to continue
		return this;
	}

	//when the document is ready, GO DEEPER!
	$(document).ready(function(){
		$(inception_options).inception();
	});
}(jQuery));

