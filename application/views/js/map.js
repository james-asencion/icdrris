
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
    getAllMarkersPolygons();
    //filterReports();
//------------------------FOR THE FILTER FUNCTION------------------------------
    $('.dropdown-menu').on('click', function(e) {
    
        if($(this).hasClass('dropdown-menu-form')) {
            e.stopPropagation();
        }
    });
    var boxes = $('#elementBoxes input:checkbox');
    boxes.change(function(e){
    var props = 0;
        $.each(boxes, function(i,b){
            props += ($(b).is(':checked'))?Math.pow(2,i):0;
        });
        //sendProps(props);

    //alert("Map Element size is now -->>> "+mapElements.length+"<<<------");
    clearIncidentList();
    for(var i=0;i<mapElements.length;i++){
        console.log("props="+props+" mapElements.props="+mapElements[i].props);
        console.log("props & mapElements[i].props="+(props & mapElements[i].props));
        console.log((((props & mapElements[i].props)>>>0) === props));
        mapElements[i].setVisible(((props & mapElements[i].props)>>>0 === props)?((props)?true:false):false);
        if(((props & mapElements[i].props)>>>0) === props) 
        {
            appendToList(mapElements[i]);

        }
    }
    });
//------------------------------------------------------------------------------

});
function sendProps(props){
    //alert(props);
}
function createPropertiesArray(mapElement){
    var disasterType = mapElement.getAttribute("disaster_type");
    var elementType = mapElement.getAttribute("elementType");
    var propArray = new Array(7);
    (elementType === "1")?propArray[6]=1:propArray[6]=0;
    //console.log(propArray[6]);
    (elementType === "2")?propArray[5]=1:propArray[5]=0;
    //console.log(propArray[5]);
    (disasterType === "Flashflood")?propArray[4]=1:propArray[4]=0;
    //console.log(propArray[4]);
    (disasterType === "Tsunami")?propArray[3]=1:propArray[3]=0;
    //console.log(propArray[3]);
    (disasterType === "Landslide")?propArray[2]=1:propArray[2]=0;
    //console.log(propArray[2]);
    (disasterType === "Mudslide")?propArray[1]=1:propArray[1]=0;
    //console.log(propArray[1]);
    (disasterType === "Infrastructure Damage")?propArray[0]=1:propArray[0]=0;
    //console.log(propArray[0]);

    return propArray;
}

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

    //marker.setMap(map);
    
    
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

