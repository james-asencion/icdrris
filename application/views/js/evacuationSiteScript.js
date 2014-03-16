/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */
var marker;
var infowindow;
var directionDisplay;
var shape;
var map;
$(document).ready(function(){
    initialize();
    $('#evacuationSiteRegistrationInstruction').modal('show');
});
function initialize() {

    var latlng = new google.maps.LatLng(8.228021, 124.245242);
    directionsDisplay = new google.maps.DirectionsRenderer();
    var myOptions = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setPanel(document.getElementById("directionsPanel"));

    var clearButton = document.createElement('clearButton');
    clearButton.innerHTML = "<button type='button' onclick='cancelRegistration()' class='btn btn-danger'><i class='icon-repeat'></i>Cancel</button>";
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(clearButton);

    var html = "<table>" +
            "<tr><td>Evacuation Site Name:</td> <td><input type='text' id='evacuation_site_name'/></td> </tr>" +
            "<tr><td>Maximum Capacity:</td> <td><input type='number' min='0' id='site_maximum_capacity'/></td> </tr>" +
            "<tr><td>Evacuation Site Status:</td> <td><select id='evacuation_site_status'>" +
            "<option value='' SELECTED></option>" +
            "<option value=available>Available</option>" +
            "<option value=under construction>Under Construction</option>" +
            "</select> </td></tr>" +
            "<tr><td></td><td><input type='button' class='btn btn-success' value='Map Evacuation Site' onclick='saveEvacuationSiteData()'/></td></tr>";
/**
    shape.infowindow = new google.maps.InfoWindow(
            {
                content: html
            });
    shape.infowindow.name = c;
    shape.setMap(map);

    google.maps.event.addListener(shape, 'click', showInfo);
    google.maps.event.addListener(map, 'click', addPoint);



*/
    infowindow = new google.maps.InfoWindow({
        content: html
    });

    google.maps.event.addListener(map, "click", function(event) {
        if (marker){
            marker.setPosition(event.latLng);
            infowindow.close(map, marker);
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
        google.maps.event.addListener(marker, "click", function() {
            infowindow.open(map, marker);
        });
    });
}

function saveEvacuationSiteData() {
   
    var evacuation_site_name = $("#evacuation_site_name").val();
    var site_maximum_capacity= $("#site_maximum_capacity").val();
    var evacuation_site_status= $("#evacuation_site_status").val();
    var latlng = marker.getPosition();

    $.ajax({
        url: "http://localhost/icdrris/Evacuation/saveEvacuationSite",
        type: "POST",
        data: {evacuation_site_name:evacuation_site_name, site_maximum_capacity:site_maximum_capacity, evacuation_site_status:evacuation_site_status,lat:latlng.lat(), lng:latlng.lng()},
        success: function(msg){
            if(msg==='success'){
               // alert("succes");
                $('#successEvacuationSiteRegistration').modal('show');
            }
                
        },
        error: function(msg){
            $('#errorEvacuationSiteRegistration').modal('show'); 
        }

    });
}
function cancelRegistration(){
    window.location.replace("http://localhost/icdrris");
}
