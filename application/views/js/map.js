
var directionDisplay;

var directionsService = new google.maps.DirectionsService();
var polygonsArray1 = new Array();
var polygonsArray2 = new Array();
var markersArray1 = new Array();
var markersArray2 = new Array();
var output;
var map;

$(document).ready(function(){
    initializeMap();
    filterReports();
});

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

function bindPolygonToSidePanel(map, polygon, center, id){
    google.maps.event.addListener(polygon, 'click', function(){
        map.setCenter(center);
        displayDetailsFromMap(id);
    });
}
function bindMarkerToSidePanel(map, marker, center, id){
    google.maps.event.addListener(marker, 'click', function(){
        map.setCenter(center);
        displayDetailsFromMap(id);
    });
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

function filterReports(){

        var filterValue1 = document.filterForm1.filterMenu1.value;
        var filterValue2 = document.filterForm2.filterMenu2.value;
        console.log("FILTER VALUE1: "+filterValue1);
        console.log("FILTER VALUE2: "+filterValue2);
        if(filterValue1 === 'Polygon'){
            filterPolygon();
        }
        else if(filterValue1 === 'Marker'){
            filterMarker();
        }
        else if(filterValue2 != 'null'){
            //filterMarkersPolygons(filterValue2);
            console.log("inside else if filetervalue != null ");
            getAllMarkersPolygons();
        }else{
            getAllMarkersPolygons();
            console.log("inside else statement");
        }
    
}

function getAllMarkersPolygons(){

        console.log("***** getAllMarkersPolygons invoked *****");
        //var filterValue = document.filterForm2.filterMenu2.value;
        //console.log("FILTER VALUE 2: "+filterValue);

        //initializeMap();
        //clearIncidentList();

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
        };
        
        var customIcons = {
            Flashflood: {
                icon: 'icons/flood.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            },
            Mudslide: {
                icon: 'icons/earthquake.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            },
            Landslide: {
                icon: 'icons/earthquake.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            }

        };

        // Change this depending on the name of your PHP file
        downloadUrl("http://localhost/icdrris/application/views/getAllMapElements.php", function(data) {

            var xml = data.responseXML;
            //console.log(xml);
            var polygons = xml.documentElement.getElementsByTagName("polygons")[0].getElementsByTagName("polygon");
            var markers = xml.documentElement.getElementsByTagName("markers")[0].getElementsByTagName("marker");

            //empty the Polygon array first
            //emptyArray(polygonsArray1);
            //console.log("polygons array length: "+polygonsArray1.length);
            //initialize the div for the list in the sidebar
            //and empty the output string to fill with fresh values

            for (var polygonIndex = 0; polygonIndex < polygons.length; polygonIndex++) {

            //Extract all the elements needed for the sidebar(incident details)
            var incident_report_id = polygons[polygonIndex].getAttribute("incident_report_id");
            var disaster_type = polygons[polygonIndex].getAttribute("disaster_type");

                //============DECLARE VARIABLES=============
                        var coordinates = [];
                        //var bounds = new google.maps.LatLngBounds();
                        var myPolygon;
                        var center;
                        var id;
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
                        
                        //console.log( "CALCULATED CENTER: "+calculateCenter(coordinates));
                        center = calculateCenter(coordinates);

                        var polyOptions = {
                            paths: coordinates,
                            strokeColor: polygonColor[disaster_type],
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: polygonStroke[disaster_type],
                            fillOpacity: 0.35
                        }

                        myPolygon = new google.maps.Polygon(polyOptions);

                        //APPEND THE POLYGON DETAILS TO SIDEBAR HERE
                        bindPolygonToSidePanel(map, myPolygon, center, incident_report_id);
                        appendToList(myPolygon, incident_report_id, polygons[polygonIndex]);

                        //myPolygon.setMap(map);


            }

            for (var i = 0; i < markers.length; i++) {

                var id = markers[i].getAttribute("incident_report_id");
                var disaster_type = markers[i].getAttribute("disaster_type");

                var icon = customIcons[disaster_type] || {};
                var point = new google.maps.LatLng(
                                parseFloat(markers[i].getAttribute("lat")),
                                parseFloat(markers[i].getAttribute("lng")));
                
                var markerOptions = {
                            position: point,
                            icon: icon.icon,
                            shadow: icon.shadow
                        }
                var marker = new google.maps.Marker(markerOptions);

                console.log("marker loop reached here");                    
                bindMarkerToSidePanel(map, marker, point, id);
                appendToList(marker, id, markers[i]);
                        //marker.setMap(map);

            }
        });

}

function filterPolygon(){

        var filterValue = document.filterForm2.filterMenu2.value;
        console.log("filter polygon called");

        initializeMap();
        clearIncidentList();

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
            console.log("polygons array length: "+polygonsArray1.length);
            //initialize the div for the list in the sidebar
            //and empty the output string to fill with fresh values

            for (var polygonIndex = 0; polygonIndex < polygons.length; polygonIndex++) {

            //Extract all the elements needed for the sidebar(incident details)
            var incident_report_id = polygons[polygonIndex].getAttribute("incident_report_id");
            var disaster_type = polygons[polygonIndex].getAttribute("disaster_type");

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
                        var id;


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

                        myPolygon = new google.maps.Polygon(polyOptions);
                        
                        //BIND POLYGON DETAILS TO SIDEBAR HERE
                        bindPolygonToSidePanel(map, myPolygon, center, incident_report_id);
                        appendToList(myPolygon, incident_report_id, polygons[polygonIndex]);

                        myPolygon.setMap(map);

                    }
                    else{

                        //polygonsArray1.push(myPolygon);                        
                    }

                }else{
                        var coordinates = [];
                        //var bounds = new google.maps.LatLngBounds();
                        var myPolygon;
                        var center;
                        var id;
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
                        
                        //console.log( "CALCULATED CENTER: "+calculateCenter(coordinates));
                        center = calculateCenter(coordinates);

                        var polyOptions = {
                            paths: coordinates,
                            strokeColor: polygonColor[disaster_type],
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: polygonStroke[disaster_type],
                            fillOpacity: 0.35
                        }

                        myPolygon = new google.maps.Polygon(polyOptions);

                        //APPEND THE POLYGON DETAILS TO SIDEBAR HERE
                        bindPolygonToSidePanel(map, myPolygon, center, incident_report_id);
                        appendToList(myPolygon, incident_report_id, polygons[polygonIndex]);

                        myPolygon.setMap(map);

                }

            }
        });

}