function bindPolygonToSidePanel(polygon) {
    var incidentId = polygon.id;
    google.maps.event.addListener(polygon, 'click', function() {
        map.setCenter(polygon.center);
        displayDetailsFromMap(incidentId);
    });
}
function bindMarkerToSidePanel(marker) {
    var incidentId = marker.id;
    google.maps.event.addListener(marker, 'click', function() {
        map.setCenter(marker.center);
        displayDetailsFromMap(incidentId);
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

function calculateCenter(coordinates) {

    var bounds = new google.maps.LatLngBounds();

    for (var i = 0; i < coordinates.length; i++)
    {
        bounds.extend(coordinates[i]);
    }
    return bounds.getCenter();
}

function getAllMarkersPolygons() {

    console.log("***** getAllMarkersPolygons invoked *****");
    //var filterValue = document.filterForm2.filterMenu2.value;
    //console.log("FILTER VALUE 2: "+filterValue);

    initializeMap();
    clearIncidentList();
    mapElements = [];
    console.log("Map Elements array is now ----->>>>>"+mapElements.length+"<<<<<-----");

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

    var dateTo = $("#dateTo").val().replace(/-/g,'');
    var dateFrom = $("#dateFrom").val().replace(/-/g,'');
    // Change this depending on the name of your PHP file
    //alert("http://localhost/icdrris/MapController/getAllMapElements/dateTo/"+dateTo+"/dateFrom/"+dateFrom);
    downloadUrl("http://localhost/icdrris/MapController/getAllMapElements/dateTo/"+dateTo+"/dateFrom/"+dateFrom, function(data) {

        var xml = data.responseXML;
        console.log(xml);
        var polygons = xml.documentElement.getElementsByTagName("polygons")[0].getElementsByTagName("polygon");
        var markers = xml.documentElement.getElementsByTagName("markers")[0].getElementsByTagName("marker");

        //empty the Polygon array first
        //emptyArray(polygonsArray1);
        //console.log("polygons array length: "+polygonsArray1.length);
        //initialize the div for the list in the sidebar
        //and empty the output string to fill with fresh values
        var polygonIndex = 0;
        for (polygonIndex = 0; polygonIndex < polygons.length; polygonIndex++) {
            var arr = createPropertiesArray(polygons[polygonIndex]);
            var int = parseInt(arr.join(''),2);
            console.log("Integer Equivalent -->>"+int+"<<<---");
            //Extract all the elements needed for the sidebar(incident details)
            var incident_report_id = polygons[polygonIndex].getAttribute("incident_report_id");
            var disasterType = polygons[polygonIndex].getAttribute("disaster_type");
            var incidentDescription = polygons[polygonIndex].getAttribute("incident_description");
            var incidentDate = polygons[polygonIndex].getAttribute("incident_date");
            var location = polygons[polygonIndex].getAttribute("location_address");

            //============DECLARE VARIABLES=============
            var coordinates = [];
            //var bounds = new google.maps.LatLngBounds();
            var myPolygon;
            var center;
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
                visible: false, 
                strokeColor: polygonColor[disasterType],
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: polygonStroke[disasterType],
                fillOpacity: 0.35,
                arrId: polygonIndex,
                id: incident_report_id,
                disasterType: disasterType,
                incidentDescription: incidentDescription,
                incidentDate: incidentDate,
                location: location,
                center: center,
                props: int
            }

            myPolygon = new google.maps.Polygon(polyOptions);
            mapElements.push(myPolygon);
            appendToList(myPolygon);

            //APPEND THE POLYGON DETAILS TO SIDEBAR HERE
            bindPolygonToSidePanel(myPolygon);
            //appendToList(myPolygon, incident_report_id, center, polygons[polygonIndex]);

            myPolygon.setMap(map);


        }
        console.log(">>>>>>>>>>>>>>>value after polygon loop"+polygonIndex+"<<<<<<<<<<<<<<<<<<<<<");
        for (var i = 0; i < markers.length; i++) {
            var arr = createPropertiesArray(markers[i]);
            var int = parseInt(arr.join(''),2);
            console.log("Integer Equivalent -->>"+int+"<<<---");
            var incident_report_id = markers[i].getAttribute("incident_report_id");
            var disasterType = markers[i].getAttribute("disaster_type");
            var incidentDescription = markers[i].getAttribute("incident_description");
            var incidentDate = markers[i].getAttribute("incident_date");
            var location = markers[i].getAttribute("location_address");

            var icon = customIcons[disasterType] || {};
            var point = new google.maps.LatLng(
                    parseFloat(markers[i].getAttribute("lat")),
                    parseFloat(markers[i].getAttribute("lng")));

            var markerOptions = {
                position: point,
                visible:false,
                icon: icon.icon,
                shadow: icon.shadow,
                center: point,
                arrId: (polygonIndex+i),
                id: incident_report_id,
                disasterType: disasterType,
                incidentDescription: incidentDescription,
                incidentDate: incidentDate,
                location: location,
                props: int
            }
            var marker = new google.maps.Marker(markerOptions);
            mapElements.push(marker);
            appendToList(marker);

            //console.log("marker loop reached here");
            bindMarkerToSidePanel(marker);
            //appendToList(marker, id, point, markers[i]);
            marker.setMap(map);

        }
    });

}


function appendToList(mapElement) {

    //console.log("Filter menu 1: "+document.filterForm1.filterMenu1.value);
    //console.log("Filter menu 2: "+document.filterForm2.filterMenu2.value);
    //console.log("append to list started here with id");

    
    var listItem="";
    listItem += "<div class=\"accordion\" id=\"accordion" + mapElement.id + "\">";
    listItem += "<div class=\"accordion-group\">";
    listItem += "<div class=\"accordion-heading\">";
    listItem += "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" + mapElement.id + "\" href=\"#collapse" + mapElement.id + "\" style= \"display: inline-block; width: 330px;\">" + mapElement.disasterType + "</a>";
    //place icon-links here [show details]
    listItem += "<a class= \"show-details-btn\"  data-id=\"" + mapElement.id + "\"><i class= \"icon-eye-open icon-white\" data-arrId=\""+mapElement.arrId+"\"data-id=\"" + mapElement.id + "\" id= \"show-details-btn\" title= \"Show details\" style= \"margin-right: 10px;\" onclick=\"displayDetails("+mapElement.id+","+mapElement.arrId+");\"> </i></a>"; // show details icon
    //end div
    listItem += "</div>";
    listItem += "<div id=\"collapse" + mapElement.id + "\" class=\"accordion-body collapse in\">";
    listItem += "<div class=\"accordion-inner\">";
    listItem += "<p class=\"list-group-item-text\">Description :" + mapElement.incidentDescription + "<br> Date:" + mapElement.incidentDate + "<br> Location: " + mapElement.location + "</p>";
    listItem += "</div></div></div>";

    //append to the list
    var div = document.getElementById('incidentList');
    console.log(div);
    div.innerHTML = div.innerHTML + listItem;

    //map.setCenter(new google.maps.LatLng(parseFloat(markerDetails.getAttribute("lat")), parseFloat(markerDetails.getAttribute("lng"))));
}

function backToList() {
    console.log(">>>>---backToList invoked---<<<<<");
    $(".subBreadCrumb").remove();
    $("#tabbable").hide("fast");
    $("#incidentList").show("fast");
}

function clearIncidentList() {
    document.getElementById('incidentList').innerHTML = "";
}

function displayDetails(incident_report_id, arrId) {

    console.log('sdb-clicked');
    $("#incidentList").hide("fast");
    $("#table-rows-victims").removeData("fast");
    openSideBar();
    var dataStr = 'id=' + incident_report_id;
    console.log("incident report id = "+incident_report_id);


    /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Incident/incidentTitle",
        type: "POST",
        data: dataStr,
        success: function(msg) {
            console.log("success -TITLE");
            //console.log(msg);
            if (msg == 'error') {
                console.log("naay mali sa query getIncidentDetails - TITLE doy.\n ");
                $("#incident-title").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
            } else {
                console.log("success pa jud title");
                $("#incident-title").html(msg);
                $("#li0").after('<li><a class="subBreadCrumb">' + msg + '</a></li>');
                $("#victims-tab, #details-tab, #overview-li, #editinfo-li, #delete-li, #displaychart-li, #victimslist-li, #reportvictim-li").attr("data-incidentid", incident_report_id);
                $("#tabbable").show("slow");
            }
        },
        error: function() {
            console.log("system error oy!");
            console.log(values);
            $("#incident-title").html("Sorry, system error.");
            $("#tabbable").show("slow");
        }
    });

    /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Incident/incidentDetails",
        type: "POST",
        data: dataStr,
        success: function(msg) {
            console.log("success");
            //console.log(msg);
            if (msg == 'error') {
                console.log("naay mali sa query getIncidentDetails doy.\n ");
                $("#incident-information").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
                $("#tabbable").show("slow");
            } else {
                console.log("success pa jud");
                $("#incident-information").html(msg);
                $("#tabbable").show("slow");
            }
        },
        error: function() {
            console.log("system error oy!");
            console.log(values);
            $("#incident-information").html("Sorry, system error.");
            $("#tabbable").show("slow");
        }
    });

    /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Victim/viewAllVictims",
        type: "POST",
        data: dataStr,
        success: function(msg) {
            console.log("success");
            //console.log(msg);
            if (msg == 'error') {
                console.log("naay mali sa query getIncidentDetails doy.\n ");
                $("#tabbable").show("slow");
                $("#table-rows-victims").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
            } else {
                console.log("success pa jud");
                $("#tabbable").show("slow");
                $("#table-rows-victims").html(msg);
            }
        },
        error: function() {
            console.log("system error oy!");
            console.log(values);
            $("#tabbable").show("slow");
            $("#table-rows-victims").html("Sorry, system error.");
        }
    });

    map.setCenter(mapElements[arrId].center);

}

