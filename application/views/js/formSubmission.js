$(document).ready(function(){

$("#addMemberButton").click(function(event)	{
	/* Stop form from submitting normally */
	//event.preventDefault();

	/* get the values from the elements on the page */
	//var values = $("addMemberForm").serialize();
	var org_id = $("#org_id").val();
	var first_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var middle_name = $("#middle_name").val();
	var sex = $("#sex").val();
	var birthday = $("#birthday").val();
	var age = $("#age").val();
	var monthly_income = $("#monthly_income").val();
	var source_of_income = $("#source_of_income").val();
	var civil_status = $("#civil_status").val();
	var dataStr = 'org_id='+org_id+'&first_name='+first_name+'&last_name='+last_name+'&middle_name='+middle_name+'&sex='+sex+'&birthday='+birthday+'&age='+age+'&monthly_income='+monthly_income+'&source_of_income='+source_of_income+'&civil_status='+civil_status;

	/* Send the data using post and put results to the members table */
	request = $.ajax({
		url: "http://localhost/icdrris/Livelihood/submitMember",
		type: "POST",
		data: dataStr,
		success: function(msg){
			//$("membersTable").html(msg);
			console.log("success");
			console.log(msg);
			
			$("#membersTable").html('');
			$("#membersTable").html(msg);


		},
		error: function(){
			console.log("fail");
			console.log(values);
			$("#membersTable").html(msg);
		}
	});


	});
});

$(document).ready(function(){

    $('#login-btn').on('click', function(e){
            e.preventDefault();
            console.log('clicked');

            $('#modalLogin').modal('show');
    });

    $('#loginForm').submit(function(event){
        // Stop form from submitting normally
        event.preventDefault();
        
        // Get some values from elements on the modal login page:
        var username = $("#username").val();
        var password = $("#password").val();
        var dataStr = 'username='+username+'&password='+password;

        /* Send the data using post and put results to the members table */
		request = $.ajax({
			url: "http://localhost/icdrris/Login/validate_credentials",
			type: "POST",
			data: dataStr,
			success: function(msg){
				console.log("success");
				console.log(msg);
				if(msg == 'success'){
					var rurl = 'http://localhost/icdrris';    
					$(location).attr('href',rurl);
					
				}else{
					$("#login-msg").html(msg);
				}
			},
			error: function(){
				console.log("fail");
				console.log(values);
				$("#login-msg").html("Sorry, system error.");
			}
		});
    });
});