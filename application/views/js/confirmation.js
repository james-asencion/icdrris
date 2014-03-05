//DELETE ORGANIZATION

$(document).ready(function(){

$('.confirm-delete').on('click', function(e){
	e.preventDefault();
	console.log('clicked');

	var id = $(this).data('id');
	var organizationName = $(this).data('name');
	console.log(organizationName);
	$('#modalDelete').data('id',id);
	$('#modalDelete .modal-body').html("<p>Are you sure you want to delete: "+organizationName+" </p>");
	$('#modalDelete').modal('show');
});

$('#modalDelete').on('show.bs.modal', function(){
	var id  = $(this).data('id'),
		removeBtn = $(this).find('.danger');
});

$('#btnYes').click(function(){

	var id = $('#modalDelete').data('id');
	console.log('this is the id->'+id);
	var dataStr = 'org_id='+id;
	$.ajax({
		url: "http://localhost/icdrris/Livelihood/deleteOrganization",
		type: "POST",
		data: dataStr,
		success: function(msg){
			$('#modalDelete').modal('hide');		
		},
		error: function(msg){
			console.log("something went wrong");
			$('#modalDelete .modal-body').html("<p>Opss..something went wrong</p>");
			$('#modalDelete').modal('show');
		}

	});
});


//Response Organization

$('.confirm-deleteResOrg').on('click', function(e){
	e.preventDefault();
	console.log('clicked');

	var id = $(this).data('id');
	var organizationName = $(this).data('name');
	console.log(organizationName);
	$('#modalDeleteResOrg').data('id',id);
	$('#modalDeleteResOrg .modal-body').html("<p>Are you sure you want to delete: "+organizationName+"</p>");
	$('#modalDeleteResOrg').modal('show');
});

$('#modalDeleteResOrg').on('show.bs.modal', function(){
	var id  = $(this).data('id'),
		removeBtn = $(this).find('.danger');
});

$('#btnYesDeleteResOrg').click(function(){

	var id = $('#modalDeleteResOrg').data('id');
	console.log('this is the id->'+id);
	var dataStr = 'org_id='+id;
	$.ajax({
		url: "http://localhost/icdrris/ResponseOrg/deleteOrganization",
		type: "POST",
		data: dataStr,
		success: function(msg){
			$('#modalDeleteResOrg').modal('hide');
			window.location = "http://localhost/icdrris/ResponseOrg/viewAllUserResOrgs";		
		},
		error: function(msg){
			console.log("something went wrong");
			$('#modalDeleteResOrg .modal-body').html("<p>Opss..something went wrong</p>");
			$('#modalDeleteResOrg').modal('show');
		}

	});
});

//Response Organization Member
$('.confirm-deleteResOrgMember').on('click', function(e){
	e.preventDefault();
	console.log('clicked');

	var id = $(this).data('id');
	var lastname = $(this).data('lastname');
	var orgid = $(this).data('orgid');
	//var memberName = $(this).data('memberName');
	//console.log(memberName);

	$('#modalDeleteResOrgMember').data('id',id);
	$('#modalDeleteResOrgMember').data('lastname',lastname);
	$('#modalDeleteResOrgMember').data('orgid',orgid);
	$('#modalDeleteResOrgMember .modal-body').html("<p>Are you sure you want to delete: "+lastname+"</p>");
	$('#modalDeleteResOrgMember').modal('show');
});

$('#modalDeleteResOrgMember').on('show.bs.modal', function(){
	var memberid  = $(this).data('memberid'),
		removeBtn = $(this).find('.danger');
});

$('#btnYesDeleteResOrgMember').click(function(){

	var id = $('#modalDeleteResOrgMember').data('id');
	var orgid = $('#modalDeleteResOrgMember').data('orgid');
	console.log('this is the id->'+id);
	var dataStr = 'member_id='+id+'&org_id='+orgid;
	$.ajax({
		url: "http://localhost/icdrris/ResponseOrg/deleteResOrgMember",
		type: "POST",
		data: dataStr,
		success: function(msg){
			$('#members').html('');
			$('#members').html(msg);
			$('#modalDeleteResOrgMember').modal('hide');
		//	window.location = "http://localhost/icdrris/ResponseOrg/viewResOrg;		
		},
		error: function(msg){
			console.log("something went wrong");
			$('#modalDeleteResOrgMember .modal-body').html("<p>Opss..something went wrong</p>");
			$('#modalDeleteResOrgMember').modal('show');
		}

	});
});



});

