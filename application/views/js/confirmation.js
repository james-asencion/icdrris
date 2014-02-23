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
			window.location = "http://localhost/icdrris/ResponseOrg/viewAllResOrgs";		
		},
		error: function(msg){
			console.log("something went wrong");
			$('#modalDeleteResOrg .modal-body').html("<p>Opss..something went wrong</p>");
			$('#modalDeleteResOrg').modal('show');
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

			
			
// CHECK IF RATED: SAMPLE
/**
function rateVictim()
{

	$(document).ready(function(){
			if(typeof(Storage)!=="undefined"){
			
				//get set var in localStorage
				var rateClick= localStorage.getItem("rateClickMe");
				if (rateClick == "disapproved"){
					$("#iThumbsDown").css("background-color", "red");
				}
			  if(rateClick == "approved"){
				$("#iThumbsUp").css("background-color", "green");
			  }
				
			}
			else{
			  alert("Sorry, your browser does not support web storage...");
			}
		});
/**	//IF CLICKED APPROVED
	
		if(typeof(Storage)!=="undefined") {
		$("#btn-clickme").click(function(){
		
		
			localStorage.removeItem("rateClickMe");
			localStorage.setItem("rateClickMe", "approved");
		
		});
		
		$("#btn-clickme2").click(function(){
		
		
			localStorage.removeItem("rateClickMe");
			localStorage.setItem("rateClickMe", "disapproved");
		
		});
				if (localStorage.clickcount){
					localStorage.clickcount=Number(localStorage.clickcount)+1;
				}
				else{
					localStorage.clickcount=1;
				}
			document.getElementById("result").innerHTML="You have clicked the button clickme " + localStorage.clickcount + " time(s).";
		}
		else{
		  document.getElementById("result").innerHTML="Sorry, your browser does not support web storage...";
		}
		

}*/
// END ON CHECK IF RATED

