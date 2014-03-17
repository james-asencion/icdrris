$(document).ready(function(){

$(".btnSubmitNewBarangayResource").click(function(){
	//alert("button clicked!");
	var resource_id = $("#resource_id").val();
	var description = $("#barangay_resource_description").val();
	var quantity = $("#barangay_resource_quantity").val();
	var location_id = $(this).data('id');

	request = $.ajax({
		url: "http://localhost/icdrris/Livelihood/addBarangayResource",
		type: "POST",
		data: {resource_id:resource_id, location_id:location_id, quantity:quantity, description:description},
		success: function(msg){
			console.log("new barangay resource successfully saved");
			$("#resource_id").val('');
				$("#barangay_resource_description").val('');
				$("#barangay_resource_quantity").val('');
			if(resource_id==1){
				//alert("1");
				//alert(msg);
				$("#physicalResources").html(msg);
			}else if(resource_id==2){
				//alert("2");
				$("#naturalResources").html(msg);
			}else if(resource_id==3){
				//alert("3");
				$("#humanResources").html(msg);
			}else if(resource_id==4){
				//alert("4");
				$("#socialResources").html(msg);
			}else{
				//alert("5");
				$("#financialResources").html(msg);
			}
		},
		error: function(){
			alert("new resource failed");
			alert(msg);
		}
	});		
});

})