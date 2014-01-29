$(document).ready(function(){
	$("#name").keyup(function(){
		console.log($("#name").val());
		if($("#name").val().length >=1 )
		{
		$.ajax({
			type: "POST",
			url: "http://localhost/icdrris/Livelihood/checkOrg",
			data: {first_name:$("#name").val()},
			success: function(msg){
				console.log("-->"+msg);
				if(msg=="true")
				{
					console.log("ok");
					$(".name_verify").append("<p>OK</p>");
				}
				else
				{
					console.log("not valid");
					$(".name_verify").append("<p>NOT VALID</p>");
				}
			}

		});
		}
		else
		{
			$(".name_verify").append("<p>NOT A VALID NAME LENGTH</p>");
			$console.log("NOT A VALID NAME LENGTH");
		}
	});
});