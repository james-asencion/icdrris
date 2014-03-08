$(document).ready(function(){

$('.confirm-deploy').on('click', function(e){
	e.preventDefault();
	console.log('clicked');
	var id = $(this).data('id');
	$('#modalChooseDeploymentType').data('id',id);
	$('#modalChooseDeploymentType .modal-body').html("<h1 class=\"text-center\">Choose Deployment Category</h1><br>");
	$('#modalChooseDeploymentType').modal('show');
});

$('#modalChooseDeploymentType').on('show.bs.modal', function(){
	var id  = $(this).data('id'),
		removeBtn = $(this).find('.danger');
});

$('#btnChooseFromList').click(function(){

	var id = $('#modalChooseDeploymentType').data('id');
	window.location = "http://localhost/icdrris/Livelihood/deployLivelihoodProgramFromList/id/"+id;
	
});


$('.deployLivelihoodProgram').on('click', function(e){
	e.preventDefault();
	console.log('deploy livelihood program button clicked');
	var programId = $(this).data('program');
	var organizationId = $(this).data('organization');
	console.log("program id on click: "+programId+"  organization id on click: "+organizationId);
	$("#modal-deployLivelihoodProgram").data('programId', programId);
	$("#modal-deployLivelihoodProgram").data('organizationId', organizationId);
	$("#modal-deployLivelihoodProgram").modal('show');

});

$('#modal-deployLivelihoodProgram').on('show.bs.modal', function(){
	var id  = $(this).data('id'),
	removeBtn = $(this).find('.danger');
});

$("#confirmDeployment").click(function(){

	var programId = $('#modal-deployLivelihoodProgram').data('programId');
	var organizationId = $('#modal-deployLivelihoodProgram').data('organizationId');
	var dataStr = 'programId='+programId+'&organizationId='+organizationId;
	
	var quantityArray = new Array();
	var resourceArray = new Array();
	var programLivelihoodResource = new Array();

	var resources = $('#deployLivelihoodProgramModalBody input:text');
         $.each(resources, function(i,b){
             if($(b).val()==''){
             	console.log("input field no: "+i+" is empty");
             }else{
             	resourceArray.push($(b).data('id'));
             	programLivelihoodResource.push($(b).data('resource'));
             	quantityArray.push($(b).val());
             	console.log("data-id: "+$(b).data('id')+" quantity specified: "+$(b).val()+"  livelihood program resource id: "+$(b).data('resource'));
             }
    });

    var quantityJsonString = JSON.stringify(quantityArray);
	var resourceJsonString = JSON.stringify(resourceArray);
	var programLivelihoodResourceJsonString = JSON.stringify(programLivelihoodResource);

	request = $.ajax({
		url: "http://localhost/icdrris/Livelihood/deployLivelihoodResource",
		type: "POST",
		data: {quantities:quantityJsonString, resources:resourceJsonString, program_resources:programLivelihoodResourceJsonString, program_id:programId, org_id:organizationId},
		success: function(msg){
			$("membersTable").html(msg);
			console.log("success");
			console.log(dataStr);
			console.log(msg);
			$("#modal-deployLivelihoodProgram").modal('hide');
			
			// $("#livelihoodResourcesTable").html('');
			// $("#resource_quantity").val('');
			// $("#resource_id").val('');
			// $("#livelihoodResourcesTable").html(msg);


		},
		error: function(){
			console.log("fail");
			console.log(msg);
			// $("#livelihoodResourcesTable").html(msg);
		}
	});	
		
});



$('.approveProgramRequest').on('click', function(e){
	e.preventDefault();
	console.log('approve livelihood program request button clicked');
	var programId = $(this).data('program');
	var organizationId = $(this).data('organization');
	var requestId = $(this).data('request');
	console.log("program id on click: "+programId+"  organization id on click: "+organizationId);
	$("#modal-approveRequest").data('programId', programId);
	$("#modal-approveRequest").data('organizationId', organizationId);
	$("#modal-approveRequest").data('requestId', requestId);
	$("#modal-approveRequest").modal('show');

});

$('#modal-approveRequest').on('show.bs.modal', function(){
	var id  = $(this).data('id'),
	removeBtn = $(this).find('.danger');
});

$("#confirmApproval").click(function(){

	var programId = $('#modal-approveRequest').data('programId');
	var organizationId = $('#modal-approveRequest').data('organizationId');
	var requestId = $('#modal-approveRequest').data('requestId');
	var dataStr = 'programId='+programId+'&organizationId='+organizationId;
	
	var quantityArray = new Array();
	var resourceArray = new Array();
	var programLivelihoodResource = new Array();

	var resources = $('#approveRequestModalBody input:text');
         $.each(resources, function(i,b){
             if($(b).val()==''){
             	console.log("input field no: "+i+" is empty");
             }else{
             	resourceArray.push($(b).data('id'));
             	programLivelihoodResource.push($(b).data('resource'));
             	quantityArray.push($(b).val());
             	console.log("data-id: "+$(b).data('id')+" quantity specified: "+$(b).val()+"  livelihood program resource id: "+$(b).data('resource'));
             }
    });

    var quantityJsonString = JSON.stringify(quantityArray);
	var resourceJsonString = JSON.stringify(resourceArray);
	var programLivelihoodResourceJsonString = JSON.stringify(programLivelihoodResource);

	request = $.ajax({
		url: "http://localhost/icdrris/Livelihood/approveLivelihoodRequest",
		type: "POST",
		data: {quantities:quantityJsonString, resources:resourceJsonString, program_resources:programLivelihoodResourceJsonString, program_id:programId, org_id:organizationId, request_id:requestId},
		success: function(msg){
			$("membersTable").html(msg);
			console.log("success");
			console.log(dataStr);
			console.log(msg);
			$("#modal-approveRequest").modal('hide');
			// $("#livelihoodResourcesTable").html('');
			// $("#resource_quantity").val('');
			// $("#resource_id").val('');
			// $("#livelihoodResourcesTable").html(msg);


		},
		error: function(){
			console.log("fail");
			console.log(msg);
			// $("#livelihoodResourcesTable").html(msg);
		}
	});	
		
});




$('.send-request').on('click', function(e){
	e.preventDefault();
	console.log('send request to livelihood program button clicked');
	var programId = $(this).data('id');
	var urlString = window.location.pathname.split('/');
	var organizationId = urlString[5];
	var livelihoodProgramName = $(this).data('program');
	console.log("program id on click: "+programId+"  organization id on click: "+organizationId);
	$("#modalSendLivelihoodRequest").data('programId', programId);
	$("#modalSendLivelihoodRequest").data('organizationId', organizationId);
	$('#modalSendLivelihoodRequest .modal-body').html("<h2 class=\"text-center\">Send livelihood request to: </h2><h4>"+livelihoodProgramName+"<h4><br><label class=\"control-label\">Request Description</label><textarea id=\"request_description\" rows=\"3\"></textarea>");
	$("#modalSendLivelihoodRequest").modal('show');


});

$('#modalSendLivelihoodRequest').on('show.bs.modal', function(){
	var id  = $(this).data('id'),
	removeBtn = $(this).find('.danger');
});

$("#confirmRequest").click(function(){

	var programId = $('#modalSendLivelihoodRequest').data('programId');
	var organizationId = $('#modalSendLivelihoodRequest').data('organizationId');
	var requestDescription = $('#request_description').val();

	request = $.ajax({
		url: "http://localhost/icdrris/Livelihood/sendLivelihoodRequest",
		type: "POST",
		data: {program_id:programId, organization_id:organizationId,request_description:requestDescription},
		success: function(msg){
			console.log("livelihood program request successfully sent");
			console.log(msg);
			$("#modalSendLivelihoodRequest").modal('hide');
			$("#modalSendLivelihoodRequestSuccess").modal('show');
			
		},
		error: function(){
			console.log("fail");
			console.log(msg);
		}
	});	
		
});

$('.cancel-request').on('click', function(e){
	e.preventDefault();
	console.log('cancel request button clicked');
	var requestId = $(this).data('id');
	var orgId = $(this).data('org');
	var livelihoodProgramName = $(this).data('program');
	console.log("cancel request id on click: "+requestId);
	$("#modalCancelLivelihoodRequest").data('request_id', requestId);
	$("#modalCancelLivelihoodRequest").data('org_id', orgId);
	$('#modalCancelLivelihoodRequest .modal-body').html("<h2 class=\"text-center\">Are you sure you want to cancel request to: </h2><h4>"+livelihoodProgramName+"<h4><br>");
	$("#modalCancelLivelihoodRequest").modal('show');


});

$("#cancelRequest").click(function(){

	var request_id = $('#modalCancelLivelihoodRequest').data('request_id');
	var org_id = $('#modalCancelLivelihoodRequest').data('org_id');

	request = $.ajax({
		url: "http://localhost/icdrris/Livelihood/cancelLivelihoodRequest",
		type: "POST",
		data: {request_id:request_id, org_id:org_id},
		success: function(msg){
			console.log("request successfully cancelled");
			console.log(msg);
			$("#requestsHistoryTable").html('');
			$("#requestsHistoryTable").html(msg);
			$("#modalCancelLivelihoodRequest").modal('hide');
			$("#cancelLivelihoodRequestSuccess").modal('show');

			
		},
		error: function(){
			console.log("cancel request failed");
			console.log(msg);
		}
	});	
		
});



$('#btnChooseFromMap').click(function(){

	var id = $('#modalChooseDeploymentType').data('id');
	window.location = "http://localhost/icdrris/Livelihood/deployLivelihoodProgramFromMap/id/"+id;
	
});

$('.submitNewLivelihoodResource').on('click', function(e){
	e.preventDefault();
	var programId = $(this).data('id');
	console.log("program id on click: "+programId);
	$("#addNewProgramResourceModal").data('programId', programId);
	//$("#addNewProgramResourceModal").data('organizationId', organizationId);
	$("#addNewProgramResourceModal").modal('show');


});

$("#confirmNewResource").click(function(){

	var programId = $('#addNewProgramResourceModal').data('programId');
	var resourceDescription = $('#resource_description').val();

	request = $.ajax({
		url: "http://localhost/icdrris/Livelihood/addNewProgramResource",
		type: "POST",
		data: {program_id:programId, resource_description:resourceDescription},
		success: function(msg){
			console.log("new resource successfully saved");
			console.log(msg);
			$("#resourceDropdown").html(msg);
			$('#resource_description').val('');
			$("#addNewProgramResourceModal").modal('hide');
			
		},
		error: function(){
			console.log("submit new resource fail");
			console.log(msg);
		}
	});	
		
});

$('.showOrganizations').click(function(){
	console.log("show organizations clicked");
	$('#livelihoodOrganizationsTable').toggle();
});

$('.showRequests').click(function(){
	console.log("show requests clicked");
	$("#pendingRequests").toggle();
});

$('.showRecipients').click(function(){
	$("#grantedLivelihoodOrganizations").toggle();
});

$('.showExternalOrganizationsList').click(function(){
	console.log("show external organizations clicked");
	$('#externalOrganizationsList').toggle();
});
$('.showResourcesPanel').click(function(){
	console.log("show resources panel clicked");
	$('#deploymentHistory').hide();
	$('#deploymentPanel').hide();
	$('#resourcesPanel').show();

});
$('.showDeploymentPanel').click(function(){
	console.log("show deployment panel clicked");
	$('#deploymentHistory').hide();
	$('#resourcesPanel').hide();
	$('#deploymentPanel').show();

});
$('.showDeploymentHistory').click(function(){
	console.log("show deployment panel clicked");
	$('#resourcesPanel').hide();
	$('#deploymentPanel').hide();
	$('#deploymentHistory').show();

});

$('.sendLivelihoodProgramRequest').click(function(){
	console.log("show deployment panel clicked");
	$('#livelihoodOrgMembersPanel').hide();
	$('#livelihoodOrganizationRequestsPanel').hide();
	$('#livelihoodOrganizationGrantsPanel').hide();
	$('#availableProgramsPanel').show();

});
$('.showLivelihoodOrganizationMembers').click(function(){
	console.log("show deployment panel clicked");
	$('#availableProgramsPanel').hide();
	$('#livelihoodOrganizationRequestsPanel').hide();
	$('#livelihoodOrganizationGrantsPanel').hide();
	$('#livelihoodOrgMembersPanel').show();

});
$('.showRequestHistory').click(function(){
	console.log("show deployment panel clicked");
	$('#availableProgramsPanel').hide();
	$('#livelihoodOrgMembersPanel').hide();
	$('#livelihoodOrganizationGrantsPanel').hide();
	$('#livelihoodOrganizationRequestsPanel').show();


});
$('.showGrantsHistory').click(function(){
	console.log("show deployment panel clicked");
	$('#availableProgramsPanel').hide();
	$('#livelihoodOrgMembersPanel').hide();
	$('#livelihoodOrganizationRequestsPanel').hide();
	$('#livelihoodOrganizationGrantsPanel').show();

});
$("#btnSubmitNewResource").click(function(){
	
	var resource_quantity = $("#resource_quantity").val();
	var resource_id = $("#resource_id").val();
	var program_id = $(this).data('id');
	var dataStr = 'resource_id='+resource_id+'&resource_quantity='+resource_quantity+'&program_id='+program_id;
	alert(dataStr);
	request = $.ajax({
		url: "http://localhost/icdrris/Livelihood/addLivelihoodResource",
		type: "POST",
		data: dataStr,
		success: function(msg){
			//$("membersTable").html(msg);
			console.log("success");
			console.log(msg);
			
			$("#livelihoodResourcesTable").html('');
			$("#resource_quantity").val('');
			$("#resource_id").val('');
			$("#livelihoodResourcesTable").html(msg);


		},
		error: function(){
			console.log("fail");
			console.log(values);
			$("#livelihoodResourcesTable").html(msg);
		}
	});

	
});

});