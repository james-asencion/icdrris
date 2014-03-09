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
var opened_info = new google.maps.InfoWindow();
var vertices;
$(document).ready(function(){
    initialize();
    $('#polygonInstructionModal').modal('show');
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
    //directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById("directionsPanel"));

    shape = new google.maps.Polygon({
        strokeColor: '#ff0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#ff0000',
        fillOpacity: 0.35
    });

    var clearButton = document.createElement('clearButton');
    clearButton.innerHTML = "<button type='button' onclick='clearPolygon()' class='btn btn-default'><i class='icon-repeat'></i>Clear Selection</button>&nbsp;&nbsp;<button type='button' onclick='cancelReport()' class='btn btn-danger'><i class='icon-repeat'></i>Cancel</button>";
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(clearButton);

    var html = "<table>" +
            "<tr><td>Disaster Description:</td> <td><input type='text' id='description'/></td> </tr>" +
            "<tr><td>Disaster Type:</td> <td><select id='disasterType'>" +
            "<option value='' SELECTED></option>" +
            "<option value=Flashflood >Flash Flood</option>" +
            "<option value=Tsunami>Tsunami</option>" +
            "<option value=Landslide>Landslide</option>" +
            "<option value=Mudslide>Mudslide</option>" +
            "<option value=Infrastructure Damage>Infrastructure Damage</option>" +
            "</select> </td></tr>" +
            "<tr><td>Date:</td> <td><input type='date' id='date'/></td> </tr>" +
            "<tr><td>Deaths:</td> <td><input type='number' min='0' id='death'/></td> </tr>" +
            "<tr><td>Injured:</td> <td><input type='number' min='0' id='injured'/></td> </tr>" +
            "<tr><td>Missing:</td> <td><input type='number' min='0' id='missing'/></td> </tr>" +
            "<tr><td>Families Affected:</td> <td><input type='number' min='0' id='familiesAffected'/></td> </tr>" +
            "<tr><td>Houses Destroyed:</td> <td><input type='number' min='0' id='housesDestroyed'/></td> </tr>" +
            "<tr><td>Damage Cost:</td> <td><input type='number' min='0' id='damageCost'/></td> </tr>" +
            "<tr><td>Source:</td> <td><input type='text' id='source'/></td> </tr>" +
            "<tr><td></td><td><input type='button' class='btn btn-success' value='Report Incident' onclick='savePolygonData()'/></td></tr>";

    shape.infowindow = new google.maps.InfoWindow(
            {
                content: html
            });
    shape.setMap(map);

    google.maps.event.addListener(shape, 'click', showInfo);
    console.log("here");
    google.maps.event.addListener(map, 'click', addPoint);
    console.log("here");

}
function addPoint(e) {
    vertices = shape.getPath();
    console.log("here");
    vertices.push(e.latLng);
}
function clearPolygon(){
    alert('clear Polygon button clicked');
    vertices=[];
    initialize();
}
function cancelReport(){
    window.location.replace("http://localhost/icdrris");
}
function showInfo(event) {
    opened_info.close();
    //if (opened_info.name !== this.infowindow.name) {
        this.infowindow.setPosition(event.latLng);
        this.infowindow.open(map);
        opened_info = this.infowindow;
    //}
}
function savePolygonData(){
    var polyString = "";
    var start = "";
    
    console.log(vertices.length);
    start = vertices.pop().toString();
    start = start.replace(/[()]/g,'');
    start = start.replace(/[,]/g,' ');
    while(vertices.length>0){
        polyString = polyString+vertices.pop().toString();
    }
    polyString = polyString.replace(/[(]/g,'');
    polyString = polyString.replace(/[,]/g,'');
    polyString = polyString.replace(/[)]/g,',');
    polyString = ("POLYGON(("+start+","+polyString+start+"))");
    console.log(polyString);

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
    
    $.ajax({
        url: "http://localhost/icdrris/Incident/savePolygon",
        type: "POST",
        data: {description:description, disaster_type:disasterType, date:date, deaths:deaths, injured:injured, missing:missing, families_affected:familiesAffected, houses_destroyed:housesDestroyed, damage_cost:damageCost, source:source, polygon:polyString},
        success: function(msg){
            if(msg==='success'){
                $('#modalSuccessReportPolygon').modal('show');
            }
                
        },
        error: function(msg){
            $('#errorIncidentReport').modal('show'); 
        }

    });
}