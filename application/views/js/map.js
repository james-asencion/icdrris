
var directionDisplay;

var directionsService = new google.maps.DirectionsService();
var polygonsArray1 = new Array();
var polygonsArray2 = new Array();
var markersArray1 = new Array();
var markersArray2 = new Array();
var output;
var map;

function initializeMap() {
    var latlng = new google.maps.LatLng(8.228021, 124.245242);
    directionsDisplay = new google.maps.DirectionsRenderer();
    var myOptions = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById("directionsPanel"));

    var infoWindow = new google.maps.InfoWindow;
}

function insertToDocument(content)
{
    document.getElementById('incidentList').innerHTML = "";
    document.getElementById('incidentList').innerHTML = (content);
}

function emptyArray(arr){
    while(arr.length > 0){
        arr.shift();
    }
    arr.pop();
}

function bindInfoWindow(marker, map, infoWindow, html) {
    google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
    });
}

function bindInfoWindowToSidePanel(map, element, marker, content)
{
    //-------------------------------------------------------------------------------------
    google.maps.event.addDomListener(element, 'click', function() {
        map.setCenter(marker.getPosition());
        infowindow.setContent(content);
        infowindow.open(map, marker);
    });
    //-------------------------------------------------------------------------------------
}
function appendToSidebarList(detailsArray){
        //polygon details to be used in the sidebar
            output += "<div class=\"accordion\" id=\"accordion\" onclick=\"triggerPolygon("+detailsArray["polygon_index"]+")\">";
            output += "<div class=\"accordion-group\">";
            output += "<div class=\"accordion-heading\" name=\"accordionHeader\">";
            //
            output += "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse\">" + detailsArray["incident_description"] + "</a>";
            output += "</div>";
            output += "<div name=\"collapse\" id=\"collapse" + detailsArray["polygonIndex"] + "\" class=\"accordion-body collapse in\">";
            output += "<div class=\"accordion-inner\">";
            output += "<p class=\"list-group-item-text\">Disaster Type :" + detailsArray["disaster_type"] + "<br> Description:" + detailsArray["incident_description"]+"<br>Date :" + detailsArray["incident_date"] +"<br>Deaths :" + detailsArray["death_toll"]+"<br>Injured :" + detailsArray["no_of_injuries"]+"<br>Missing :" + detailsArray["no_of_people_missing"]+ "<br>families affected : " + detailsArray["no_of_families_affected"]+ "<br>Houses Destroyed : " + detailsArray["no_of_houses_destroyed"] + "<br>Source : " +detailsArray["incident_info_source"]+ "</p>";
            output += "</div></div></div>";
}
function downloadUrl(url, callback) {
    var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;

    request.onreadystatechange = function() {
                                            if (request.readyState == 4) {
                                                request.onreadystatechange = doNothing;
                                                callback(request, request.status);
                                            }
                                        };

    request.open('GET', url, true);
    //this is to reminate the request
    request.send(null);
}

function doNothing() {
}

function calculateCenter(coordinates){

    var bounds = new google.maps.LatLngBounds();

    for(var i=0; i<coordinates.length; i++)
    {
        bounds.extend(coordinates[i]);
    }
    return bounds.getCenter();
}
function triggerPolygon(n){
    map.setCenter(polygonsArray1[n].center);
    //google.maps.event.trigger(polygonsArray1[n],'click');
    //alert("center at-->"+polygonsArray1[n].center);
}

function filterReports()    {

        var filterValue = document.filterForm1.filterMenu1.value;
        console.log("FILTER VALUE1: "+filterValue);
        if(filterValue === 'Polygon')
        {
            filterPolygon();
        }else{
            filterMarker();
        }
    
}

