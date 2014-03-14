

$(document).ready(function(){
	var count = -1;

	setInterval(function(){    
	    $.ajax({
		    url: "http://localhost/icdrris/Incident/getIncidentCount",
		    type: "POST",
		    success: function(data) {
		    		//console.log("monitor invoked");
		            if (count != -1 && count != data){
		            	playWarningSound();
		            	console.log("new entry detected");
					}
					else{
						
						console.log("cool, nothing new");
					}
					count = data;
		    }
	    });
	},5000);
});

function countInitial(){
	//alert("function called inside document ready!");
	$.ajax({
		    url: "http://localhost/icdrris/Incident/getIncidentCount",
		    type: "POST",
		    success: function(data) {
		            return data;
		        }
	});
}
function playWarningSound(){
	$('#siren')[0].play();
	setTimeout( function(){ 
    $('#siren')[0].pause(); 
  	}, 3000 );
}

// request = $.ajax({
//         url: "http://localhost/icdrris/Request/getRequestHeader",
//         type: "POST",
//         data: {id:request_id},
//         success: function(header) {
//                 $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + header + '</a></li>');
//                 $("#requestTabbable").show("slow");
//         },
//         error: function(header) {
//             console.log("error retrieving request details");
//             console.log(header);
//         }
//     });