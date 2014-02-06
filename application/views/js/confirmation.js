$(document).ready(function(){
$('#modalDelete').on('show.bs.modal', function(){
	var id  = $(this).data('id'),
		removeBtn = $(this).find('.danger');
})

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