// DELETE VICTIM
function deleteVictim(element){
$('.delete-victim').on('click', function(e){
		e.preventDefault();
		console.log('delete-victim clicked');
		var victimName = $(this).data('victimname');
		var incidentid = $(this).data('incidentid');
		var victimid = $(this).data('victimid');
		console.log(victimName + incidentid + victimid);
		$('#modalDeleteVictim').data('victimid',victimid);
		$('#modalDeleteVictim').data('incidentid',incidentid);
		$('#modalDeleteVictim').data('victimname',victimName);
		$('#modalDeleteVictim .modal-body').html("<p>Are you sure you want to delete: "+victimName+" </p>");
		$('#modalDeleteVictim').modal('show');	
});

$('#modalDeleteVictim').on('show.bs.modal', function(){
		var incidentid  = $(this).data('incidentid');
		var victimid  = $(this).data('victimid');
                var victimname= $(this).data('victimname');
		removeBtn = $(this).find('.danger');
});

$('#btnYesDeleteVictim').click(function(){

            var victimid = $('#modalDeleteVictim').data('victimid');
            var incidentid = $('#modalDeleteVictim').data('incidentid');
            var victimname= $('#modalDeleteVictim').data('victimname');
            console.log('this is the victimid->'+victimid + ' \n this is the incidentid->' + incidentid+ '\n this is the victim name-> '+victimname);
            var dataStr = 'incident_report_id='+incidentid+'&victim_id='+victimid;
            $.ajax({
                    url: "http://localhost/icdrris/Victim/deleteVictim",
                    type: "POST",
                    data: dataStr,
                    success: function(msg){
                        if(msg == 'success'){
                            $('#modalDeleteVictim').modal('hide');	
                            console.log('success: '+victimname);
                           // $('#success-delete-victim').html('');
                        }
                        else{
                            console.log('Results: '+msg)
                            $("#table-rows-victims").before('<p>Query failed.</p>');
                        }
                    },
                    error: function(msg){
                            console.log("something went wrong");
                            $('#modalDeleteVictim .modal-body').html("<p>Opss..Sorry, something went wrong</p>");
                            $('#modalDeleteVictim').modal('show');
                    }

                });
});
  
}


// CONFIRM INCIDENT
function confirmIncident(incident_location_id, inciName){

	console.log('confirm incident clicked: '+ incident_location_id + ' ' +inciName);
	$('#modalConfirmIncident').data('incident_location_id' , incident_location_id);
	$('#modalConfirmIncident .modal-body').html("<p> You are going to confirm the incident <b>'"+inciName+"'</b>.<br> Click 'Confirm' button to continue. Click 'Cancel' button to return to the page.")
	$('#modalConfirmIncident').modal('show');
	

}

// CONFIRM INCIDENT: CONFIRM BUTTON
function btnYesConfirmIncident(){

            var incident_location_id = $('#modalConfirmIncident').data('incident_location_id');
            console.log('btnYesConfirmIncident -> this is the incidentid->' + incident_location_id);
       
            $.ajax({
                    url: "http://localhost/icdrris/Incident/confirmIncident",
                    type: "POST",
                    data: {incident_location_id:incident_location_id},
                    success: function(msg){
                        if(msg == 'success'){
                            $('#modalConfirmIncident').modal('hide');	
                            console.log('success: '+msg );
                        }
                        else{
                            console.log('Results: '+msg)
                            $("#modalConfirmIncident .modal-body").before('<p>Query failed.</p>');
                        }
                    },
                    error: function(msg){
                            console.log("something went wrong");
                            $('#modalConfirmIncident .modal-body').html("<p>Opss..Sorry, something went wrong</p>");
                            $('#modalConfirmIncident').modal('show');
                    }

                });

}

// CONFIRM VICTIM
function confirmVictim(incident_report_id, victim_id){
	$('.confirmtrue-victim').on('click', function(e){
		e.preventDefault();
		console.log('confirm-victim clicked');
		var victimName = $(this).data('victimname');
		console.log(victimName + incident_report_id + victim_id);
		$('#modalConfirmVictim').data('victim_id',victim_id);
		$('#modalConfirmVictim').data('incident_report_id',incident_report_id);
		$('#modalConfirmVictim .modal-body').html("<p> You are going to confirm the victim <b>'"+victimName+"'</b>.<br> Click 'Confirm' button to continue. Click 'Cancel' button to return to the page.");
		$('#modalConfirmVictim').modal('show');	
	});

}