function filterPolygon(){

        //empty the polygon array because this filter function resets the polygon currently displayed in the map


        var filterValue = document.filterForm2.filterMenu2.value;
        console.log("FILTER VALUE 2: "+filterValue);

        initializeMap();

        //This is the option to change the polygon color according to the disaster type
        var polygonColor = {
            Flashflood: {
                //blue
                fillColor: "#0404B4"
            },
            Mudslide: {
                //brown
                fillColor: "#7A4444"
            },
            Landslide: {
                //red
                fillColor: "#E92222"
            }

        };
        var polygonStroke = {
            Flashflood: {
                //blue
                fillColor: "#0404B4"
            },
            Mudslide: {
                //brown
                fillColor: "#7A4444"
            },
            Landslide: {
                //red
                fillColor: "#E92222"
            }
        }
        // Change this depending on the name of your PHP file
        downloadUrl("http://localhost/icdrris/application/views/getAllMapElements.php", function(data) {

            var xml = data.responseXML;
            //console.log(xml);
            var polygons = xml.documentElement.getElementsByTagName("polygons")[0].getElementsByTagName("polygon");


            //empty the Polygon array first
            emptyArray(polygonsArray1);

            //initialize the div for the list in the sidebar
            //and empty the output string to fill with fresh values
            output = "";
            output += "<ul class=\"list-group\">";

            for (var polygonIndex = 0; polygonIndex < polygons.length; polygonIndex++) {

            //Extract all the elements needed for the sidebar(incident details)
            var detailsArray = new Array();
            detailsArray["polygon_index"] = polygonIndex;
            detailsArray["incident_description"] = polygons[polygonIndex].getAttribute("incident_description");
            detailsArray["location_address"] = polygons[polygonIndex].getAttribute("location_address");
            detailsArray["incident_intensity"] = polygons[polygonIndex].getAttribute("incident_intensity");
            detailsArray["incident_date"] = polygons[polygonIndex].getAttribute("incident_date");
            detailsArray["disaster_type"] = polygons[polygonIndex].getAttribute("disaster_type");
            detailsArray["death_toll"] = polygons[polygonIndex].getAttribute("death_toll");
            detailsArray["no_of_injuries"] = polygons[polygonIndex].getAttribute("no_of_injuries");
            detailsArray["no_of_people_missing"] = polygons[polygonIndex].getAttribute("no_of_people_missing");
            detailsArray["no_of_families_affected"] = polygons[polygonIndex].getAttribute("no_of_families_affected");
            detailsArray["no_of_houses_destroyed"] = polygons[polygonIndex].getAttribute("no_of_houses_destroyed");
            detailsArray["estimated_damage_cost"] = polygons[polygonIndex].getAttribute("estimated_damage_cost");
            detailsArray["incident_info_source"] = polygons[polygonIndex].getAttribute("incident_info_source");
            detailsArray["flag_confirmed"] = polygons[polygonIndex].getAttribute("flag_confirmed");
            detailsArray["flag_true_rating"] = polygons[polygonIndex].getAttribute("flag_true_rating");
            detailsArray["flag_false_rating"] = polygons[polygonIndex].getAttribute("flag_false_rating");


            var disaster_type = detailsArray["disaster_type"];
            console.log("DISASTER TYPE: "+disaster_type);

                //============DECLARE VARIABLES=============
                console.log("FILTERMENU2 VALUE : "+document.filterForm2.filterMenu2.value)
                if (document.filterForm2.filterMenu2.value != 'null')
                {    

                    //console.log("inside if statement");
                    if (filterValue === disaster_type)
                    {

                        var coordinates = [];
                        var myPolygon;
                        var center;
                        var points = polygons[polygonIndex].getElementsByTagName("point");

                        //======EXTRACT MULTIPLE POINTS======
                        for (var j = 0; j < points.length; j++)
                        {
                            var point = new google.maps.LatLng(
                                    parseFloat(points[j].getAttribute("lat")),
                                    parseFloat(points[j].getAttribute("lng")));
                            coordinates[j] = point;
                        }
                        
                        center = calculateCenter(coordinates);

                        var polyOptions = {
                            paths: coordinates,
                            strokeColor: polygonColor[disaster_type],
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: polygonStroke[disaster_type],
                            fillOpacity: 0.35,
                            center: center
                        };

                        //console.log("center here-->"+center);
                        appendToSidebarList(detailsArray);

                        myPolygon = new google.maps.Polygon(polyOptions);
                        google.maps.event.addListener(myPolygon, 'click', function(){
                            map.setCenter(center);
                            //alert("center in if statement-->"+center);
                            $(".panel").toggle("fast");
                            $(this).toggleClass("active");
                        });

                        //BIND THE DETAILS IN SIDEBAR HERE
                        //

                        //push polygons to an aray to be referenced later in the sidebar
                        polygonsArray1.push(myPolygon);

                        //append details to sidebar

                        
                        

                        myPolygon.setMap(map);

                    }
                    else{

                        polygonsArray1.push(myPolygon);                        
                    }

                }else{
                        var coordinates = [];
                        //var bounds = new google.maps.LatLngBounds();
                        var myPolygon;
                        var points = polygons[polygonIndex].getElementsByTagName("point");

                        var polygonsArray2 = new Array();

                        //======EXTRACT MULTIPLE POINTS======
                        for (var j = 0; j < points.length; j++)
                        {
                            var point = new google.maps.LatLng(
                                    parseFloat(points[j].getAttribute("lat")),
                                    parseFloat(points[j].getAttribute("lng")));
                            coordinates[j] = point;
                            //bounds.extend(point);
                        }
                        
                        console.log( "CALCULATED CENTER: "+calculateCenter(coordinates));
                        
                        var polyOptions = {
                            paths: coordinates,
                            strokeColor: polygonColor[disaster_type],
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: polygonStroke[disaster_type],
                            fillOpacity: 0.35
                        }

                        myPolygon = new google.maps.Polygon(polyOptions);

                        google.maps.event.addListener(myPolygon, 'click', function(){
                            map.setCenter(center);
                            $(".panel").toggle("fast");
                            $(this).toggleClass("active");
                            alert("center in else statement"+center);
                        });

                        //push polygons to an aray to be referenced later in the sidebar
                        polygonsArray1.push(myPolygon);

                        //append details to sidebar
                        appendToSidebarList(detailsArray)

                        myPolygon.setMap(map);

                }

            }
            output += "</ul>";
            insertToDocument(output);
            //console.log(output);

        });

}