//---------------------------------------------- SECOND FUNCTION FOR THE MAP BINDING ------------------------------------------------------------

function openSideBar() {
    $("#map_canvass").addClass("span6"); //added
    $("#map_canvass").css({"float": "right"}); //added
    $(".panel").show("slow");
    $(".trigger").addClass("active");
}

function displayDetailsFromMap(incident_report_id)
{

    console.log('displayDetails invoked with id');
    $(".subBreadCrumb").remove();
    $("#incidentList").hide("fast");
    openSideBar();

    console.log(incident_report_id);

    var dataStr = 'id=' + incident_report_id;


     /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Incident/incidentTitle",
        type: "POST",
        data: dataStr,
        success: function(msg) {
            console.log("success -TITLE");
            //console.log(msg);
            if (msg == 'error') {
                console.log("naay mali sa query getIncidentDetails - TITLE doy.\n ");
                $("#incident-title").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
            } else {
                console.log("success pa jud title");
                $("#incident-title").html(msg);
                $("#li0").after('<li><a class="subBreadCrumb">' + msg + '</a></li>');
                $("#victims-tab, #details-tab, #overview-li, #editinfo-li, #delete-li, #displaychart-li, #victimslist-li, #reportvictim-li").attr("data-incidentid", incident_report_id);
                $("#tabbable").show("slow");
            }
        },
        error: function() {
            console.log("system error oy!");
            console.log(values);
            $("#incident-title").html("Sorry, system error.");
            $("#tabbable").show("slow");
        }
    });

    /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Incident/incidentDetails",
        type: "POST",
        data: dataStr,
        success: function(msg) {
            console.log("success");
            //console.log(msg);
            if (msg == 'error') {
                console.log("naay mali sa query getIncidentDetails doy.\n ");
                $("#incident-information").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
                $("#tabbable").show("slow");
            } else {
                console.log("success pa jud");
                $("#incident-information").html(msg);
                $("#tabbable").show("slow");
            }
        },
        error: function() {
            console.log("system error oy!");
            console.log(values);
            $("#incident-information").html("Sorry, system error.");
            $("#tabbable").show("slow");
        }
    });

    /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Victim/viewAllVictims",
        type: "POST",
        data: dataStr,
        success: function(msg) {
            console.log("success");
            //console.log(msg);
            if (msg == 'error') {
                console.log("naay mali sa query getIncidentDetails doy.\n ");
                $("#tabbable").show("slow");
                $("#table-rows-victims").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
            } else {
                console.log("success pa jud");
                $("#tabbable").show("slow");
                $("#table-rows-victims").html(msg);
            }
        },
        error: function() {
            console.log("system error oy!");
            console.log(values);
            $("#tabbable").show("slow");
            $("#table-rows-victims").html("Sorry, system error.");
        }
    });

}

function victimsTab() {

    $(".victims-tab, #victims-tab").click(function(event) {
        event.preventDefault();
        console.log('victims-tab-clicked');

        var incident_report_id = $(this).data('incidentid');
        console.log(incident_report_id);
        var dataStr = 'id=' + incident_report_id;

        /* Send the data using post and put results to the members table */
        request = $.ajax({
            url: "http://localhost/icdrris/Victim/viewAllVictims",
            type: "POST",
            data: dataStr,
            success: function(msg) {
                console.log("success");
                //console.log(msg);
                if (msg == 'error') {
                    console.log("naay mali sa query getIncidentDetails doy.\n ");
                    $("#tabbable").show("slow");
                    $("#table-rows-victims").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
                } else {
                    console.log("success pa jud");
                    $("#tabbable").show("slow");
                    $("#table-rows-victims").html(msg);
                }
            },
            error: function() {
                console.log("system error oy!");
                console.log(values);
                $("#tabbable").show("slow");
                $("#table-rows-victims").html("Sorry, system error.");
            }
        });
    });
}

