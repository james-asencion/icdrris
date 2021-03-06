$(document).ready(function(){
//alert("response organization.js loaded!");

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
	console.log("dropdown button clicked");
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

function undeployRespondent(response_organization_location_id){
	
	request = $.ajax({
		url: "http://localhost/icdrris/ResponseOrg/undeployResponseOrg",
		type: "POST",
		data: {response_organization_location_id:response_organization_location_id},
		success: function(msg){
			//alert("undeploy operation successfully performed");
            $('#modalSuccessResponseOrgUndeploy').modal('show');
			console.log(msg);
		},
		error: function(){
			alert("undeploy failed");
			console.log(msg);
		}
	});
}