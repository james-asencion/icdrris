$(document).ready(function(){

// $("#confirmNewResource").click(function(){

// 	var programId = $('#addNewProgramResourceModal').data('programId');
// 	var resourceDescription = $('#resource_description').val();

// 	request = $.ajax({
// 		url: "http://localhost/icdrris/Livelihood/addNewProgramResource",
// 		type: "POST",
// 		data: {program_id:programId, resource_description:resourceDescription},
// 		success: function(msg){
// 			console.log("new resource successfully saved");
// 			console.log(msg);
// 			$("#resourceDropdown").html(msg);
// 			$('#resource_description').val('');
// 			$("#addNewProgramResourceModal").modal('hide');
			
// 		},
// 		error: function(){
// 			console.log("submit new resource fail");
// 			console.log(msg);
// 		}
// 	});	
		
// });

$("#btnAddNewSkillTrigger").click(function(){
	console.log("btn add new skill trigger clicked");
	$('#btnAddNewSkillTrigger').hide();
	$('#skillsList').hide();
	$('#btnSubmitNewSkill').show();
	$('#addNewSkillField').show();
	$('#cancelNewSkill').show();
});

$("#cancelNewSkill").click(function(){
	console.log("btn add new skill trigger clicked");
	$("#newSkill").val('');
	$('#btnSubmitNewSkill').hide();
	$('#addNewSkillField').hide();
	$('#cancelNewSkill').hide();
	$('#btnAddNewSkillTrigger').show();
	$('#skillsList').show();
});
$(".skillsetDropdown").click(function(event){
	event.stopPropagation();
});
$("#btnSubmitNewSkill").click(function(){

	var skillDescription = $("#newSkill").val();

	request = $.ajax({
		url: "http://localhost/icdrris/ResponseOrg/addNewMemberSkillset",
		type: "POST",
		data: {skillset_description:skillDescription},
		success: function(msg){
			console.log("new skillset successfully saved");
			console.log(msg);
			//alert(msg);
			$("#skillsetCheckboxList").html(msg);
			$('#newSkill').val('');
			$('#btnSubmitNewSkill').hide();
			$('#addNewSkillField').hide();
			$('#btnAddNewSkillTrigger').show();
			$('#skillsList').show();
		},
		error: function(){
			alert("new skillset failed");
			alert(msg);
		}
	});		
});

});