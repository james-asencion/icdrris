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
			$("#modalUpdateVictim #first_name").attr("value", firstname);
			$("#modalUpdateVictim #middle_name").attr("value", middlename);
			$("#modalUpdateVictim #last_name").attr("value", lastname);
			$("#modalUpdateVictim #address").attr("value", address);
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
        var firstname = $("#modalUpdateVictim #first_name").val();
        var middlename = $("#modalUpdateVictim #middle_name").val();
        var lastname = $("#modalUpdateVictim #last_name").val();
        var address = $("#modalUpdateVictim #address").val();
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

//REPORT VICTIM
$(document).ready(function(){
	$('#reportvictim-li').on('click', function(e){
		e.preventDefault();
		console.log('report-victim clicked');
		
		var incidentid = $(this).data('incidentid');
		console.log('report victim-incidentid: '+ incidentid);
		$('#modalReportVictim').data('incidentid',incidentid);	//for AND query
		
		$('#modalReportVictim').modal('show');
	});
	
	$('#modalReportVictim').on('show.bs.modal', function(){
			var incidentid  = $(this).data('incidentid');
			
			removeBtn = $(this).find('.danger');
	});
	
		$('#reportVictimForm').submit(function(event){
        // Stop form from submitting normally
        event.preventDefault();
        
        // Get some values from elements on the modal login page:
        var incidentid  = $('#modalReportVictim').data('incidentid');
        var firstname = $("#first_name").val();
        var middlename = $("#middle_name").val();
        var lastname = $("#last_name").val();
        var address = $("#address").val();
        var victimstatus = document.reportVictimForm.victim_status.value;
		console.log(victimstatus);
        var dataStr = 'reportNo='+incidentid+'&first_name='+firstname+'&middle_name='+middlename+'&last_name='+lastname+'&address='+address+'&victim_status='+victimstatus;
		console.log(dataStr);
        /* Send the data using post and put results to the members table */
		request = $.ajax({
			url: "http://localhost/icdrris/Victim/validate",
			type: "POST",
			data: dataStr,
			success: function(msg){
				console.log("success");
				console.log(msg);
				if(msg == 'success'){
					console.log('naadd na bai. check the database');
					$('#modalReportVictim').modal('hide');
				}else{
					console.log('naay mali sa controller or model. recheck the code.')
					$("#modalReportVictim.modal-body").html(msg);
				}
			},
			error: function(){
				console.log("fail");
				$(".modal-body").html("Sorry, system error.");
			}
		});
    });
	
});
	