// CONFIRM VICTIM: CONFIRM BUTTON
function btnYesConfirmVictim(){

	   var incident_report_id = $('#modalConfirmVictim').data('incident_report_id');
           var victim_id = $('#modalConfirmVictim').data('victim_id');
           console.log('btnYesConfirmVictim -> this is the incidentid->' + incident_report_id);
       
            $.ajax({
                    url: "http://localhost/icdrris/Victim/confirmVictim",
                    type: "POST",
                    data: {incident_report_id:incident_report_id, victim_id:victim_id},
                    success: function(msg){
                        if(msg == 'success'){
                            $('#modalConfirmVictim').modal('hide');	
                            console.log('success: '+msg );
                        }
                        else{
                            console.log('Results: '+msg)
                            $("#modalConfirmVictim .modal-body").before('<p>Query failed.</p>');
                        }
                    },
                    error: function(msg){
                            console.log("something went wrong");
                            $('#modalConfirmVictim .modal-body').html("<p>Opss..Sorry, something went wrong</p>");
                            $('#modalConfirmVictim').modal('show');
                    }

                });

}

//DELETE INCIDENT
$(document).ready(function(){
	$('#delete-li').on('click', function(e){
			e.preventDefault();
			console.log('delete-incident clicked');
			var incidentid = $(this).data('incidentid');
			var incidentdesc = $(this).data('incidentdesc');
			console.log(incidentid + ' '+ incidentdesc);
			$('#modalDeleteIncident').data('incidentid',incidentid);
			$('#modalDeleteIncident .modal-body').html("<p>Are you sure you want to delete this Incident? </p><br /><p>Incident: "+incidentdesc);
			$('#modalDeleteIncident').modal('show');	
	});

	$('#modalDeleteIncident').on('show.bs.modal', function(){
			var incidentid  = $(this).data('incidentid');
                        console.log('onshowbsmodal: '+ incidentid);
			removeBtn = $(this).find('.danger');
	});

	$('#btnYesDeleteIncident').click(function(){

		var incidentid = $('#modalDeleteIncident').data('incidentid');
		console.log('this is the incidentid->' + incidentid);
		var dataStr = 'incident_report_id='+incidentid;
		$.ajax({
				url: "http://localhost/icdrris/Incident/deleteIncident",
				type: "POST",
				data: dataStr,
				success: function(msg){
					if(msg == 'success'){
						$('#modalDeleteIncident').modal('hide');	
						console.log('success: '+incidentid);
					   // $('#success-delete-victim').html('');
					}
					else{
						console.log('Results: '+msg)
						$("#modalDeleteIncident .modal-body").html('<p>Opps. Query failed. Please contact the admin.</p>');
					}
				},
				error: function(msg){
						console.log("something went wrong");
						$('#modalDeleteIncident .modal-body').html("<p>Opss..Sorry, something went wrong</p>");
						$('#modalDeleteIncident').modal('show');
				}

			});
	});
});


//  RATING ON REPORTED VICTIM
	function rateVictim(incident_report_id, victim_id, rateType){
	
	
			
			//var incident_report_id = $("#disapproved-victim").data('incidentid');
			//var victim_id = $("#disapproved-victim").data('victimid');
			var upOrDown= "";
			if(rateType == 0){
				upOrDown = "rateFalse";
			}
			else{
				upOrDown = "rateTrue";
			}
			var lastUpOrDown = localStorage.getItem(""+incident_report_id+""+ victim_id+"");
			
			console.log("last upOrDown: "+ lastUpOrDown+ ", Recent upOrDown: "+upOrDown);
			
			var actionType;
			if(upOrDown == lastUpOrDown){ //if the user wants to take back the vote
				actionType = "off";
			}
			if(lastUpOrDown != null && lastUpOrDown != upOrDown){	//if the user already rated before
				actionType = "onOff";
			}
			if(lastUpOrDown == null){ // if the user rated for the first time
				actionType = "on";
			}

			dataStr = "incident_report_id="+incident_report_id+ "&victim_id="+victim_id+"&upOrDown="+upOrDown+"&actionType="+actionType;
			console.log('data passed to rate: '+ dataStr);
			
			$.ajax({
				type: "POST",
				url: "http://localhost/icdrris/Victim/rateUpOrDown",
				cache: false,
				data: dataStr,
				success: function(msg){
					try{
						if(msg == 'true'){
						
							console.log('success :' + upOrDown);
							
							
							
							
							if(actionType == "off"){
								
								
								console.log("after removed: "+incident_report_id +""+victim_id+"");
								for(var i = 0; i < localStorage.length; i++) {  // Length gives the # of pairs
									var name = localStorage.key(i);             // Get the name of pair i
									var val = localStorage.getItem(name);
									if(name == ""+incident_report_id +""+victim_id+""){
										localStorage.removeItem(name);
										console.log("removed: in off");
									}
									console.log("localstorage names: "+ name + " value: "+ val);    // Get the value of that pair
								}
									$("#iThumbsUp").css("background-color", "");
									$("#iThumbsDown").css("background-color", "");
									
							
							}
							if(actionType == "on" || actionType == "onOff"){
									if(upOrDown == "rateTrue"){
										$("#iThumbsUp").css("background-color", "green");
										$("#iThumbsDown").css("background-color", "");
									}
									if(upOrDown == "rateFalse"){
										$("#iThumbsUp").css("background-color", "");
										$("#iThumbsDown").css("background-color", "red");
									}
								//localStorage.removeItem(incident_report_id+victim_id);
								localStorage.setItem(""+incident_report_id+""+ victim_id+"", upOrDown);
							
								console.log(""+incident_report_id +""+victim_id+"");
								for(var i = 0; i < localStorage.length; i++) {  // Length gives the # of pairs
									var name = localStorage.key(i);             // Get the name of pair i
									var val = localStorage.getItem(name);
									console.log("localstorage names: "+ name + " value: "+ val);    // Get the value of that pair
								}
							
							}
							
							
						}else{
						
							console.log('failed');
							
							alert('Sorry. Unable to update..' + msg);
						}
					}catch(e){
						alert('Exception while request..' + msg);
					}
				},
				error: function(){
					alert('Error while request..');
				}
			});
	};
