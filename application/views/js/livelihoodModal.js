$(document).ready(function(){

$("#proceedToResourcesList").click(function(){

	console.log("proceed to resources list clikced");
	var livelihood_org_id = $('#modalLivelihoodProgramList').data('livelihood_org_id');

	$('#livelihoodProgramResourceListModal').data('livelihood_org_id',livelihood_org_id);
	var program_id;
	//retrieve the selected livelihood program id
	var radios = $('#livelihoodProgramsList input:radio');
        
    $.each(radios, function(i,b){
            ($(b).is(':checked'))?program_id=($(b).data('id')):console.log('not checked');
    });

    $('#livelihoodProgramResourceListModal').data('program_id',program_id);
    alert("livelihood_org_id -> "+livelihood_org_id+", program_id-> "+program_id);

	$.ajax({
		url: "http://localhost/icdrris/Livelihood/constructLivelihoodProgramResourceForm",
		type: "POST",
		data: {program_id:program_id},
		success: function(msg){
			$('#livelihoodProgramResourceListModal .modal-body').html(msg);
			$('#modalLivelihoodProgramList').modal('hide');
			$('#livelihoodProgramResourceListModal').modal('show');

		},
		error: function(msg){
			console.log("something went wrong");
			$('#livelihoodProgramResourceListModal .modal-body').html("oopss something went wrong");
			$('#modalLivelihoodProgramList').modal('hide');
			$('#livelihoodProgramResourceListModal').modal('show');
		}

	});

});

// $("#confirmDeploymentModal").click(function(){

// 	var program_id = $('#livelihoodProgramResourceListModal').data('program_id');
// 	var livelihood_organization_id = $('#livelihoodProgramResourceListModal').data('livelihood_org_id');

// 	//alert("program_id --->>>"+program_id+",  livelihood_organization_id--->>>"+livelihood_organization_id);
// 	// $.ajax({
// 	// 	url: "http://localhost/icdrris/Livelihood/getLivelihoodProgramResourcesModal",
// 	// 	type: "POST",
// 	// 	data: {program_id:id},
// 	// 	success: function(msg){
// 	// 		$('#livelihoodProgramResourceListModal .modal-body').html(msg);
// 	// 		$('#modalLivelihoodProgramList').modal('hide');
// 	// 		$('#livelihoodProgramResourceListModal').modal('show');

// 	// 	},
// 	// 	error: function(msg){
// 	// 		console.log("something went wrong");
// 	// 		$('#livelihoodProgramResourceListModal .modal-body').html("oopss something went wrong");
// 	// 		$('#modalLivelihoodProgramList').modal('hide');
// 	// 		$('#livelihoodProgramResourceListModal').modal('show');
// 	// 	}

// 	// });
	
// });
$("#confirmDeploymentModal").click(function(){

	var programId = $('#livelihoodProgramResourceListModal').data('program_id');
	var organizationId = $('#livelihoodProgramResourceListModal').data('livelihood_org_id');
	
	var quantityArray = new Array();
	var resourceArray = new Array();
	var programLivelihoodResource = new Array();

	var resources = $('#livelihoodProgramResourceListModalBody input[type=number]');
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
	alert("resource array has size -->"+resourceArray.length+",  quantity array has size -->"+quantityArray.length+", programLivelihoodResourceArray -->"+programLivelihoodResource.length);

	request = $.ajax({
		url: "http://localhost/icdrris/Livelihood/deployLivelihoodResource",
		type: "POST",
		data: {quantities:quantityJsonString, resources:resourceJsonString, program_resources:programLivelihoodResourceJsonString, program_id:programId, org_id:organizationId},
		success: function(msg){
			//$("membersTable").html(msg);
			console.log("success");
			//console.log(dataStr);
			//console.log(msg);
			$("#livelihoodProgramResourceListModal").modal('hide');
			$("#modalGrantProgramFromMapSuccess").modal('show');
			
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


});

function grantLivelihoodProgramFromMap(id){
	//e.preventDefault();
	//alert('clicked');
	$('#modalLivelihoodProgramList').data('livelihood_org_id',id);

	alert("livelihood organization id: "+id);
	$('#modalLivelihoodProgramList').modal('show');

}