function detailsVictim(element){
	$('.details-victim').on('click', function(e){
		e.preventDefault();
		console.log('details-victim clicked');
		
		var incidentid = $(this).data('incidentid');
		var victimid = $(this).data('victimid');
		var firstname = $(this).data('firstname');
		var middlename = $(this).data('middlename');
		var lastname = $(this).data('lastname');
		var address = $(this).data('address');
		var victimstatus = $(this).data('victimstatus');
		var report_rating_true = $(this).data('ratingtrue');
		var report_rating_false = $(this).data('ratingfalse');
		var flag_confirmed = $(this).data('flagconfirmed');
		console.log('show details victim: '+ incidentid + ' ' + victimid + ' '+ firstname+ ' '+ middlename+ ' '+ lastname+ ' '+ address+ ' '+ victimstatus+ ' '+ report_rating_true + ' ' + report_rating_false+ ' ' + flag_confirmed);
		$( "#full_name" ).html( document.createTextNode( firstname + " "+ middlename+ " "+lastname) );
		$( "#address" ).html( document.createTextNode( address) );
		$( "#victim_status" ).html( document.createTextNode( victimstatus) );
		$( "#modalDetailsVictim .rateTrue" ).html( document.createTextNode( report_rating_true) );
		$( "#modalDetailsVictim .rateFalse" ).html( document.createTextNode( report_rating_false) );
			
		
			
			var funcApproved= "rateVictim("+incidentid+", "+victimid+ ", "+1+")";
			var funcDisapproved= "rateVictim("+incidentid+", "+victimid+ ", "+0+")";
			$( "#approved-victim" ).attr( "onclick", funcApproved);
			$( "#disapproved-victim" ).attr( "onclick", funcDisapproved );
		if(flag_confirmed == 0){
			$( "#flag_confirmed" ).attr( "class", "span11 alert alert-error");
			$( "#flag_confirmed" ).html( "The victim is still not confirmed.");
		}
		if(flag_confirmed == 1){
			$( "#flag_confirmed").attr("class", "span11 alert alert-info");
			$( "#flag_confirmed" ).html( "The victim was already confirmed.");
		}
		console.log('passed the data to the modalDetailsVictim');
		$('#modalDetailsVictim').modal('show');
		
		console.log("Inside script for localStorage check rateVictim to change icon color");
				$(document).ready(function(){
					console.log("Inside document ready function for localstorage check rateVictim to change icon color")
					if(typeof(Storage)!=="undefined"){
					
						//get set var in localStorage
						var rateClick2= localStorage.getItem(""+incidentid+""+victimid+"");
						for(var i = 0; i < localStorage.length; i++) {  // Length gives the # of pairs
								var name = localStorage.key(i);             // Get the name of pair i
								var val = localStorage.getItem(name);             // Get the val of pair name
								console.log("localstorage names for show details: "+ name + " value: "+ val);    // Get the value of that pair
							}
						console.log("rateClick2 val: "+rateClick2);
						if (rateClick2 == "rateFalse"){
							//if disapproved, retain thumbsdown color
							$("#modalDetailsVictim #iThumbsDown2").css("background-color", "red");
							$("#modalDetailsVictim #iThumbsUp2").css("background-color", "");
							console.log("Thumbs Down color red");
						}
					  if(rateClick2 == "rateTrue"){
							//if approved,  retain thumbsup color
							$("#modalDetailsVictim #iThumbsUp2").css("background-color", "green");
							$("#modalDetailsVictim #iThumbsDown2").css("background-color", "");
							console.log("Thumbs up color green");
					  }if(rateClick2 == null){
							$("#modalDetailsVictim #iThumbsUp2").css("background-color", "");
							$("#modalDetailsVictim #iThumbsDown2").css("background-color", "");
					  
					  }
					
					}
					else{
					  alert("Sorry, your browser does not support web storage...");
					}
				});
	});
	
	

};

//Add Response Organization Member
$(document).ready(function(){

$("#addMemberButton1").click(function(event)	{
	/* Stop form from submitting normally */
	//event.preventDefault();
	console.log("addMemberButton1.click()");
	/* get the values from the elements on the page */
	//var values = $("addMemberForm").serialize();
	var org_id = $("#ro_org_id").val();
	var first_name = $("#ro_first_name").val();
	var last_name = $("#ro_last_name").val();
	var sex = $("#ro_sex").val();
	var birthday = $("#ro_birthday").val();
	var civil_status = $("#ro_civil_status").val();
	var dataStr = 'org_id='+org_id+'&first_name='+first_name+'&last_name='+last_name+'&sex='+sex+'&birthday='+birthday+'&civil_status='+civil_status;

	/* Send the data using post and put results to the members table */
	request = $.ajax({
		url: "http://localhost/icdrris/ResponseOrg/submitMember",
		type: "POST",
		data: dataStr,
		success: function(msg){
			//$("membersTable").html(msg);
			console.log("success");
			console.log(msg);
			
			$("#membersTable").html('');
			$("#membersTable").html(msg);
			$("#ro_first_name").val('');
			$("#ro_last_name").val('');
			$("#ro_sex").val('');
			$("#ro_birthday").val('');
			$("#ro_civil_status").val('');

		},
		error: function(){
			console.log("fail");
			console.log(values);
			$("#membersTable").html(msg);
		}
	});


	});
});