// end  RATE

//  RATING ON REPORTED INCIDENT
	function rateIncident(rateType){
           var incident_location_id;
            var upOrDown= "";
			if(rateType == 0){
				upOrDown = "rateFalse";
                                incident_location_id = $('.disapprove-li').data('incidentid');
			}
			else{
				upOrDown = "rateTrue";
                                 incident_location_id = $('.approve-li').data('incidentid');
			}
			var lastUpOrDown = localStorage.getItem("i"+incident_location_id+"");
			
			console.log("incident_location_id: "+incident_location_id+ "last upOrDown: "+ lastUpOrDown+ ", Recent upOrDown: "+upOrDown);
			
			var actionType;
			if(upOrDown == lastUpOrDown){ //if the user wants to take back the vote
				actionType = "off";
			}
			if(lastUpOrDown != null && lastUpOrDown != upOrDown){	//if the user already rated before
				actionType = "onOff";
			}
			if(lastUpOrDown == null){ // if the user rated for the first time
				actionType = "on";
			}

			//dataStr = "incident_location_id="+incident_location_id+ "&upOrDown="+upOrDown+"&actionType="+actionType;
			//console.log('data passed to rate: '+ dataStr);
			
			$.ajax({
				type: "POST",
				url: "http://localhost/icdrris/Incident/rateUpOrDown",
				cache: false,
				data: {incident_location_id:incident_location_id, upOrDown:upOrDown, actionType:actionType},
				success: function(msg){
					try{
						if(msg == 'true'){
						
							console.log('success :' + upOrDown);
							
							
							
							
							if(actionType == "off"){
								
								
								console.log("after removed: "+incident_location_id +"");
								for(var i = 0; i < localStorage.length; i++) {  // Length gives the # of pairs
									var name = localStorage.key(i);             // Get the name of pair i
									var val = localStorage.getItem(name);
									if(name == "i"+incident_location_id +""){
										localStorage.removeItem(name);
										console.log("removed: in off");
									}
									console.log("localstorage names: "+ name + " value: "+ val);    // Get the value of that pair
								}
									$("#approve-li"+incident_location_id+"").css("background-color", "");
									$("#disapprove-li"+incident_location_id+"").css("background-color", "");
									
							
							}
							if(actionType == "on" || actionType == "onOff"){
									if(upOrDown == "rateTrue"){
										$("#approve-li"+incident_location_id+"").css("background-color", "green");
										$("#disapprove-li"+incident_location_id+"").css("background-color", "");
									}
									if(upOrDown == "rateFalse"){
										$("#approve-li"+incident_location_id+"").css("background-color", "");
										$("#disapprove-li"+incident_location_id+"").css("background-color", "red");
									}
								//localStorage.removeItem(incident_report_id+victim_id);
								localStorage.setItem("i"+incident_location_id+"", upOrDown);
							
								console.log("i"+incident_location_id+"");
								for(var i = 0; i < localStorage.length; i++) {  // Length gives the # of pairs
									var name = localStorage.key(i);             // Get the name of pair i
									var val = localStorage.getItem(name);
									console.log("localstorage names: "+ name + " value: "+ val);    // Get the value of that pair
								}
							
							}
							
							
						}else{
						
							console.log('failed');
							
							alert('Sorry. Unable to update..' + msg);
						}
					}catch(e){
						alert('Exception while request..' + msg);
					}
				},
				error: function(){
					alert('Error while request..');
				}
			});
	};
// end  RATE