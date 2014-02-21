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
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    //directionsDisplay.setMap(map);
    //directionsDisplay.setPanel(document.getElementById("directionsPanel"));

    var parentDiv = document.createElement('parentDiv');
    //parentDiv.innerHTML = "";
    var controlDiv = document.createElement('ourDiv');
    controlDiv.innerHTML = "<legend>Deploy Livelihood Organization</legend><label>Date Start</label><input type='date' class = 'span12'><br><label>Date End</label><input type='date' class = 'span12'><br><label>Activity Description</label><input type='text' class = 'span12' placeholder='Type something..' id='activity_description'><br><label>Livelihood Organization Members Available</label><label class='checkbox'><input type='checkbox'> Check me out<br><input type='checkbox'> Check me out<br><input type='checkbox'> Check me out<br><input type='checkbox'> Check me out<br></label>";
    controlDiv.id = "controls";

    var submitButton = document.createElement('ourButton');
    submitButton.innerHTML = "<button type='submit' class='btn btn-success'>Submit</button>";

    

    // Append everything to the wrapper div
    //controlDiv.appendChild(controlLabel);
    controlDiv.appendChild(submitButton);
    controlDiv.className= "well";

    var onClick = function() {
        var inputvalue = $("#activity_description").val();
        alert("You entered this disaster description: '" + inputvalue + "', map center is at " + map.getCenter());
    };
    google.maps.event.addDomListener(submitButton, 'click', onClick);
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);
    
}  
