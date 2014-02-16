//DELETE ORGANIZATION

$(document).ready(function(){

$('.confirm-delete').on('click', function(e){
	e.preventDefault();
	console.log('clicked');

	var id = $(this).data('id');
	var organizationName = $(this).data('name');
	console.log(organizationName);7
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
