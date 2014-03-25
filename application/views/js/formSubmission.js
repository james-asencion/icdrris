$(document).ready(function(){

$('.addLivelihoodOrgMembers').on('click', function(e){
	e.preventDefault();
	console.log('clicked');
	var id = $(this).data('org');
	$('#modalAddLivelihoodOrgMembers').data('org',id);
	$('#modalAddLivelihoodOrgMembers').modal('show');
});

$("#addLivelihoodMemberButton").click(function(event)	{
	/* Stop form from submitting normally */
	//event.preventDefault();

	/* get the values from the elements on the page */
	//var values = $("addMemberForm").serialize();
	var org_id = $("#modalAddLivelihoodOrgMembers").data('org');
	var first_name = $("#member_first_name").val();
	var last_name = $("#member_last_name").val();
	var middle_name = $("#member_middle_name").val();
	var sex = $("#member_sex").val();
	var birthday = $("#member_birthday").val();
	var age = $("#member_age").val();
	var monthly_income = $("#member_monthly_income").val();
	var source_of_income = $("#member_source_of_income").val();
	var civil_status = $("#member_civil_status").val();
	var no_of_children = $("#member_no_of_children").val();
	console.log("org id--> "+org_id);
	/* Send the data using post and put results to the members table */
	request = $.ajax({
		url: "http://localhost/icdrris/Livelihood/submitMember",
		type: "POST",
		data: {org_id:org_id, first_name:first_name, last_name:last_name, middle_name:middle_name, sex:sex, birthday:birthday, age:age, monthly_income:monthly_income, source_of_income:source_of_income, civil_status:civil_status, no_of_children:no_of_children},
		success: function(msg){
			//$("membersTable").html(msg);
			console.log("success");
			console.log(msg);
			
			$("#membersTable").html('');
			$("#membersTable").html(msg);
			$('#modalAddLivelihoodOrgMembers').modal('hide');
			$("#member_first_name").val('');
			$("#member_last_name").val('');
			$("#member_middle_name").val('');
			$("#member_sex").val('');
			$("#member_birthday").val('');
			$("#member_age").val('');
			$("#member_monthly_income").val('');
			$("#member_source_of_income").val('');
			$("#member_civil_status").val('');
			$("#member_no_of_children").val('');

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
function loginUser(){

$(document).ready(function(){
/**
    $('.login-btn').on('click', function(e){
            e.preventDefault();
            console.log('clicked');

            $('#modalLogin').modal('show');
    });
*/

    $('.loginForm').submit(function(event){
        // Stop form from submitting normally
        event.preventDefault();
        
        // Get some values from elements on the modal login page:
        var username = $("#username").val();
        var password = $("#password").val();
       // var dataStr = 'username='+username+'&password='+password;

        /* Send the data using post and put results to the members table */
		request = $.ajax({
			url: "http://localhost/icdrris/Login/validate_credentials",
			type: "POST",
			data: {username:username, password:password},
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
}

//EDIT ACCOUNT INFO
$(document).ready(function(){
	$('.editAccountSettings').on('click', function(e){
		e.preventDefault();
		$('#modalAccountSettings').modal('show');
	});
	
	$('#accountSettingsForm').submit(function(event){
        // Stop form from submitting normally
        event.preventDefault();
        console.log("btnYesAcocuntSettings clicked");
		
        // Get some values from elements on the modal:
        var userid  = $('#modalAccountSettings').data('userid');
        var user_firstname = $("#modalAccountSettings #ufirst_name").val();
        var user_lastname = $("#modalAccountSettings #ulast_name").val();
        var email = $("#modalAccountSettings #uemail").val();
        var user_username = $("#modalAccountSettings #uuser_name").val();
		
        var oldpassword = $("#oldpass").val();
        var newpassword = $("#newpass").val();
        var confirmpassword = $("#confirmpass").val();
		
		
		console.log(userid+user_firstname+user_lastname+email+user_username+oldpassword+newpassword+confirmpassword+"end");
		request = $.ajax({
			url: "http://localhost/icdrris/AccountSettings/modifyAccount",
			type: "POST",
			data: {user_id:userid,user_first_name:user_firstname,user_last_name:user_lastname,user_email:email,user_name:user_username, old_password:oldpassword, new_password:newpassword, confirm_password:confirmpassword},
			success: function(msg){
				if(msg == 'success'){
					console.log('naedit na bai. check the database');
					window.location.reload();
				}else{
					console.log('naay mali sa controller or model. recheck the code.')
					$("#modalAccountSettings #message").html(msg);
				}
			},
			error: function(){
				console.log("fail");
				$(".modal-body").html("Sorry, system error.");
				$("#btnYesAccountSettings").hide("fast");
			}
		});
    });
});

//CHANGE PASSWORD BUTTON LINL
function changepassword(){
		console.log('Change Password button clicked.');
		  if ( $( "#oldpass-div" ).is( ":hidden" ) ) {
			$( "#oldpass-div" ).slideDown( "slow" );
			$( "#newpass-div" ).slideDown( "slow" );
			$( "#confirmpass-div" ).slideDown( "slow" );
			$( "#oldpass, #newpass, #confirmpass" ).attr("required","required");
		  } else {
			$( "#oldpass-div, #newpass-div, #confirmpass-div" ).hide();
			$( "#oldpass, #newpass, #confirmpass" ).removeAttr("required","required");
		  }
		  
	
		  
}



//UPDATE INCIDENT
function editIncident(element){
	$('.editinfo-li').on('click', function(e){
		e.preventDefault();
		console.log('edit-incident clicked');
		
		var incidentid = $(this).data('incidentid');
		console.log("incident id here->"+incidentid);
		var incidentreportid = $(this).data('incidentreportid');
		var elementid = $(this).data('elementid');
		
		var incidentdesc = $(this).data('incidentdesc');
		var datedata= $(this).data('incidentdate');
		var dateParse= Date.parse(datedata);
		var dateFormat= new Date(dateParse);

		var monthDate= dateFormat.getMonth() + 1;
		var dayDate= dateFormat.getDate()
		var incidentdate;
		if((dayDate > 9) || (monthDate > 9)){
			if(monthDate > 9){
				var incidentdate = dateFormat.getFullYear()+ '-' +(dateFormat.getMonth() + 1)+ '-0' + dateFormat.getDate();
			}
			if(dayDate > 9){
				var incidentdate = dateFormat.getFullYear()+ '-0' +(dateFormat.getMonth() + 1) + '-' + dateFormat.getDate();
			}
			else{
				var incidentdate = dateFormat.getFullYear()+ '-' +(dateFormat.getMonth() + 1) + '-' + dateFormat.getDate();
			}
		}
		else{
			var incidentdate = dateFormat.getFullYear()+ '-0' +(dateFormat.getMonth() + 1) + '-0' + dateFormat.getDate();
		}
		
		var disaster_type = $(this).data('disaster_type');
		
		$('#modalUpdateIncident').data('incidentid',incidentid);	
		$('#modalUpdateIncident').data('incidentreportid',incidentreportid);
		$('#modalUpdateIncident').data('elementid',elementid);
		
		$('#modalUpdateIncident').data('incidentdesc',incidentdesc);
		$('#modalUpdateIncident').data('incidentdate',incidentdate);
		$('#modalUpdateIncident').data('disaster_type',disaster_type);
		$('#modalUpdateIncident').modal('show');
	});
	
	$('#modalUpdateIncident').on('show.bs.modal', function(){
			var incidentid  = $(this).data('incidentid');
			var incidentreportid  = $(this).data('incidentreportid');
			var elementid  = $(this).data('elementid');
			
			var incidentdesc  = $(this).data('incidentdesc');
			var incidentdate  = $(this).data('incidentdate');
			var disaster_type  = $(this).data('disaster_type');
			
			$("#incident_description").val(incidentdesc);
			$("#date_happened").attr("value", incidentdate);
			var i=0;
			while ((document.updateIncidentForm.disasterType.options[i].val != disaster_type) && (i < document.updateIncidentForm.disasterType.options.length))
			  {i++;}
			if (i < document.updateIncidentForm.disasterType.options.length)
			  {document.updateIncidentForm.disasterType.selectedIndex = i;}
	});
	
	    $('#updateIncidentForm').submit(function(event){
        // Stop form from submitting normally
        event.preventDefault();
        
        // Get some values from elements on the modal:
        var incidentid  = $('#modalUpdateIncident').data('incidentid');
        var elementid  = $('#modalUpdateIncident').data('elementid');
		var incidentreportid  = $('#modalUpdateIncident').data('incidentreportid');
        var incident_description = $("#modalUpdateIncident #incident_description").val();
        var date_happened = $("#modalUpdateIncident #date_happened").val();
        var disasterType = document.updateIncidentForm.disasterType.value;
        console.log("edited description: "+incident_description);
        console.log("edited date: "+date_happened);
        console.log("edited disasterType: "+disasterType);
       
	   
        /* Send the data using post and put results to the members table */
		request = $.ajax({
			url: "http://localhost/icdrris/Incident/updateIncident",
			type: "POST",
			data: {incident_location_id:incidentid, incident_report_id: incidentreportid, incident_description: incident_description, date_happened:date_happened, disaster_type:disasterType},
			success: function(msg){
				if(msg == 'success'){
					console.log('naedit na bai. check the database');
					$('#modalUpdateIncident').modal('hide');
					getAllMapElements();
					displayIncidentDetails(incidentreportid, elementid, incidentid);	
						$("#incident_description").val('');
						$("#date_happened").attr("value", '');
						document.updateIncidentForm.disasterType.selectedIndex = 0;
						
				}else{
					console.log('naay mali sa controller or model. recheck the code.')
					$(".modal-body").html(msg);
				}
			},
			error: function(){
				console.log("fail");
				$(".modal-body").html("Sorry, system error.");
			}
		});
    });
	
}
// -end of UPDATE INCIDENT


//UPDATE INCIDENT STATISTICS
function modifyIncidentStat(element){
	$('#incident-stat').on('click', function(e){
		e.preventDefault();
		
		var incidentid = $("#incident-stat").data('incidentid');
		var incidentreportid = $("#incident-stat").data('incidentreportid');
		var elementid = $("#incident-stat").data('elementid');
		
		console.log(incidentid+" "+incidentreportid+" "+elementid);
		var deaths = $("#incident-stat").data('deaths');
		var families_affected = $("#incident-stat").data('familiesaffected');
		var people_missing = $("#incident-stat").data('peoplemissing');
		var houses_destroyed = $("#incident-stat").data('housesdestroyed');
		var injured = $("#incident-stat").data('injured');
		var damaged_cost = $("#incident-stat").data('damagecost');
		var info_source = $("#incident-stat").data('infosource');
		
		$('#modalUpdateIncidentStat').data('incidentid',incidentid);
		console.log("incident id : "+incidentid);
		$('#modalUpdateIncidentStat').data('incidentreportid',incidentreportid);
		console.log("incident report id : "+incidentreportid);
		$('#modalUpdateIncidentStat').data('deaths',deaths);
		$('#modalUpdateIncidentStat').data('familiesaffected',families_affected);
		$('#modalUpdateIncidentStat').data('peoplemissing',people_missing);
		$('#modalUpdateIncidentStat').data('housesdestroyed',houses_destroyed);
		$('#modalUpdateIncidentStat').data('injured',injured);
		$('#modalUpdateIncidentStat').data('damagecost',damaged_cost);
		$('#modalUpdateIncidentStat').data('infosource',info_source);
		$('#modalUpdateIncidentStat').modal('show');
	});
	
	$('#modalUpdateIncidentStat').on('show.bs.modal', function(){
	
		// Get all data from modalUpdateIncidentStat
			var incident_id  = $(this).data('incidentid');
			var deaths  = $(this).data('deaths');
			var families_affected  = $(this).data('familiesaffected');
			var people_missing  = $(this).data('peoplemissing');
			var houses_destroyed  = $(this).data('housesdestroyed');
			var injured  = $(this).data('injured');
			var damaged_cost  = $(this).data('damagecost');
			var info_source  = $(this).data('infosource');
			
		// Set up all value of the textfields
			$("#death").val(deaths);
			$("#families_affected").val(families_affected);
			$("#missing").val(people_missing);
			$("#houses_destroyed").val(houses_destroyed);
			$("#injured").val(injured);
			$("#damage_costs").val(damaged_cost);
			$("#source").val(info_source);

			
	});
	
	    $('#updateStatisticsForm').submit(function(event){
        // Stop form from submitting normally
        event.preventDefault();
		console.log("Submit updatestatisticsform");
        
        // Get some values from elements on the modal:
        var incidentid  = $('#modalUpdateIncidentStat').data('incidentid');
        var elementid  = $('#modalUpdateIncidentStat').data('elementid');
        var incidentreportid  = $('#modalUpdateIncidentStat').data('incidentreportid');
        var death = $("#modalUpdateIncidentStat #death").val();
        var families_affected = $("#modalUpdateIncidentStat #families_affected").val();
        var missing = $("#modalUpdateIncidentStat #missing").val();
        var houses_destroyed = $("#modalUpdateIncidentStat #houses_destroyed").val();
        var injured = $("#modalUpdateIncidentStat #injured").val();
        var damage_costs = $("#modalUpdateIncidentStat #damage_costs").val();
        var source = $("#modalUpdateIncidentStat #source").val();
		console.log("submit: "+incidentid+" "+elementid+" "+incidentreportid);
        /* Send the data using post and put results to the members table */
	request = $.ajax({
			url: "http://localhost/icdrris/Incident/updateIncidentStatistics",
			type: "POST",
			data: {incident_location_id:incidentid,
					death_toll:death,
					no_of_families_affected: families_affected,
					no_of_people_missing: missing,
					no_of_houses_destroyed: houses_destroyed,
					no_of_injuries: injured,
					estimated_damage_cost: damage_costs,
					incident_info_source: source
				   },
			success: function(msg){
				if(msg == 'success'){
					console.log('naedit na bai. check the database');
					$('#modalUpdateIncidentStat').modal('hide');
					//console.log("displayIncidentDetails("+incidentreportid+ " "+elementid +" " +incidentid+"");
					displayIncidentDetails(incidentreportid, elementid, incidentid);	
					
				}else{
					console.log('naay mali sa controller or model. recheck the code.')
					$(".modal-body").html(msg);
				}
			},
			error: function(){
				console.log("fail");
				$(".modal-body").html("Sorry, system error.");
			}
		});
    });
	
}
// -end of UPDATE INCIDENT STATISTICS


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
		var address = $(this).data('addressvictim');
		var victimstatus = $(this).data('victimstatus');
		console.log('update victim: '+ incidentid + ' ' + victimid + ' '+ firstname+ ' '+ middlename+ ' '+ lastname+ ' '+ address+ ' '+ victimstatus);
		$('#modalUpdateVictim').data('incidentid',incidentid);	//for AND query
		$('#modalUpdateVictim').data('victimid',victimid);	//for AND query
		$('#modalUpdateVictim').data('firstname',firstname);	//for AND query
		$('#modalUpdateVictim').data('middlename',middlename);	//for AND query
		$('#modalUpdateVictim').data('lastname',lastname);	//for AND query
		$('#modalUpdateVictim').data('addressvictim',address);	//for AND query
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
			var address  = $(this).data('addressvictim');
			console.log("#modalUpdateVictim #addressvictim: " + address);
			var victimstatus  = $(this).data('victimstatus');
			$("#modalUpdateVictim #first_name").attr("value", firstname);
			$("#modalUpdateVictim #middle_name").attr("value", middlename);
			$("#modalUpdateVictim #last_name").attr("value", lastname);
			$("#modalUpdateVictim #addressvictim").attr("value", address);
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
        
        // Get some values from elements on the modal:
        var incidentid  = $('#modalUpdateVictim').data('incidentid');
		var victimid  = $('#modalUpdateVictim').data('victimid');
        var firstname = $("#modalUpdateVictim #first_name").val();
        var middlename = $("#modalUpdateVictim #middle_name").val();
        var lastname = $("#modalUpdateVictim #last_name").val();
        var address = $("#modalUpdateVictim #addressvictim").val();
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
					victimsTab();
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
	
}

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
			 $("#first_name").val('');
			$("#middle_name").val('');
			$("#last_name").val('');
			$("#addressvictim").val('');
			document.updateVictimForm.victim_status.selectedIndex = 0;
			
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
        var address = $("#addressvictim").val();
        var victimstatus = document.reportVictimForm.victim_status.value;
		console.log(victimstatus);
        //var dataStr = 'reportNo='+incidentid+'&first_name='+firstname+'&middle_name='+middlename+'&last_name='+lastname+'&address='+address+'&victim_status='+victimstatus;
		//console.log(dataStr);
        /* Send the data using post and put results to the members table */
		request = $.ajax({
			url: "http://localhost/icdrris/Victim/validate",
			type: "POST",
			data: {reportNo:incidentid, first_name:firstname, middle_name:middlename, last_name:lastname,address:address, victim_status:victimstatus},
			success: function(msg){
				console.log("success");
				console.log(msg);
				if(msg == 'success'){
					console.log('naadd na bai. check the database');
					$('#modalReportVictim').modal('hide');
					victimsTab();
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
	//var dataStr = 'org_id='+org_id+'&first_name='+first_name+'&last_name='+last_name+'&sex='+sex+'&birthday='+birthday+'&civil_status='+civil_status;

	/* Send the data using post and put results to the members table */
	request = $.ajax({
		url: "http://localhost/icdrris/ResponseOrg/submitMember",
		type: "POST",
		data: {org_id:org_id, first_name:first_name, last_name:last_name, sex:sex, birthday:birthday, civil_status:civil_status},
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

$("#addMemberButton2").click(function(event)	{
	/* Stop form from submitting normally */
	//event.preventDefault();
	console.log("addMemberButton2.click()");
	/* get the values from the elements on the page */
	//var values = $("addMemberForm").serialize();

	var skillsArray = new Array();
	var checkbox = $('#skillsList input:checkbox');

	$.each(checkbox, function(i,b){
		($(b).is(':checked'))?skillsArray.push($(b).data('id')):console.log('not checked');
	});

	var skills = JSON.stringify(skillsArray);
	var org_id = $(this).data('org');
	var first_name = $("#ro_first_name").val();
	var last_name = $("#ro_last_name").val();
	var sex = $("#ro_sex").val();
	var birthday = $("#ro_birthday").val();
	var civil_status = $("#ro_civil_status").val();

	//var dataStr = 'org_id='+org_id+'&first_name='+first_name+'&last_name='+last_name+'&sex='+sex+'&birthday='+birthday+'&civil_status='+civil_status;
	 
	/* Send the data using post and put results to the members table */
	request = $.ajax({
		url: "http://localhost/icdrris/ResponseOrg/addResOrgMemberModal",
		type: "POST",
		data: {skill:skills, org_id:org_id, first_name:first_name, last_name:last_name, sex:sex, birthday:birthday, civil_status:civil_status},
		success: function(msg){
			//$("membersTable").html(msg);
			console.log("success");
			console.log(msg);
			
			$("#members").html('');
			$("#members").html(msg);
			$("#ro_first_name").val('');
			$("#ro_last_name").val('');
			$("#ro_sex").val('');
			$("#ro_birthday").val('');
			$("#ro_civil_status").val('');
			$("#modalAddResOrgMembers").modal('hide');


		},
		error: function(){
			console.log("fail");
			console.log(values);
			$("#members").html(msg);
		}
	});
});

	$("#addResOrgButton1").click(function(event)	{
	/* Stop form from submitting normally */
	//event.preventDefault();
	console.log("addResOrgButton1.click()");
	/* get the values from the elements on the page */
	//var values = $("addMemberForm").serialize();
	//var org_id = $("#ro_org_id").val();
	var ro_name = $("#ro_name").val();
	var ro_phone_num = $("#ro_phone_num").val();
	var ro_email = $("#ro_email").val();
	var ro_address = $("#ro_address").val();
	var ro_contact_person = $("#ro_contact_person").val();
	var ro_members_count = $("#ro_members_count").val();
	var ro_members_available = $("#ro_members_available").val();
	var dataStr = 'ro_name='+ro_name+'&ro_phone_num='+ro_phone_num+'&ro_email='+ro_email+'&ro_address='+ro_address+'&ro_contact_person='+ro_contact_person+'&ro_members_count='+ro_members_count+'&ro_members_available='+ro_members_available;

	/* Send the data using post and put results to the members table */
	request = $.ajax({
		url: "http://localhost/icdrris/ResponseOrg/addResponseOrgModal",
		type: "POST",
		data: dataStr,
		success: function(msg){
			//$("membersTable").html(msg);
			console.log(msg);
			
			$("#members1").html('');
			$("#members1").html(msg);
			$("#ro_name").val('');
			$("#ro_phone_num").val('');
			$("#ro_email").val('');
			$("#ro_address").val('');
			$("#ro_contact_person").val('');
			$("#ro_members_count").val('');
			$("#ro_members_available").val('');
			$("#modalAddResOrg").modal('hide');

		},
		error: function(){
			console.log("fail");
			console.log(values);
			$("#members1").html(msg);
		}
	});

	});
});

