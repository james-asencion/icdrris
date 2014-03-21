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
    $('#markerInstructionModal').modal('show');
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
    clearButton.innerHTML = "<button type='button' onclick='cancelReport()' class='btn btn-danger'><i class='icon-repeat'></i>Cancel</button>";
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(clearButton);

    var html = "<form id='reportIncidentForm' method='POST' action='javascript:saveMarkerData()'><table>" +
            "<tr><td>Disaster Description:</td> <td><input type='text' id='description' placeholder='Short/Long Report Description' required='required' /></td> </tr>" +
            "<tr><td>Disaster Type:</td> <td><select id='disasterType' required ='required'>" +
            "<option value='' SELECTED></option>" +
            "<option value='Flashflood'>Flash Flood</option>" +
            "<option value='Tsunami'>Tsunami</option>" +
            "<option value='Landslide'>Landslide</option>" +
            "<option value='Mudslide'>Mudslide</option>" +
            "</select> </td></tr>" +
            "<tr><td>Date:</td> <td><input type='date' id='date' min='01/01/1900' required='required'/></td> </tr>" +
			"<tr><td>Deaths:</td> <td><input type='number' min='0' id='death'/></td> </tr>" +
            "<tr><td>Injured:</td> <td><input type='number' min='0' id='injured'/></td> </tr>" +
            "<tr><td>Missing:</td> <td><input type='number' min='0' id='missing'/></td> </tr>" +
            "<tr><td>Families Affected:</td> <td><input type='number' min='0' id='familiesAffected'/></td> </tr>" +
            "<tr><td>Houses Destroyed:</td> <td><input type='number' min='0' id='housesDestroyed'/></td> </tr>" +
            "<tr><td>Damage Cost:</td> <td><input type='number' min='0' id='damageCost'/></td> </tr>" +
			"<tr><td>Source:</td> <td><input type='text' id='source' placeholder='Name of the Information Source' required='required' /></td> </tr>" +
          //  "<tr><td></td><td><input type='submit' class='btn btn-success' value='Report Incident' onclick='saveMarkerData()'/></td></tr></form>";
           "<tr><td></td><td><input type='submit' class='btn btn-success' value='Report Incident'/></td></tr></form>";
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

function saveMarkerData() {
   $('#reportIncidentForm').submit(function(event){
    var description = $("#description").val();
    var  disasterType= $("#disasterType").val();
    var  date= $("#date").val();
    var  deaths= $("#death").val();
    var  injured= $("#injured").val();
    var  missing= $("#missing").val();
    var  familiesAffected= $("#familiesAffected").val();
    var  housesDestroyed= $("#housesDestroyed").val();
    var  damageCost= $("#damageCost").val();
    var  source= $("#source").val();
    var latlng = marker.getPosition();

    $.ajax({
        url: "http://localhost/icdrris/Incident/saveMarker",
        type: "POST",
        data: {description:description, disaster_type:disasterType, date:date, deaths:deaths, injured:injured, missing:missing, families_affected:familiesAffected, houses_destroyed:housesDestroyed, damage_cost:damageCost, source:source, lat:latlng.lat(), lng:latlng.lng()},
        success: function(msg){
            if(msg==='success'){
               // alert("succes");
                $('#modalSuccessReportMarker').modal('show');
            }
                
        },
        error: function(msg){
            $('#errorIncidentReport').modal('show'); 
        }

		});
	});
}
function cancelReport(){
    window.location.replace("http://localhost/icdrris");
}
