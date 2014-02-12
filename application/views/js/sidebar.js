$(document).ready(function(){
	$(".trigger").click(function(){
		console.log("trigger clicked here 1");
		$("#map_canvass").addClass("span6"); //added
		$("#map_canvass").css({"float":"right"}); //added
		$(".panel").toggle("fast");
		$(this).toggleClass("active");
		return false;
	});
	$(".trigger").click(function(){
		if (!$(this).hasClass("active")) {
			console.log("trigger clicked here 2");
			$("#map_canvass").removeClass("span6");
			$("#map_canvass").addClass("span12");
		}
	});
});