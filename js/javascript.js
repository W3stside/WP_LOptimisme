//JQuery Calls for La Boutique//

$(document).ready(function() {
	$(".menu-main-menu-middle-container li").mouseenter(function() {
		$(this).append(
			"<div class='expandable-dropdown-menus-wrapper'>" +
				"<div class='expandable-dropdown-menus'>" +
					"SOME CRAP" +
				"</div>" +
			"</div>");
			//nothing...	
	});
	$(".menu-main-menu-middle-container li").mouseleave(function() {
		$('.expandable-dropdown-menus-wrapper').remove();	
	});
});


	