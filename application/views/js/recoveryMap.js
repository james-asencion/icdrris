
var directionDisplay;

var directionsService = new google.maps.DirectionsService();
var mapElements = [];
var polygonsArray1 = new Array();
var polygonsArray2 = new Array();
var markersArray1 = new Array();
var markersArray2 = new Array();
var output;
var map;

$(document).ready(function() {
    getAllMapElements();

    $("#barangayList").html("");
    for(var i=0;i<mapElements.length;i++){
        if(mapElements[i].elementType === 6){
            appendToBarangayList(mapElements[i]);    
        }
    }

});

function initializeMap() {
    var markers = [];
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

    var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(8.099003, 124.051510),
      new google.maps.LatLng(8.395963, 124.425731));
    map.fitBounds(defaultBounds);

    // Create the search box and link it to the UI element.
    var input = /** @type {HTMLInputElement} */(
        document.getElementById('pac-input'));
    var inputDiv = document.getElementById('customSearchBox');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputDiv);

    var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

    // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });

   }

    

function emptyArray(arr) {
    while (arr.length > 0) {
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

function bindBarangayToSidePanel(polygon) {
    var location_id = polygon.id;
    google.maps.event.addListener(polygon, 'click', function() {
        displayBarangayRecoveryFromMap(location_id);
        map.setCenter(polygon.center);
    });
}
function stopAnimation(marker) {
    setTimeout(function () {
        marker.setAnimation(null);
    }, 2000);
}

function downloadUrl(url, callback) {
    var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;

    request.onreadystatechange = function() {
        if (request.readyState === 4) {
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

function calculateCenter(coordinates) {

    var bounds = new google.maps.LatLngBounds();

    for (var i = 0; i < coordinates.length; i++)
    {
        bounds.extend(coordinates[i]);
    }
    return bounds.getCenter();
}


function getAllMapElements() {

    console.log("***** getAllMapElements invoked *****");
    //var filterValue = document.filterForm2.filterMenu2.value;
    //console.log("FILTER VALUE 2: "+filterValue);

    initializeMap();
    
    $("#barangayList").html("");

    mapElements = [];
    //console.log("Map Elements array is now ----->>>>>"+mapElements.length+"<<<<<-----");

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
        },
        barangay: {
            //red
            fillColor: "#E92222"
        }

    };

    var polygonStroke = {
        Flashflood: {
            //blue
            strokeColor: "#0404B4"
        },
        Mudslide: {
            //brown
            strokeColor: "#7A4444"
        },
        Landslide: {
            //red
            strokeColor: "#E92222"
        },
        barangay: {
            //red
            fillColor: "#E92222"
        }
    };


    //var dateTo = $("#dateTo").val().replace(/-/g,'');
    //var dateFrom = $("#dateFrom").val().replace(/-/g,'');
    // Change this depending on the name of your PHP file
    //alert("http://localhost/icdrris/MapController/getAllMapElements/dateTo/"+dateTo+"/dateFrom/"+dateFrom);

    downloadUrl("http://localhost/icdrris/MapController/getRecoveryMappingElements", function(data) {

        var xml = data.responseXML;
        console.log(xml);
        //var polygons = xml.documentElement.getElementsByTagName("polygons")[0].getElementsByTagName("polygon");
        //var markers = xml.documentElement.getElementsByTagName("markers")[0].getElementsByTagName("marker");
        //var organizations = xml.documentElement.getElementsByTagName("livelihoodOrganizations")[0].getElementsByTagName("livelihoodOrganization");
        var barangays = xml.documentElement.getElementsByTagName("barangays")[0].getElementsByTagName("barangay");
        //empty the Polygon array first
        //emptyArray(polygonsArray1);
        //console.log("polygons array length: "+polygonsArray1.length);
        //initialize the div for the list in the sidebar
        //and empty the output string to fill with fresh values
        
        //================================================================================================================
        var barangayIndex=0;
        for (barangayIndex = 0; barangayIndex < barangays.length; barangayIndex++) {

            //console.log("Integer Equivalent -->>"+int+"<<<---");
            //Extract all the elements needed for the sidebar(incident details)
            var location_id = barangays[barangayIndex].getAttribute("location_id");
            var location_address = barangays[barangayIndex].getAttribute("location_address");
            var location_type = barangays[barangayIndex].getAttribute("location_type");
            var color = polygonColor['barangay'] || {};
            var stroke = polygonStroke['barangay'] || {};
           //============DECLARE VARIABLES=============
            var coordinates = [];
            //var bounds = new google.maps.LatLngBounds();
            var myPolygon;
            var center;
            var points = barangays[barangayIndex].getElementsByTagName("point");

            //console.log(location_address+" -> "+(polygonIndex+i+j+barangayIndex));
            //======EXTRACT MULTIPLE POINTS======
            for (var b = 0; b < points.length; b++)
            {
                var point = new google.maps.LatLng(
                        parseFloat(points[b].getAttribute("lat")),
                        parseFloat(points[b].getAttribute("lng")));
                coordinates[b] = point;
                //bounds.extend(point);
            }

            //console.log( "CALCULATED CENTER: "+calculateCenter(coordinates));
            center = calculateCenter(coordinates);
            //alert("center calculated at-->"+center);
            var polyOptions = {
                paths: coordinates,
                center:center,
                visible: true, 
                strokeColor: color.fillColor,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: color.strokeColor,
                fillOpacity: 0.35,
                arrId: (barangayIndex),
                id: location_id,
                location_address: location_address,
                location_type: location_type,
                elementType: 6
            }

            myPolygon = new google.maps.Polygon(polyOptions);
            mapElements.push(myPolygon);
            appendToBarangayList(myPolygon);

            //alert("current array length = "+mapElements.length+"  ,monitored index = "+(polygonIndex+i+j+barangayIndex));
            //APPEND THE POLYGON DETAILS TO SIDEBAR HERE
            bindBarangayToSidePanel(myPolygon);
            //appendToList(myPolygon, incident_report_id, center, polygons[polygonIndex]);

            myPolygon.setMap(map);


        }
    });

}
var user_type= '';
function get_session(){
    $(document).ready(function(){
        $.ajax({
                  url: "http://localhost/icdrris/Login/get_session",
                  type: "POST",
                  data: {},
                  success: function(msg){
                          user_type= msg;
                  },
                  error: function(msg){
                          alert('Error!');
                  }
        });
    });
  
    return user_type;
}


function appendToBarangayList(mapElement) {
    console.log("append to barangay list invoked");
    
    var listItem="";
    listItem += "<div class=\"accordion\" id=\"accordion" + mapElement.id + "\">";
    listItem += "<div class=\"accordion-group\">";
    listItem += "<div class=\"accordion-heading\">";
    listItem += "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" + mapElement.id + "\" href=\"#collapse" + mapElement.id + "\" style= \"display: inline-block; width: 200px;\">" + mapElement.location_address + "</a>";
    //place icon-links here [show details]
    listItem += "| <a class= \"label label-info\"  data-id=\"" + mapElement.id + "\" onclick=\"displayBarangayRecovery("+mapElement.id+","+mapElement.arrId+");\"><i class= \"icon-eye-open icon-white\" data-arrId=\""+mapElement.arrId+"\"data-id=\"" + mapElement.id + "\" id= \"show-details-btn\" title= \"Recovery Assessment\"> </i> Recovery Assessment </a> "; // show details icon
    //end div
    listItem += "</div>";
    listItem += "<div id=\"collapse" + mapElement.id + "\" class=\"accordion-body collapse in\">";
    listItem += "<div class=\"accordion-inner\">";
    listItem += "<p class=\"list-group-item-text\">Location :" + mapElement.location_address + "<br> Location Type:" + mapElement.location_type + "</p>";
    listItem += "</div></div></div>";

    //append to the list
    var div = document.getElementById('barangayList');
    //console.log(div);
    div.innerHTML = div.innerHTML + listItem;

    //map.setCenter(new google.maps.LatLng(parseFloat(markerDetails.getAttribute("lat")), parseFloat(markerDetails.getAttribute("lng"))));
}

function backToHome(){
    $("#barangayList").hide();
    $(".barangayTabbable").hide();
    $("#homeView").show("fast");
    $(".subBreadCrumb2").remove();
    $("#subBreadCrumb1").remove();
}
function barangayList(){
    $("#homeView").hide();
    $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToBarangayList()" class="subBreadCrumb1" id="subBreadCrumb1">Barangay List</a><span class="divider">/</span></li>');
    $("#barangayList").show("fast");
}
function backToBarangayList() {
    console.log(">>>>---backToRespondentList invoked---<<<<<");
    //alert("back to Barangay List invoked");
    $(".subBreadCrumb2").remove();
    $(".barangayTabbable").hide();
    $("#barangayTabbable").hide("fast");
    $("#barangayList").show("fast");
}
function openSideBar() {
    $("#map_canvass").removeClass("span12");
    $("#map_canvass").addClass("span8"); //added
    $("#map_canvass").css({"float":"right"}); //added
    google.maps.event.trigger(map_canvas, 'resize');
    $(".panel").show("fast");
    $(".trigger").addClass("active");
}


function displayBarangayRecoveryFromMap(location_id)
{

    backToHome();
    $("#homeView").hide();
    openSideBar();

    //alert("respondent id ->"+deployment_id);
    $("#barangayTabbable").show("slow");
    $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToBarangayList()" class="subBreadCrumb1" id="subBreadCrumb1">Barangay List</a><span class="divider">/</span></li>');
 /*retrieve the response organization name to be used in the breadcrumbs*/
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getBarangayName",
        type: "POST",
        data: {id:location_id},
        success: function(msg) {
                    $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + msg + '</a></li>');
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            //console.log(msg);
        }
    });

    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getBarangayRecoveryStatus",
        type: "POST",
        data: {id:location_id},
        success: function(msg) {
                    $("#recovery-status").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getBarangayRecoveryAssessment",
        type: "POST",
        data: {id:location_id},
        success: function(msg) {
                    $("#recovery-assessment").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });    

}
function displayBarangayRecovery(locationId, elementId)
{

    //alert('displayDetails invoked with id->'+livelihoodId);
    //$("#subBreadCrumb1").remove();
    $("#barangayList").hide("fast");
    $("#physical-resource").html('');
    //openSideBar();

    //alert("respondent id ->"+deployment_id);

     /*retrieve the response organization name to be used in the breadcrumbs*/
    $("#barangayTabbable").show("fast");
    $(".barangayTabbable").show("fast");   /*retrieve the response organization name to be used in the breadcrumbs*/


    

    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getBarangayName",
        type: "POST",
        data: {id:locationId},
        success: function(msg) {
                    $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + msg + '</a></li>');
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            //console.log(msg);
        }
    });

    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getBarangayRecoveryStatus",
        type: "POST",
        data: {id:locationId},
        success: function(msg) {
                    $("#recovery-status").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getBarangayRecoveryAssessment",
        type: "POST",
        data: {id:locationId},
        success: function(msg) {
                    $("#recovery-assessment").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });

    map.setCenter(mapElements[elementId].center);
    //mapElements[elementId].setAnimation(google.maps.Animation.BOUNCE);
    //stopAnimation(mapElements[elementId]);
}


