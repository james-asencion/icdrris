$(document).ready(function(){

$('.addExternalOrg').on('click', function(e){
	e.preventDefault();
	console.log('clicked');
	var id = $(this).data('id');
	$('#modalAddExternalOrg').data('id',id);
	$('#modalAddExternalOrg .modal-body').html("<h1 class=\"text-center\">Register External Organization</h1><label for=\"agency_name\"><div class=\"span2\"></div>Agency Name: </label><div class=\"span2\"></div><input type=\"text\" name=\"agency_name\" id=\"agency_name\" /><div id=\"agency_name_verify\" class=\"verify\"></div><label for=\"agency_address\"><div class=\"span2\"></div>Agency Address: </label><div class=\"span2\"></div><input type=\"text\" name=\"agency_address\" id=\"agency_address\" /><span id=\"agency_address_verify\" class=\"verify\"></span><label for=\"contact_number\"><div class=\"span2\"></div>Contact Details(Contact Number): </label><div class=\"span2\"></div><input type=\"text\" name=\"contact_number\" id=\"contact_number\" /><span id=\"contact_number_verify\" class=\"verify\"></span><br><br>");
	$('#modalAddExternalOrg').modal('show');
});

$('#modalAddExternalOrg').on('show.bs.modal', function(){
	var id  = $(this).data('id'),
		removeBtn = $(this).find('.danger');
});

$('#btnSubmit').click(function(){

	var id = $('#modalAddExternalOrg').data('id');
	console.log('this is the id->'+id);
	var agency_name = $('#agency_name').val();
	console.log(agency_name);
	var agency_address = $('#agency_address').val();
	console.log(agency_address);
	var contact_number = $('#contact_number').val();
	console.log(contact_number);
	var dataStr = 'program_id='+id+'&agency_name='+agency_name+'&agency_address='+agency_address+'&contact_number='+contact_number;
	console.log(dataStr);
	$.ajax({
		url: "http://localhost/icdrris/Livelihood/addTagExternalOrganization",
		type: "POST",
		data: dataStr,
		success: function(msg){
			$('#externalOrganizationsTable').html(msg);
			$('#modalAddExternalOrg').modal('hide');

		},
		error: function(msg){
			console.log("something went wrong");
			$('#modalAddExternalOrg .modal-body').html("oopss something went wrong");
      
			$('#modalAddExternalOrg').modal('show');
		}

	});
});


//<label class='checkbox'><input type='checkbox'> Check me out<br><input type='checkbox'> Check me out<br><input type='checkbox'> Check me out<br><input type='checkbox'> Check me out<br></label>
$('.chooseFromExistingOrg').on('click', function(e){
	e.preventDefault();
	console.log('clicked');
	var id = $(this).data('id');
	$('#modalChooseFromExistingOrg').data('id',id);
	//$('#modalChooseFromExistingOrg .modal-body').html("");
	$('#modalChooseFromExistingOrg').modal('show');
});

$('#modalChooseFromExistingOrg').on('show.bs.modal', function(){
	var id  = $(this).data('id'),
		removeBtn = $(this).find('.danger');
});

// $('#btnConfirmSelected').click(function(){

// 	var id = $('#modalChooseFromExistingOrg').data('id');
// 	console.log('this is the id->'+id);
// 	var agency_name = $('#agency_name').val();
// 	console.log(agency_name);
// 	var agency_address = $('#agency_address').val();
// 	console.log(agency_address);
// 	var contact_number = $('#contact_number').val();
// 	console.log(contact_number);
// 	var dataStr = 'program_id='+id+'&agency_name='+agency_name+'&agency_address='+agency_address+'&contact_number='+contact_number;
// 	console.log(dataStr);
// 	$.ajax({
// 		url: "http://localhost/icdrris/Livelihood/addTagExternalOrganization",
// 		type: "POST",
// 		data: dataStr,
// 		success: function(msg){
// 			$('#externalOrganizationsTable').html(msg);
// 			$('#modalAddExternalOrg').modal('hide');

// 		},
// 		error: function(msg){
// 			console.log("something went wrong");
// 			$('#modalChooseFromExistingOrg .modal-body').html("oopss something went wrong");
      
// 			$('#modalChooseFromExistingOrg').modal('show');
// 		}

// 	});
// });

$('#btnConfirmSelected').click(function(){

	var id = $('#modalChooseFromExistingOrg').data('id');
	var testArray = new Array();
	var boxes = $('#externalOrgsBoxes input:checkbox');
         $.each(boxes, function(i,b){
             ($(b).is(':checked'))?testArray.push($(b).data('id')):console.log('');
    });

	var jsonString = JSON.stringify(testArray);
	
	$.ajax({
		url: "http://localhost/icdrris/Livelihood/tagExternalOrganizations",
		type: "POST",
		data: {testData:jsonString, programId:id},
		success: function(msg){
			$('#externalOrganizationsTable').html(msg);
			$('#modalChooseFromExistingOrg').modal('hide');
			//alert(msg);

		},
		error: function(msg){
			alert(msg);
		}

	});


});


});




    