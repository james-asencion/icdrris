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



    var c = "james";
    var html = "<table>" +
            "<tr><td>Disaster Description:</td> <td><input type='text' id='description'/></td> </tr>" +
            "<tr><td>Disaster Type:</td> <td><select id='disasterType'>" +
            "<option value=Flash Flood SELECTED>Flash Flood</option>" +
            "<option value=Landslide>Landslide</option>" +
            "<option value=Storm Surge>Storm Surge</option>" +
            "</select> </td></tr>" +
            "<tr><td>Date:</td> <td><input type='date' id='date'/></td> </tr>" +
            "<tr><td>Deaths:</td> <td><input type='text' id='death'/></td> </tr>" +
            "<tr><td>Injured:</td> <td><input type='text' id='injured'/></td> </tr>" +
            "<tr><td>Missing:</td> <td><input type='text' id='missing'/></td> </tr>" +
            "<tr><td>Families Affected:</td> <td><input type='text' id='familiesAffected'/></td> </tr>" +
            "<tr><td>Houses Destroyed:</td> <td><input type='text' id='housesDestroyed'/></td> </tr>" +
            "<tr><td>Damage Cost:</td> <td><input type='text' id='damageCost'/></td> </tr>" +
            "<tr><td>Source:</td> <td><input type='text' id='source'/></td> </tr>" +
            "<tr><td></td><td><input type='button' class='btn btn-success' value='Report Incident' onclick='saveData()'/></td></tr>";

    shape.infowindow = new google.maps.InfoWindow(
            {
                content: html
            });
    shape.infowindow.name = c;
    shape.setMap(map);

    google.maps.event.addListener(shape, 'click', showInfo);
    google.maps.event.addListener(map, 'click', addPoint);


//    infowindow = new google.maps.InfoWindow({
//        content: html
//    });
//
//    google.maps.event.addListener(map, "click", function(event) {
//        marker = new google.maps.Marker({
//            position: event.latLng,
//            map: map,
//            draggable: true
//        });
//        google.maps.event.addListener(marker, "click", function() {
//            infowindow.open(map, marker);
//        });
//    });
}
function addPoint(e) {
    vertices = shape.getPath();
    vertices.push(e.latLng);
}
function showInfo(event) {
    opened_info.close();
    //if (opened_info.name !== this.infowindow.name) {
        this.infowindow.setPosition(event.latLng);
        this.infowindow.open(map);
        opened_info = this.infowindow;
    //}
}
function saveData() {
   
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
    //console.log(polyString);
    var description = escape(document.getElementById("description").value);
    var  disasterType= escape(document.getElementById("disasterType").value);
    var  date= escape(document.getElementById("date").value);
    var  deaths= escape(document.getElementById("death").value);
    var  injured= escape(document.getElementById("injured").value);
    var  missing= escape(document.getElementById("missing").value);
    var  familiesAffected= escape(document.getElementById("familiesAffected").value);
    var  housesDestroyed= escape(document.getElementById("housesDestroyed").value);
    var  damageCost= escape(document.getElementById("damageCost").value);
    var  source= escape(document.getElementById("source").value);
    var url = "http://localhost/icdrris/application/views/savePolygon.php?description=" + description + "&disasterType=" + disasterType + "&date=" + date + "&deaths=" + deaths+"&injured="+injured+"&missing="+missing+"&familiesAffected="+familiesAffected+"&housesDestroyed="+housesDestroyed+"&damageCost="+damageCost+"&source="+source+"&polygon="+polyString;
    console.log(url);
    downloadUrl(url, function(data, responseCode) {
        if (responseCode === 200 && data.length <= 1) {
            shape.infowindow.close();
            document.getElementById("message").innerHTML = "<div class=\"alert alert-success\" >Incident reported.</div>";
            console.log("SUCCESS!");
        }
        else {
            console.log("response code not successfull");
            console.log(data);
        }
    });
}

function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            request.onreadystatechange = doNothing;
            callback(request.responseText, request.status);
        }
    };

    request.open('GET', url, true);
    request.send(null);
}

function doNothing() {
}