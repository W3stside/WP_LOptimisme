//JQuery Calls for La Boutique//

$(document).ready(function() {
	$(".menu-main-menu-middle-container").children().mouseenter(function() {
		$(this).animate({height: '300px'} , 500);
	});
	$(".menu-main-menu-middle-container").children().mouseleave(function() {
		$(this).animate({height: '0'}, 500);	
	});

	var fpBigLink = $(".front-page-picture h1 a");
	var fpOverlay = $("#fp_pic_overlay");
	var fpPic = $("#fp_pic_large");
	$("body").hover(function() {
		fpBigLink.animate({backgroundColor: 'red'}, 150);
	});
});


// Reference the #id of the specific <li> menus
// Create <?php ?> base code (like the Featured Section) for each #id