var directionDisplay;
var directionsService = new google.maps.DirectionsService();

var customIcons = {
    flashflood: {
        icon: 'icons/flood.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
    },
    infrastructureDamage: {
        icon: 'icons/earthquake.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
    }
};


function filterMarker() {


        var filterValue = document.filterForm2.filterMenu2.value;
        //console.log(filterValue);
        var latlng = new google.maps.LatLng(8.228021, 124.245242);
        directionsDisplay = new google.maps.DirectionsRenderer();

        var customIcons = {
            FlashFlood: {
                icon: 'icons/flood.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            },
            MudSlide: {
                icon: 'icons/earthquake.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            },
            LandSlide: {
                icon: 'icons/earthquake.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            }

        };

        var myOptions = {
            zoom: 14,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false
        };


        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById("directionsPanel"));

        var infoWindow = new google.maps.InfoWindow;

        // Change this depending on the name of your PHP file
        downloadUrl("http://localhost/icdrris/application/views/getAllMapElements.php", function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName("markers")[0].getElementsByTagName("marker");
            var loopCount=0;
            for (var i = 0; i < markers.length; i++) {

                if (document.filterForm2.filterMenu2.value != 'null')
                {
                    //console.log("inside if statement");
                    if (filterValue === markers[i].getAttribute("disaster_type"))
                    {

                        var incident_description = markers[i].getAttribute("incident_description");
                        var location_address = markers[i].getAttribute("location_address");
                        var incident_intensity = markers[i].getAttribute("incident_intensity");
                        var incident_date = markers[i].getAttribute("incident_date");
                        var disaster_type = markers[i].getAttribute("disasterType");
                        var death_toll = markers[i].getAttribute("death_toll");
                        var no_of_injuries = markers[i].getAttribute("no_of_injuries");
                        var no_of_people_missing = markers[i].getAttribute("no_of_people_missing");
                        var no_of_families_affected = markers[i].getAttribute("no_of_families_affected");
                        var no_of_houses_destroyed = markers[i].getAttribute("no_of_houses_destroyed");
                        var estimated_damage_cost = markers[i].getAttribute("estimated_damage_cost");
                        var incident_info_source = markers[i].getAttribute("incident_info_source");
                        var flag_confirmed = markers[i].getAttribute("flag_confirmed");
                        var flag_true_rating = markers[i].getAttribute("flag_true_rating");
                        var flag_false_rating = markers[i].getAttribute("flag_false_rating");
                        //set-up the HTML here: 
                        var html = "<b> Incident Description: " + incident_description + "<br/>" + "<b> Disaster Type: " + disaster_type + "</b> location: " + location_address+ "<br/><b> Casualties: "+death_toll+"</b>"+"  No of reported injuries: "+no_of_injuries+"<br/>"+"No of people reported missing: "+no_of_people_missing+
                        "<b>No of Families Affected: "+no_of_families_affected+"</b><b>No of houses Destroyed: "+no_of_houses_destroyed+"</b><b> Estimated Damage Cost: "+estimated_damage_cost+
                        "<b> Confirmed: "+flag_confirmed+"</b><b> Confirmation Rating: "+flag_true_rating+"</b><b> False Rating: "+flag_false_rating;
                        var icon = customIcons[disaster_type] || {};
                        var point = new google.maps.LatLng(
                                parseFloat(markers[i].getAttribute("lat")),
                                parseFloat(markers[i].getAttribute("lng")));

                        var marker = new google.maps.Marker({
                            map: map,
                            position: point,
                            icon: icon.icon,
                            shadow: icon.shadow
                        });

                        bindInfoWindow(marker, map, infoWindow, html);

                    }
                }else{

                        var incident_description = markers[i].getAttribute("incident_description");
                        var location_address = markers[i].getAttribute("location_address");
                        var incident_intensity = markers[i].getAttribute("incident_intensity");
                        var incident_date = markers[i].getAttribute("incident_date");
                        var disaster_type = markers[i].getAttribute("disasterType");
                        var death_toll = markers[i].getAttribute("death_toll");
                        var no_of_injuries = markers[i].getAttribute("no_of_injuries");
                        var no_of_people_missing = markers[i].getAttribute("no_of_people_missing");
                        var no_of_families_affected = markers[i].getAttribute("no_of_families_affected");
                        var no_of_houses_destroyed = markers[i].getAttribute("no_of_houses_destroyed");
                        var estimated_damage_cost = markers[i].getAttribute("estimated_damage_cost");
                        var incident_info_source = markers[i].getAttribute("incident_info_source");
                        var flag_confirmed = markers[i].getAttribute("flag_confirmed");
                        var flag_true_rating = markers[i].getAttribute("flag_true_rating");
                        var flag_false_rating = markers[i].getAttribute("flag_false_rating");
                        //set-up the HTML here: 
                        var html = "<b> Incident Description: " + incident_description + "<br/>" + "<b> Disaster Type: " + disaster_type + "</b> location: " + location_address+ "<br/><b> Casualties: "+death_toll+"</b>"+"  No of reported injuries: "+no_of_injuries+"<br/>"+"No of people reported missing: "+no_of_people_missing+
                        "<b>No of Families Affected: "+no_of_families_affected+"</b><b>No of houses Destroyed: "+no_of_houses_destroyed+"</b><b> Estimated Damage Cost: "+estimated_damage_cost+
                        "<b> Confirmed: "+flag_confirmed+"</b><b> Confirmation Rating: "+flag_true_rating+"</b><b> False Rating: "+flag_false_rating;
                        var icon = customIcons[disaster_type] || {};
                        var point = new google.maps.LatLng(
                                parseFloat(markers[i].getAttribute("lat")),
                                parseFloat(markers[i].getAttribute("lng")));

                        var marker = new google.maps.Marker({
                            map: map,
                            position: point,
                            icon: icon.icon,
                            shadow: icon.shadow
                        });

                        bindInfoWindow(marker, map, infoWindow, html);

                }
                loopCount = i;
            }
            //console.log(loopCount);
        });
}

/**
function displayList() {

    //downloadUrl("http://localhost/icdrris/application/views/polyXML.php", populate());

    downloadUrl("http://localhost/icdrris/application/views/polyXML.php", function(data) {

        var xml = data.responseXML;
        //console.log(xml);
        var polygon = xml.documentElement.getElementsByTagName("polygon");

        var output = "<ul class=\"list-group\">";

        for (var i = 0; i < polygon.length; i++) {
            var description = polygon[i].getAttribute("description");
            var disasterType = polygon[i].getAttribute("disasterType");
            var date = polygon[i].getAttribute("date");
            var deaths = polygon[i].getAttribute("deaths");
            var injured = polygon[i].getAttribute("injured");
            var missing = polygon[i].getAttribute("missing");
            var affectedFamilies = polygon[i].getAttribute("affectedFamilies");
            var homesDestroyed = polygon[i].getAttribute("homesDestroyed");
            var damageCost = polygon[i].getAttribute("damageCost");
            var affectedFamilies = polygon[i].getAttribute("affectedFamilies");
            var infoSource = polygon[i].getAttribute("infoSource");

            output += "<div class=\"accordion\" id=\"accordion" + i + "\">";
            output += "<div class=\"accordion-group\">";
            output += "<div class=\"accordion-heading\">";
            output += "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" + i + "\" href=\"#collapse" + i + "\">" + disasterType + "</a>";
            output += "</div>";
            output += "<div id=\"collapse" + i + "\" class=\"accordion-body collapse in\">";
            output += "<div class=\"accordion-inner\">";
            output += "<p class=\"list-group-item-text\">Disaster Type :" + disasterType + "<br> Description:" + description+"<br>Date :" + date +"<br>Deaths :" + deaths+"<br>Injured :" + injured+"<br>Missing :" + missing+ "<br>families affected : " + affectedFamilies+ "<br>Houses Destroyed : " + homesDestroyed + + "<br>Source : " +infoSource+ "</p>";
            output += "</div></div></div>";

        }
        output += "</ul>";
        //console.log(output);
        insertToDocument(output);

    });
}
*/