function filterMarker() {


        var filterValue = document.filterForm2.filterMenu2.value;
        console.log("filter marker called");
        
        initializeMap();
        clearIncidentList();

        var customIcons = {
            Flashflood: {
                icon: 'icons/flood.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            },
            Mudslide: {
                icon: 'icons/earthquake.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            },
            Landslide: {
                icon: 'icons/earthquake.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            }

        };

        // Change this depending on the name of your PHP file
        downloadUrl("http://localhost/icdrris/application/views/getAllMapElements.php", function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName("markers")[0].getElementsByTagName("marker");
            var loopCount=0;

            for (var i = 0; i < markers.length; i++) {

                var id = markers[i].getAttribute("incident_report_id");
                var disaster_type = markers[i].getAttribute("disaster_type");

                if (document.filterForm2.filterMenu2.value != 'null')
                {
                    //console.log("inside if statement");
                    if (filterValue === disaster_type)
                    {
                        var icon = customIcons[disaster_type] || {};
                        var point = new google.maps.LatLng(
                                parseFloat(markers[i].getAttribute("lat")),
                                parseFloat(markers[i].getAttribute("lng")));

                        var markerOptions = {
                            position: point,
                            icon: icon.icon,
                            shadow: icon.shadow
                        };

                        var marker = new google.maps.Marker(markerOptions);
                        bindMarkerToSidePanel(map, marker, point,  id);
                        appendToList(marker, id, markers[i]);

                        marker.setMap(map);

                    }
                }else{

                        var icon = customIcons[disaster_type] || {};
                        var point = new google.maps.LatLng(
                                parseFloat(markers[i].getAttribute("lat")),
                                parseFloat(markers[i].getAttribute("lng")));

                        var markerOptions = {
                            position: point,
                            icon: icon.icon,
                            shadow: icon.shadow
                        };

                        var marker = new google.maps.Marker(markerOptions);

                        bindMarkerToSidePanel(map, marker, point, id);
                        appendToList(marker, id, markers[i]);

                        marker.setMap(map);

                }
            }
            
        });
}

function appendToList(mapElement, id, markerDetails){

    //console.log("Filter menu 1: "+document.filterForm1.filterMenu1.value);
    //console.log("Filter menu 2: "+document.filterForm2.filterMenu2.value);
    console.log("append to list started here");

    var div  = document.getElementById('incidentList');
    var listItem;
        listItem += "<div class=\"accordion\" id=\"accordion" + id + "\">";
        listItem += "<div class=\"accordion-group\">";
        listItem += "<div class=\"accordion-heading\">";
        listItem += "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" + id + "\" href=\"#collapse" + id + "\" style= \"display: inline-block; width: 330px;\">" + markerDetails.getAttribute("disaster_type") + "</a>";
        //place icon-links here [show details]
        listItem += "<a class= \"show-details-btn\"  data-id=\""+id+"\"><i class= \"icon-eye-open icon-white\" id= \"show-details-btn\" title= \"Show details\" style= \"margin-right: 10px;\" onclick=\"displayDetails()\"> </i></a>"; // show details icon
        //end div
        listItem += "</div>";
        listItem += "<div id=\"collapse" + id + "\" class=\"accordion-body collapse in\">";
        listItem += "<div class=\"accordion-inner\">";
        listItem += "<p class=\"list-group-item-text\">Description :" + markerDetails.getAttribute("incident_description") + "<br> Date:" + markerDetails.getAttribute("incident_date")+"<br> Location: "+markerDetails.getAttribute("location_address")+"</p>";
        listItem += "</div></div></div>";
    
    //append to the list
    div.innerHTML = div.innerHTML + listItem;
    console.log("append to list ended here");
    //marker.setMap(map);
    //map.setCenter(new google.maps.LatLng(parseFloat(markerDetails.getAttribute("lat")), parseFloat(markerDetails.getAttribute("lng"))));
}

function backToList(){
    $(".subBreadCrumb").remove();
    $( "#tabbable" ).hide( "fast" );
    $( "#incidentList" ).show( "fast" );
}

function clearIncidentList(){
    document.getElementById('incidentList').innerHTML = "";
}

function displayDetails(){
	
		  console.log('sdb-clicked');
		  $( "#incidentList" ).hide( "fast" );
		  $( "#table-rows-victims" ).removeData( "fast" );
		  var incident_report_id = $( ".show-details-btn, #show-details-btn" ).data('id');
			console.log(incident_report_id);
		  var dataStr = 'id='+incident_report_id;
          console.log(dataStr)

		  
					/* Send the data using post and put results to the members table */
			request = $.ajax({
				url: "http://localhost/icdrris/Incident/incidentTitle",
				type: "POST",
				data: dataStr,
				success: function(msg){
					console.log("success -TITLE");
					//console.log(msg);
					if(msg == 'error'){  
						console.log("naay mali sa query getIncidentDetails - TITLE doy.\n ");
						$("#incident-title").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
					}else{
						console.log("success pa jud title");
						$("#incident-title").html(msg);
						$("#li0").after('<li><a class="subBreadCrumb">'+msg+'</a></li>');
						$( "#victims-tab, #details-tab, #overview-li, #editinfo-li, #delete-li, #displaychart-li, #victimslist-li, #reportvictim-li" ).attr( "data-incidentid", incident_report_id );
						$( "#tabbable" ).show( "slow" );
					}
				},
				error: function(){
					console.log("system error oy!");
					console.log(values);
					$("#incident-title").html("Sorry, system error.");
					$( "#tabbable" ).show( "slow" );
				}
			});
			
		/* Send the data using post and put results to the members table */
			request = $.ajax({
				url: "http://localhost/icdrris/Incident/incidentDetails",
				type: "POST",
				data: dataStr,
				success: function(msg){
					console.log("success");
					//console.log(msg);
					if(msg == 'error'){  
						console.log("naay mali sa query getIncidentDetails doy.\n ");
						$("#incident-information").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
						$( "#tabbable" ).show( "slow" );
					}else{
						console.log("success pa jud");
						$("#incident-information").html(msg);
						$( "#tabbable" ).show( "slow" );
					}
				},
				error: function(){
					console.log("system error oy!");
					console.log(values);
					$("#incident-information").html("Sorry, system error."); 
					$( "#tabbable" ).show( "slow" );
				}
			});
			
						/* Send the data using post and put results to the members table */
			request = $.ajax({
				url: "http://localhost/icdrris/Victim/viewAllVictims",
				type: "POST",
				data: dataStr,
				success: function(msg){
					console.log("success");
					//console.log(msg);
					if(msg == 'error'){  
						console.log("naay mali sa query getIncidentDetails doy.\n ");
						$( "#tabbable" ).show( "slow" );
						$("#table-rows-victims").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
					}else{
						console.log("success pa jud");
						$( "#tabbable" ).show( "slow" );
						$("#table-rows-victims").html(msg);
					}
				},
				error: function(){
					console.log("system error oy!");
					console.log(values);
					$( "#tabbable" ).show( "slow" );
					$("#table-rows-victims").html("Sorry, system error.");
				}
			});
			
		
		     
}

//---------------------------------------------- SECOND FUNCTION FOR THE MAP BINDING ------------------------------------------------------------

function openSideBar(){
            $("#map_canvass").addClass("span6"); //added
            $("#map_canvass").css({"float":"right"}); //added
            $(".panel").show("slow");
            $(".trigger").addClass("active");
}

function displayDetailsFromMap(incident_report_id)
{  
                 
        console.log('displayDetails invoked with id');
        
        $( "#incidentList" ).hide( "fast" );
        openSideBar();
        
        console.log(incident_report_id);
        
        var dataStr = 'id='+incident_report_id;

          
            /* Send the data using post and put results to the members table */
            request = $.ajax({
                url: "http://localhost/icdrris/Incident/incidentTitle",
                type: "POST",
                data: dataStr,
                success: function(msg){
                    console.log("success -TITLE");
                    //console.log(msg);
                    if(msg == 'error'){  
                        console.log("naay mali sa query getIncidentDetails - TITLE doy.\n ");
                        $("#incident-title").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
                    }else{
                        console.log("success pa jud title");
                        $("#incident-title").html(msg);
                    }
                },
                error: function(){
                    console.log("system error oy!");
                    //console.log(values);
                    $("#incident-title").html("Sorry, system error.");
                }
            });
            
        /* Send the data using post and put results to the members table */
            request = $.ajax({
                url: "http://localhost/icdrris/Incident/incidentDetails",
                type: "POST",
                data: dataStr,
                success: function(msg){
                    console.log("success");
                    //console.log(msg);
                    if(msg == 'error'){  
                        console.log("naay mali sa query getIncidentDetails doy.\n ");
                        $("#incident-information").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
                    }else{
                        console.log("success pa jud");
                        $("#incident-information").html(msg);
                    }
                },
                error: function(){
                    console.log("system error oy!");
                    console.log(values);
                    $("#incident-information").html("Sorry, system error.");
                }
            });
            
        
          $( "#tabbable" ).show( "slow" );
          console.log("#tabbable invoked to show");
      
}

function victimsTab(){
	
	$( ".victims-tab, #victims-tab" ).click(function(event){   
			event.preventDefault();		
		  console.log('victims-tab-clicked');
		  
		  var incident_report_id = $(this).data('incidentid');
			console.log(incident_report_id);
		  var dataStr = 'id='+incident_report_id;

		/* Send the data using post and put results to the members table */
			request = $.ajax({
				url: "http://localhost/icdrris/Victim/viewAllVictims",
				type: "POST",
				data: dataStr,
				success: function(msg){
					console.log("success");
					//console.log(msg);
					if(msg == 'error'){  
						console.log("naay mali sa query getIncidentDetails doy.\n ");
						$( "#tabbable" ).show( "slow" );
						$("#table-rows-victims").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
					}else{
						console.log("success pa jud");
						$( "#tabbable" ).show( "slow" );
						$("#table-rows-victims").html(msg);
					}
				},
				error: function(){
					console.log("system error oy!");
					console.log(values);
					$( "#tabbable" ).show( "slow" );
					$("#table-rows-victims").html("Sorry, system error.");
				}
			});
		});
}

