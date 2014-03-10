var map;
var marker;
function initializeMap3() {
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

        var parentDiv = document.createElement('parentDiv');
        //parentDiv.innerHTML = "";
        var controlDiv = document.createElement('ourDiv');

        //controlDiv.innerHTML = "<legend>Map Livelihood Organization</legend><label>Date Start</label><input id='startDate' type='date' class = 'span12'><br><label>Date End</label><input type='date' id='endDate' class = 'span12'><br><label>Activity Description</label><input type='text' class = 'span12' placeholder='Type something..' id='activity_description'><br><div id='deployMembersList'></div></label></div>";
        

        controlDiv.innerHTML = "<h4 class='text-center'>Register Livelihood Organization</h4>"+
        "<label>Livelihood Organization Name:</label><input type='text' name='name' id='name' required/>"+
        "<label>Address:</label><input type='text' name='address' id='address' required/>"+
        "<label>Number of members:</label><input type='number' min='0' name='members' id='members'/>"+
        "<label>Initial Income:</label><input type='number' min='0' name='initial_income' id='initial_income' />"+
        "<label>Status:</label><select name='status' id='status'><option value=''> -Select- </option><option value='active'>Active</option><option value='inactive'>Inactive</option></select>"+
        "<label>Date Formed:</label><input type='date' name='date_formed' id='date_formed' required/>"+
        "<label>Business Activity Type:</label><input type='text' name='business_type' id='business_type' required/><br>";
        controlDiv.id = "controls";
        var submitButton = document.createElement('ourButton');
        submitButton.innerHTML = "<button type='submit' class='btn btn-success'>Register Now</button>";


    

        // Append everything to the wrapper div
        //controlDiv.appendChild(controlLabel);
        controlDiv.appendChild(submitButton);
        controlDiv.className= "well";

    var onClick = function() {
        console.log("on click function invoked");
    

    var name = $("#name").val();
    var address = $("#address").val();
    var members = $("#members").val();
    var initial_income = $("#initial_income").val();
    var status = $("#status").val();
    var date_formed = $("#date_formed").val();
    var business_type = $("#business_type").val();
    var position = marker.getPosition();
    var lat = position.lat();
    var lng = position.lng();

    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/addLivelihoodOrg",
        type: "POST",
        data: {name:name, address:address, members:members, initial_income:initial_income , status:status , date_formed:date_formed , business_type:business_type , lat:lat, lng:lng },
        success: function(msg){
            alert("deployment success!");
        },
        error: function(){
            console.log("fail");
        }
    });

    }
    google.maps.event.addDomListener(submitButton, 'click', onClick);
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);
}
      
