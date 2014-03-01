var map;
var marker;
function initializeMap2() {
    console.log("initialize map 2 invoked");
    var latlng = new google.maps.LatLng(8.228021, 124.245242);
    directionsDisplay = new google.maps.DirectionsRenderer();
    var myOptions = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false

    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    
    //directionsDisplay.setMap(map);
    //directionsDisplay.setPanel(document.getElementById("directionsPanel"));


    google.maps.event.addListener(map, "click", function(event) {
        // marker = new google.maps.Marker({
        //     position: event.latLng,
        //     map: map,
        //     draggable: true
        // });
        //displayMarker(marker, map, event.LatLng);
        if (marker){
            marker.setPosition(event.latLng);
            console.log('inside if');
        }else{
            marker = new google.maps.Marker({
                position: event.latLng,
                map: map,
                draggable: true
            });
            //marker.setMap(map);
            console.log('inside else');
        }
    });

    
    var urlString = window.location.pathname.split('/');
    alert(urlString[4]);
    var str ="";
    testAjax(function(data){

        var parentDiv = document.createElement('parentDiv');
        //parentDiv.innerHTML = "";
        var controlDiv = document.createElement('ourDiv');

        controlDiv.innerHTML = "<legend>Deploy Response Organization</legend><label>Date Start</label><input id='startDate' type='date' class = 'span12'><br><label>Date End</label><input type='date' id='endDate' class = 'span12'><br><label>Activity Description</label><input type='text' class = 'span12' placeholder='Type something..' id='activity_description'><br><div id='deployMembersList'>"+data+"</div></label></div>";
        controlDiv.id = "controls";

        var submitButton = document.createElement('ourButton');
        submitButton.innerHTML = "<button type='submit' class='btn btn-success'>Submit</button>";


    

        // Append everything to the wrapper div
        //controlDiv.appendChild(controlLabel);
        controlDiv.appendChild(submitButton);
        controlDiv.className= "well";

    var onClick = function() {

        var deployedMembersArray = new Array();

        var boxes = $('#deployMembersList input:checkbox');
        
        $.each(boxes, function(i,b){
            ($(b).is(':checked'))?deployedMembersArray.push($(b).data('id')):console.log('not checked');
        });

        var membersSelected = JSON.stringify(deployedMembersArray);
        var url_org_id = urlString[4];
        var locationId = '1';
        var activityDescription = $("#activity_description").val();
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        var position = marker.getPosition();
        var lat = position.lat();
        var lng = position.lng();

        alert("lat ->"+lat+"  lng ->"+lng+" start date->"+startDate+"  end date->"+endDate+"  Description->"+activityDescription);
    request = $.ajax({
        url: "http://localhost/icdrris/ResponseOrg/deployMembers",
        type: "POST",
        data: {membersToDeploy:membersSelected, org_id:url_org_id, location_id:locationId, response_activity_description:activityDescription , activity_start_date:startDate , activity_end_date:endDate , deployment_lat:lat , deployment_lng:lng },
        success: function(msg){
            $("#deployMembersList").innerHTML = msg;
            console.log("deployment success!");
        },
        error: function(){
            console.log("fail");
            console.log(msg);
        }
    });


    };

    google.maps.event.addDomListener(submitButton, 'click', onClick);
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);
    
    });  
    
}  



function testAjax(handleData) {
    $.ajax({
        url: "http://localhost/icdrris/ResponseOrg/getAllResOrgCheckboxList",
        type: "POST",
        data: {org_id:2},
        success: function(data) {
            handleData(data); 
        },
        error: function(){
            console.log("fail");
            console.log(msg);
            handleData("an error has occured");
        }
    });
}
