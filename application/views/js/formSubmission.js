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
	var dataStr = 'org_id='+org_id+'&first_name='+first_name+'&last_name='+last_name+'&middle_name='+middle_name+'&sex='+sex+'&birthday='+birthday+'&age='+age+'&monthly_income='+monthly_income+'&source_of_income'+source_of_income+'&civil_status'+civil_status;

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