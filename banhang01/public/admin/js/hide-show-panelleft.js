jQuery(document).ready(function($){ 	
	if($(".scroll_menu").length > 0){
		$(window).scroll(function () {
			var e = $(window).scrollTop();
			if (e > 300) {
				$(".scroll_menu").show()
			} else {
				$(".scroll_menu").hide()
			}
		});
		$(".scroll_menu").click(function () {
			$('body,html').animate({
				scrollTop: 0
			})
		})
	}		
});