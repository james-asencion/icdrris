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


//LOGIN FORM
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
// --end

// UPDATE VICTIM
function editVictim(element){
	$('.edit-victim').on('click', function(e){
		e.preventDefault();
		console.log('edit-victim clicked');
		
		var incidentid = $(this).data('incidentid');
		var victimid = $(this).data('victimid');
		var firstname = $(this).data('firstname');
		var middlename = $(this).data('middlename');
		var lastname = $(this).data('lastname');
		var address = $(this).data('address');
		var victimstatus = $(this).data('victimstatus');
		console.log('update victim: '+ incidentid + ' ' + victimid + ' '+ firstname+ ' '+ middlename+ ' '+ lastname+ ' '+ address+ ' '+ victimstatus);
		$('#modalUpdateVictim').data('incidentid',incidentid);	//for AND query
		$('#modalUpdateVictim').data('victimid',victimid);	//for AND query
		$('#modalUpdateVictim').data('firstname',firstname);	//for AND query
		$('#modalUpdateVictim').data('middlename',middlename);	//for AND query
		$('#modalUpdateVictim').data('lastname',lastname);	//for AND query
		$('#modalUpdateVictim').data('address',address);	//for AND query
		$('#modalUpdateVictim').data('victimstatus',victimstatus);	//for AND query
		console.log('passed the data to the modalUpdateVictim');
		$('#modalUpdateVictim').modal('show');
	});
	
	$('#modalUpdateVictim').on('show.bs.modal', function(){
			var incidentid  = $(this).data('incidentid');
			var victimid  = $(this).data('victimid');
			var firstname  = $(this).data('firstname');
			var middlename  = $(this).data('middlename');
			var lastname  = $(this).data('lastname');
			var address  = $(this).data('address');
			var victimstatus  = $(this).data('victimstatus');
			$("#first_name").attr("value", firstname);
			$("#middle_name").attr("value", middlename);
			$("#last_name").attr("value", lastname);
			$("#address").attr("value", address);
			//$("#victim_status").attr("value", victimstatus);
			var i=0;
			while ((document.updateVictimForm.victim_status.options[i].value != victimstatus) && (i < document.updateVictimForm.victim_status.options.length))
			  {i++;}
			if (i < document.updateVictimForm.victim_status.options.length)
			  {document.updateVictimForm.victim_status.selectedIndex = i;}
			removeBtn = $(this).find('.danger');
	});
	
	    $('#updateVictimForm').submit(function(event){
        // Stop form from submitting normally
        event.preventDefault();
        
        // Get some values from elements on the modal login page:
        var incidentid  = $('#modalUpdateVictim').data('incidentid');
		var victimid  = $('#modalUpdateVictim').data('victimid');
        var firstname = $("#first_name").val();
        var middlename = $("#middle_name").val();
        var lastname = $("#last_name").val();
        var address = $("#address").val();
        var victimstatus = document.updateVictimForm.victim_status.value;
        var dataStr = 'incidentid='+incidentid+'&victimid='+victimid+'&firstname='+firstname+'&middlename='+middlename+'&lastname='+lastname+'&address='+address+'&victimstatus='+victimstatus;
		console.log(dataStr);
        /* Send the data using post and put results to the members table */
		request = $.ajax({
			url: "http://localhost/icdrris/Victim/updateVictim",
			type: "POST",
			data: dataStr,
			success: function(msg){
				console.log("success");
				console.log(msg);
				if(msg == 'success'){
					console.log('naedit na bai. check the database');
					$('#modalUpdateVictim').modal('hide');
				}else{
					console.log('naay mali sa controller or model. recheck the code.')
					$(".modal-body").innerHTML(msg);
				}
			},
			error: function(){
				console.log("fail");
				$(".modal-body").html("Sorry, system error.");
			}
		});
    });
	
};

//UPDATE INCIDENT
	$('#editinfo-li').on('click', function(e){
		e.preventDefault();
		console.log('edit-incident clicked');
		
		var incidentid = $(this).data('incidentid');
		console.log('update incident: '+ incidentid);
		$('#modalUpdateIncident').data('incidentid',incidentid);	//for AND query
		
		$('#modalUpdateIncident').modal('show');
	});
	
	$('#modalUpdateIncident').on('show.bs.modal', function(){
			var incidentid  = $(this).data('incidentid');
			$("#first_name").attr("value", firstname);
			$("#middle_name").attr("value", middlename);
			$("#last_name").attr("value", lastname);
			$("#address").attr("value", address);
			//$("#victim_status").attr("value", victimstatus);
			var i=0;
			while ((document.updateVictimForm.victim_status.options[i].value != victimstatus) && (i < document.updateVictimForm.victim_status.options.length))
			  {i++;}
			if (i < document.updateVictimForm.victim_status.options.length)
			  {document.updateVictimForm.victim_status.selectedIndex = i;}
			removeBtn = $(this).find('.danger');
	});
	
	    $('#updateVictimForm').submit(function(event){
        // Stop form from submitting normally
        event.preventDefault();
        
        // Get some values from elements on the modal login page:
        var incidentid  = $('#modalUpdateVictim').data('incidentid');
		var victimid  = $('#modalUpdateVictim').data('victimid');
        var firstname = $("#first_name").val();
        var middlename = $("#middle_name").val();
        var lastname = $("#last_name").val();
        var address = $("#address").val();
        var victimstatus = document.updateVictimForm.victim_status.value;
        var dataStr = 'incidentid='+incidentid+'&victimid='+victimid+'&firstname='+firstname+'&middlename='+middlename+'&lastname='+lastname+'&address='+address+'&victimstatus='+victimstatus;
		console.log(dataStr);
        /* Send the data using post and put results to the members table */
		request = $.ajax({
			url: "http://localhost/icdrris/Victim/updateVictim",
			type: "POST",
			data: dataStr,
			success: function(msg){
				console.log("success");
				console.log(msg);
				if(msg == 'success'){
					console.log('naedit na bai. check the database');
					$('#modalUpdateVictim').modal('hide');
				}else{
					console.log('naay mali sa controller or model. recheck the code.')
					$(".modal-body").innerHTML(msg);
				}
			},
			error: function(){
				console.log("fail");
				$(".modal-body").html("Sorry, system error.");
			}
		});
    });
	