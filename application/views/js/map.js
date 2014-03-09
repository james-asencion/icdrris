
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
        console.log("current props ->"+props);

    //alert("Map Element size is now -->>> "+mapElements.length+"<<<------");
    $("#incidentList").html("");
    $("#respondentList").html("");
    $("#requestList").html("");

    for(var i=0;i<mapElements.length;i++){
        console.log("props="+props+" mapElements.props="+mapElements[i].props);
        console.log("props & mapElements[i].props="+(props & mapElements[i].props));
        console.log(props & mapElements[i].props);
        mapElements[i].setVisible((props & mapElements[i].props)?((props)?true:false):false);
        if(props & mapElements[i].props) 
        {
            if(mapElements[i].elementType===3){
                appendToRespondentList(mapElements[i]);
            }
            else{
                appendToIncidentList(mapElements[i]);
            }

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
    var confirmed = mapElement.getAttribute("flag_confirmed");
    var propArray = new Array(10);
    
    //console.log(propArray[6]);
    (elementType === "1")?propArray[9]=1:propArray[9]=0;
    //console.log(propArray[6]);
    (elementType === "2")?propArray[8]=1:propArray[8]=0;
    //console.log(propArray[5]);
    (disasterType === "Flashflood")?propArray[7]=1:propArray[7]=0;
    //console.log(propArray[4]);
    (disasterType === "Tsunami")?propArray[6]=1:propArray[6]=0;
    //console.log(propArray[3]);
    (disasterType === "Landslide")?propArray[5]=1:propArray[5]=0;
    //console.log(propArray[2]);
    (disasterType === "Mudslide")?propArray[4]=1:propArray[4]=0;
    //console.log(propArray[1]);
    (disasterType === "Infrastructure Damage")?propArray[3]=1:propArray[3]=0;
    //console.log(propArray[0]);
    (confirmed === "1")?propArray[2]=1:propArray[2]=0;
    (confirmed === "0")?propArray[1]=1:propArray[1]=0;
    (elementType === "3")?propArray[0]=1:propArray[0]=0;

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
    var incidentReportId = polygon.id;
    var incidentLocationId = polygon.incidentLocationId;
    google.maps.event.addListener(polygon, 'click', function() {
        displayIncidentDetailsFromMap(incidentReportId, incidentLocationId);
        map.setCenter(polygon.center);
    });
}
function bindMarkerToSidePanel(marker) {
    var incidentReportId = marker.id;
    var incidentLocationId = marker.incidentLocationId;
    google.maps.event.addListener(marker, 'click', function() {
        displayIncidentDetailsFromMap(incidentReportId, incidentLocationId);
        map.setCenter(marker.center);
    });
}
function bindRespondentToSidePanel(marker) {
    var respondentId = marker.id;
    google.maps.event.addListener(marker, 'click', function() {
        displayRespondentDetailsFromMap(respondentId, marker.response_organization_name);
        map.setCenter(marker.center);
    });
}

function bindRequestToSidePanel(marker) {
    var requestId = marker.id;
    google.maps.event.addListener(marker, 'click', function() {
        displayRequestDetailsFromMap(requestId, marker.request_info_source);
        map.setCenter(marker.center);
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


function getAllMapElements() {

    console.log("***** getAllMapElements invoked *****");
    //var filterValue = document.filterForm2.filterMenu2.value;
    //console.log("FILTER VALUE 2: "+filterValue);

    initializeMap();
    
    $("#incidentList").html("");
    $("#respondentList").html("");
    $("#requestList").html("");
    
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
        ResponseOrg: {
            icon: 'icons/health/sozialeeinrichtung.png'
        },
        Flashflood: {
            icon: 'icons/naturaldisaster/flood1.png',
            shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
        },
        Mudslide: {
            icon: 'icons/nd/flood.png',
            shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
        },
        Landslide: {
            icon: 'icons/nd/avalanche1.png',
            shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
        },
        Default: {
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
        var respondents = xml.documentElement.getElementsByTagName("responseOrganizations")[0].getElementsByTagName("responseOrganization");
        var requests = xml.documentElement.getElementsByTagName("requests")[0].getElementsByTagName("request");

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
            var incident_location_id = polygons[polygonIndex].getAttribute("incident_location_id");
            var disasterType = polygons[polygonIndex].getAttribute("disaster_type");
            var incidentDescription = polygons[polygonIndex].getAttribute("incident_description");
            var incidentDate = polygons[polygonIndex].getAttribute("incident_date");
            var location = polygons[polygonIndex].getAttribute("location_address");
            var flagConfirmed = polygons[polygonIndex].getAttribute("flag_confirmed");
            var flagTrueRating = polygons[polygonIndex].getAttribute("flag_true_rating");
            var flagFalseRating = polygons[polygonIndex].getAttribute("flag_false_rating");
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
                incidentLocationId: incident_location_id,
                disasterType: disasterType,
                incidentDescription: incidentDescription,
                incidentDate: incidentDate,
                location: location,
                flagConfirmed: flagConfirmed,
                flagTrueRating: flagTrueRating,
                flagFalseRating: flagFalseRating,
                center: center,
                elementType: 2,
                props: int
            }

            myPolygon = new google.maps.Polygon(polyOptions);
            mapElements.push(myPolygon);
            appendToIncidentList(myPolygon);

            //APPEND THE POLYGON DETAILS TO SIDEBAR HERE
            bindPolygonToSidePanel(myPolygon);
            //appendToList(myPolygon, incident_report_id, center, polygons[polygonIndex]);

            myPolygon.setMap(map);


        }
        console.log(">>>>>>>>>>>>>>>value after polygon loop"+polygonIndex+"<<<<<<<<<<<<<<<<<<<<<");
        var markerIndex=polygonIndex+1;
        var i=0;
        for (i = 0; i < markers.length; i++) {
            var arr = createPropertiesArray(markers[i]);
            var int = parseInt(arr.join(''),2);
            console.log("Integer Equivalent -->>"+int+"<<<---");
            var incident_report_id = markers[i].getAttribute("incident_report_id");
            var incident_location_id = markers[i].getAttribute("incident_location_id");
            var disasterType = markers[i].getAttribute("disaster_type");
            var incidentDescription = markers[i].getAttribute("incident_description");
            var incidentDate = markers[i].getAttribute("incident_date");
            var location = markers[i].getAttribute("location_address");
            var flagConfirmed = markers[i].getAttribute("flag_confirmed");
            var flagTrueRating = markers[i].getAttribute("flag_true_rating");
            var flagFalseRating = markers[i].getAttribute("flag_false_rating");

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
                incidentLocationId: incident_location_id,
                disasterType: disasterType,
                incidentDescription: incidentDescription,
                incidentDate: incidentDate,
                location: location,
                flagConfirmed: flagConfirmed,
                flagTrueRating: flagTrueRating,
                flagFalseRating: flagFalseRating,
                elementType:1,
                props: int
            }
            var marker = new google.maps.Marker(markerOptions);
            mapElements.push(marker);
            appendToIncidentList(marker);

            //console.log("marker loop reached here");
            bindMarkerToSidePanel(marker);
            //appendToList(marker, id, point, markers[i]);
            marker.setMap(map);

        }

        var j=0;
        for (j = 0; j < respondents.length; j++) {
            var arr = createPropertiesArray(respondents[j]);
            var int = parseInt(arr.join(''),2);
            console.log("Integer Equivalent -->>"+int+"<<<---");

            var response_organization_location_id = respondents[j].getAttribute("response_organization_location_id");
            var response_organization_name = respondents[j].getAttribute("response_organization_name");
            var activity_start_date = respondents[j].getAttribute("activity_start_date");
            var activity_end_date = respondents[j].getAttribute("activity_end_date");
            var activity_status = respondents[j].getAttribute("activity_status");
            var activity_description = respondents[j].getAttribute("activity_description");
            var location_address = respondents[j].getAttribute("location_address");


            var icon = customIcons['ResponseOrg'] || {};
            var point = new google.maps.LatLng(
                    parseFloat(respondents[j].getAttribute("deployment_lat")),
                    parseFloat(respondents[j].getAttribute("deployment_lng")));

            
            var markerOptions = {
                position: point,
                visible:false,
                icon: icon.icon,
                shadow: icon.shadow,
                center: point,
                arrId: (polygonIndex+i+j),
                id: response_organization_location_id,
                response_organization_name: response_organization_name,
                incidentDescription: incidentDescription,
                activity_start_date: activity_start_date,
                activity_end_date: activity_end_date,
                activity_status:activity_status,
                activity_description:activity_description,
                location_address:location_address,
                elementType: 3,
                props: int
            }
            var marker = new google.maps.Marker(markerOptions);
            mapElements.push(marker);
            appendToRespondentList(marker);

            //console.log("marker loop reached here");
            bindRespondentToSidePanel(marker);
            //appendToList(marker, id, point, markers[i]);
            marker.setMap(map);

        }
		
		  var j=0;
        for (j = 0; j < requests.length; j++) {
            var arr = createPropertiesArray(requests[j]);
            var int = parseInt(arr.join(''),2);
            console.log("Integer Equivalent -->>"+int+"<<<---");

            var request_id = requests[j].getAttribute("request_id");
            var location_id = requests[j].getAttribute("location_id");
            var tweet_id = requests[j].getAttribute("tweet_id");
            var request_date = requests[j].getAttribute("request_date");
            var request_status = requests[j].getAttribute("request_status");
            var request_comments = requests[j].getAttribute("request_comments");
            var flag_request_granted = requests[j].getAttribute("flag_request_granted");
            var tweet_user_id = requests[j].getAttribute("tweet_user_id");
            var request_url = requests[j].getAttribute("request_url");
            var geo_place_name = requests[j].getAttribute("geo_place_name");


            var icon = customIcons['Default'] || {};
            var point = new google.maps.LatLng(
                    parseFloat(requests[j].getAttribute("geo_lat")),
                    parseFloat(requests[j].getAttribute("geo_lng")));

            
            var markerOptions = {
                position: point,
                visible:false,
                icon: icon.icon,
                shadow: icon.shadow,
                center: point,
                arrId: (polygonIndex+i+j),
                id: request_id,
                tweet_id: tweet_id,
                request_date: request_date,
                request_status: request_status,
                request_comments: request_comments,
                flag_request_granted:flag_request_granted,
                tweet_user_id:tweet_user_id,
                request_url:request_url,
                geo_place_name:geo_place_name,
                elementType: 3,
                props: int
            }
            var marker = new google.maps.Marker(markerOptions);
            mapElements.push(marker);
            appendToRequestList(marker);

            //console.log("marker loop reached here");
            bindRespondentToSidePanel(marker);
            //appendToList(marker, id, point, markers[i]);
            marker.setMap(map);

        }
  
    });

}

function appendToIncidentList(mapElement) {

    //console.log("Filter menu 1: "+document.filterForm1.filterMenu1.value);
    //console.log("Filter menu 2: "+document.filterForm2.filterMenu2.value);
    //console.log("append to list started here with id");

    
    var listItem="";
    listItem += "<div class=\"accordion\" id=\"accordion" + mapElement.id + "\">";
    listItem += "<div class=\"accordion-group\">";
    listItem += "<div class=\"accordion-heading\">";
    listItem += "<label class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" + mapElement.id + "\" href=\"#collapse" + mapElement.id + "\" style= \"display: inline-block; width: 200px; color: white;\">" + mapElement.disasterType + "</label>";
    //place icon-links here [show details]
    listItem += "<a class= \"show-details-btn\"  data-id=\"" + mapElement.id + "\" onclick=\"displayIncidentDetails("+mapElement.id+","+mapElement.arrId+","+mapElement.incidentLocationId+");\">Open</a>"; // show details icon
   var sess_user = get_session();
    if(mapElement.flagConfirmed == 0 && (sess_user == 'cdrrmo' || sess_user == 'bdrrmo')){
    //if(mapElement.flagConfirmed == 0){
      listItem += "| <a href=\"#\" id=\"confirm-incident\" role=\"button\" data-toggle=\"modal\"   data-id=\"" + mapElement.id + "\" onclick=\"confirmIncident("+mapElement.incidentLocationId+", '"+mapElement.incidentDescription+"');\"> Confirm Report </a>"; // confirm icon
    }
  
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


function appendToRespondentList(mapElement) {

    //console.log("Filter menu 1: "+document.filterForm1.filterMenu1.value);
    //console.log("Filter menu 2: "+document.filterForm2.filterMenu2.value);
    //console.log("append to list started here with id");

    
    var listItem="";
    listItem += "<div class=\"accordion\" id=\"accordion" + mapElement.id + "\">";
    listItem += "<div class=\"accordion-group\">";
    listItem += "<div class=\"accordion-heading\">";
    listItem += "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" + mapElement.id + "\" href=\"#collapse" + mapElement.id + "\" style= \"display: inline-block; width: 200px;\">" + mapElement.response_organization_name + "</a>";
    //place icon-links here [show details]
    listItem += "| <a class= \"label label-info\"  data-id=\"" + mapElement.id + "\" onclick=\"displayRespondentDetails("+mapElement.id+","+mapElement.arrId+");\"><i class= \"icon-eye-open icon-white\" data-arrId=\""+mapElement.arrId+"\"data-id=\"" + mapElement.id + "\" id= \"show-details-btn\" title= \"Show details\"> </i> Open </a> "; // show details icon
    //end div
    listItem += "</div>";
    listItem += "<div id=\"collapse" + mapElement.id + "\" class=\"accordion-body collapse in\">";
    listItem += "<div class=\"accordion-inner\">";
    listItem += "<p class=\"list-group-item-text\">Activity Description :" + mapElement.activity_description + "<br> Activity Start Date:" + mapElement.activity_start_date + "<br> Deployment Location: " + mapElement.location_address + "</p>";
    listItem += "</div></div></div>";

    //append to the list
    var div = document.getElementById('respondentList');
    //console.log(div);
    div.innerHTML = div.innerHTML + listItem;

    //map.setCenter(new google.maps.LatLng(parseFloat(markerDetails.getAttribute("lat")), parseFloat(markerDetails.getAttribute("lng"))));
}

function appendToRequestList(mapElement) {

    //console.log("Filter menu 1: "+document.filterForm1.filterMenu1.value);
    //console.log("Filter menu 2: "+document.filterForm2.filterMenu2.value);
    //console.log("append to list started here with id");

    
    var listItem="";
    listItem += "<div class=\"accordion\" id=\"accordion" + mapElement.id + "\">";
    listItem += "<div class=\"accordion-group\">";
    listItem += "<div class=\"accordion-heading\">";
    listItem += "<a href=\""+mapElement.request_url+"\"> "+ mapElement.request_info_source + "</a><a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" + mapElement.id + "\" href=\"#collapse" + mapElement.id + "\" style= \"display: inline-block; width: 330px;\"></a>";
    //place icon-links here [show details]
    listItem += "| <a class= \"label label-info\"  data-id=\"" + mapElement.id + "\" onclick=\"displayRequestDetails("+mapElement.id+","+mapElement.arrId+");\"><i class= \"icon-eye-open icon-white\" data-arrId=\""+mapElement.arrId+"\"data-id=\"" + mapElement.id + "\" id= \"show-details-btn\" title= \"Show details\"> </i> Open </a> "; // show details icon
    //end div
    listItem += "</div>";
    listItem += "<div id=\"collapse" + mapElement.id + "\" class=\"accordion-body collapse in\">";
    listItem += "<div class=\"accordion-inner\">";
    listItem += "<p class=\"list-group-item-text\">Tweet :" + mapElement.request_comments + "<br> Request Date:" + mapElement.request_date + "<br> Tweet Location: " + mapElement.geo_place_name + "</p>";
    listItem += "</div></div></div>";

    //append to the list
    var div = document.getElementById('requestList');
    //console.log(div);
    div.innerHTML = div.innerHTML + listItem;

    //map.setCenter(new google.maps.LatLng(parseFloat(markerDetails.getAttribute("lat")), parseFloat(markerDetails.getAttribute("lng"))));
}

function backToHome(){
    $("#incidentList").hide();
    $(".incidentTabbable").hide();
    $("#respondentList").hide();
    $(".respondentTabbable").hide();
    $("#requestList").hide();
    $(".requestTabbable").hide();
    $("#homeView").show("fast");
    $(".subBreadCrumb2").remove();
    $("#subBreadCrumb1").remove();
}
function incidentList(){
    
    $("#homeView").hide();
    $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToIncidentList()" class="subBreadCrumb1" >Incidents List</a><span class="divider">/</span></li>');
    openSideBar();
    $("#incidentList").show("fast");

}
function respondentList(){
    $("#homeView").hide();
    $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToRespondentList()" class="subBreadCrumb1" id="subBreadCrumb1">Respondents List</a><span class="divider">/</span></li>');
    $("#respondentList").show("fast");
}
function requestList(){
    $("#homeView").hide();
    $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToRequestList()" class="subBreadCrumb1" id="subBreadCrumb1">Requests List</a><span class="divider">/</span></li>');
    $("#requestList").show("fast");
}
function backToIncidentList() {
    console.log(">>>>---backToIncidentList invoked---<<<<<");
    $(".subBreadCrumb2").remove();
    $(".incidentTabbable").hide();
    $("#IncidentTabbable").hide("fast");
    $("#incidentList").show("fast");
}
function backToRespondentList() {
    console.log(">>>>---backToRespondentList invoked---<<<<<");
    $(".subBreadCrumb2").remove();
    $(".respondentTabbable").hide();
    $("#respondentTabbable").hide("fast");
    $("#respondentList").show("fast");
}
function backToRequestList() {
    console.log(">>>>---backToRequestList invoked---<<<<<");
    $(".subBreadCrumb2").remove();
    $(".requestTabbable").hide();
    $("#requestTabbable").hide("fast");
    $("#requestList").show("fast");
}

function displayIncidentDetails(incidentReportId, elementId, incident_location_id) {

    console.log('display Incident details clicked with incident_report_id ->'+incidentReportId);
    $("#incidentList").hide("fast");
    $("#table-rows-victims").removeData("fast");
    openSideBar();

    $(".approve-li").attr("id", "approve-li"+incident_location_id+"");
    $(".disapprove-li").attr("id", "disapprove-li"+incident_location_id+"");
                
    request = $.ajax({
        url: "http://localhost/icdrris/Incident/incidentTitle",
        type: "POST",
        data: {incident_report_id:incidentReportId},
        success: function(msg) {
            console.log("success -TITLE");
			
            if (msg == 'error') {
                console.log("Error getIncidentDetails - TITLE doy.\n ");
                $("#incident-title").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
            } else {
                console.log("Success getIncidentTitle");
                $("#incident-title").html(msg);
                var str = msg.substring(0,30) + "...";
                $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + str + '</a></li>');
                
                $("#victims-tab, #victimslist-li, #reportvictim-li").attr("data-incidentid", incidentReportId);
		
                $("#delete-li").attr("data-incidentdesc", msg);
                $("#incidentTabbable").show("slow");
            }
        },
        error: function() {
            console.log("system error oy!");
            console.log(values);
            $("#incident-title").html("Sorry, system error.");
            $("#incidentTabbable").show("slow");
        }
    });

    /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Incident/incidentDetails",
        type: "POST",
        data: {incident_location_id:incident_location_id},
        success: function(msg) {
            if (msg == 'error') {
                $("#incident-information").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
                $("#incidentTabbable").show("slow");
            } else {
                $(" #details-tab, #overview-li, #editinfo-li, #delete-li, .approve-li, .disapprove-li").attr("data-incidentid", incident_location_id)
                $("#incident-information").html(msg);
                $("#incidentTabbable").show("slow");
            }
        },
        error: function() {
            console.log("system error oy!");
            console.log(values);
            $("#incident-information").html("Sorry, system error.");
            $("#incidentTabbable").show("slow");
        }
    });
    
                         

    /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Victim/viewAllVictims",
        type: "POST",
        data: {id:incidentReportId},
        success: function(msg) {
            console.log("success");
            //console.log(msg);
            if (msg == 'error') {
                console.log("naay mali sa query getIncidentDetails doy.\n ");
                $("#tabbable").show("slow");
                $("#table-rows-victims").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
            } else {
                console.log("success pa jud");
                $("#incidentTabbable").show("slow");
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

    map.setCenter(mapElements[elementId].center);
    mapElements[elementId].setAnimation(google.maps.Animation.BOUNCE);
    stopAnimation(mapElements[elementId]);


}

//---------------------------------------------- SECOND FUNCTION FOR THE MAP BINDING ------------------------------------------------------------
/**
function getTrueRate(incident_location_id){
    var trueRate;
     $(document).ready(function(){
        $.ajax({
                  url: "http://localhost/icdrris/Login/get_session",
                  type: "POST",
                  data: {},
                  success: function(msg){
                          trueRate= msg;
                  },
                  error: function(msg){
                          alert('Error!');
                  }
        });
    });
  
    return trueRate;
}

function getFalseRate(incident_location_id){
     var falseRate="";
    $(document).ready(function(){
        $.ajax({
                  url: "http://localhost/icdrris/Incident/getFalseRate",
                  type: "POST",
                  data: {incident_location_id:incident_location_id},
                  success: function(msg){
                          falseRate= msg;
                  },
                  error: function(msg){
                          alert('Error!');
                  }
        });
    });
  
    return falseRate;
}
*/
function openSideBar() {
    $("#map_canvass").removeClass("span12");
    $("#map_canvass").addClass("span8"); //added
    $("#map_canvass").css({"float":"right"}); //added
    google.maps.event.trigger(map_canvas, 'resize');
    $(".panel").show("fast");
    $(".trigger").addClass("active");
}

function displayIncidentDetailsFromMap(incidentReportId, incidentLocationId)
{

    console.log('displayDetails invoked with id'+incidentReportId);
    openSideBar();
    backToHome();
    $("#homeView").hide();
    $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToIncidentList()" class="subBreadCrumb1" >Incidents List</a><span class="divider">/</span></li>');
    $(".subBreadCrumb2").remove();

    console.log(incidentReportId);

     /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Incident/incidentTitle",
        type: "POST",
        data: {incident_report_id:incidentReportId},
        success: function(msg) {
            console.log("success -TITLE");
            //console.log(msg);
            if (msg == 'error') {
                console.log("naay mali sa query getIncidentDetails - TITLE doy.\n ");
                $("#incident-title").html("Sorry, something went wrong. Please contact the administrator to fix the bug.\n ");
            } else {
                console.log("success pa jud title");
                $("#incident-title").html(msg);
                $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + msg + '</a></li>');
                $("#victims-tab, #details-tab, #overview-li, #editinfo-li, #delete-li, #displaychart-li, #victimslist-li, #reportvictim-li").attr("data-incidentid", incidentReportId);
                $("#incidentTabbable").show("slow");
            }
        },
        error: function() {
            console.log("system error oy!");
            console.log(values);
            $("#incident-title").html("Sorry, system error.");
            $("#incidentTabbable").show("slow");
        }
    });

    /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Incident/incidentDetails",
        type: "POST",
        data: {incident_location_id:incidentLocationId},
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
            $("#incidentTabbable").show("slow");
        }
    });

    /* Send the data using post and put results to the members table */
    request = $.ajax({
        url: "http://localhost/icdrris/Victim/viewAllVictims",
        type: "POST",
        data: {id:incidentReportId},
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
            $("#incidentTabbable").show("slow");
            $("#table-rows-victims").html("Sorry, system error.");
        }
    });

}

//================================== EDIT HERE ===================================================================================
//================================================================================================================================
function displayRespondentDetailsFromMap(deployment_id,element)
{

    console.log('displayDetails invoked with id');
    backToHome();
    $("#homeView").hide();
    openSideBar();

    //alert("respondent id ->"+deployment_id);
    $("#respondentTabbable").show("slow");
    $("#respondent-membersTable").show("slow");

     /*retrieve the response organization name to be used in the breadcrumbs*/
    request = $.ajax({
        url: "http://localhost/icdrris/ResponseOrg/getDeployedOrganizationDetails",
        type: "POST",
        data: {id:deployment_id},
        success: function(msg) {
                $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToRespondentList()" class="subBreadCrumb1" id="subBreadCrumb1">Respondents List</a><span class="divider">/</span></li>');
                $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + element.response_organization_name + '</a></li>');
                $(".respondentTabbable").show("slow");
                 $("#respondent-information").html(msg);
        },
        error: function() {
            console.log("error retrieving response organization name");
            console.log(msg);
        }
    });

    /* retrieve table of deployed members */
    request = $.ajax({
        url: "http://localhost/icdrris/ResponseOrg/getAllDeployedMembers",
        type: "POST",
        data: {orgId:deployment_id},
        success: function(msg) {
            console.log("successfully retrieved all members");
            $("#respondent-membersTable").html(msg);
        },
        error: function() {
            console.log("unable to fetch deployed members table");
            console.log(msg);
        }
    });

}

function displayRespondentDetails(deployment_id,elementId)
{

    console.log('displayDetails invoked with id->'+deployment_id);
    //$("#subBreadCrumb1").remove();
    $("#respondentList").hide("fast");
    //openSideBar();

    //alert("respondent id ->"+deployment_id);

     /*retrieve the response organization name to be used in the breadcrumbs*/
    $("#respondentTabbable").show("slow");
    $("#respondent-membersTable").show("slow");

     /*retrieve the response organization name to be used in the breadcrumbs*/
    request = $.ajax({
        url: "http://localhost/icdrris/ResponseOrg/getDeployedOrganizationName",
        type: "POST",
        data: {id:deployment_id},
        success: function(name) {
            $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + name + '</a></li>');
        },
        error: function() {
            console.log("error retrieving response organization name");
            console.log(name);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/ResponseOrg/getDeployedOrganizationDetails",
        type: "POST",
        data: {id:deployment_id},
        success: function(msg) {$(".respondentTabbable").show("slow");
                 $("#respondent-information").html(msg);
        },
        error: function() {
            console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });

    /* retrieve table of deployed members */
    request = $.ajax({
        url: "http://localhost/icdrris/ResponseOrg/getAllDeployedMembers",
        type: "POST",
        data: {orgId:deployment_id},
        success: function(msg) {
            console.log("successfully retrieved all members");
            $("#respondent-membersTable").html(msg);
        },
        error: function() {
            console.log("unable to fetch deployed members table");
            console.log(msg);
        }
    });

    map.setCenter(mapElements[elementId].center);
    mapElements[elementId].setAnimation(google.maps.Animation.BOUNCE);
    stopAnimation(mapElements[elementId]);

}


//================================================================================================================================
//================================================================================================================================

//================================== EDIT HERE ===================================================================================
//================================================================================================================================
function displayRequestDetailsFromMap(request_id)
{

    console.log('displayRequest invoked with id->'+request_id);
    $(".subBreadCrumb").remove();
    $("#requestList").hide("fast");
    openSideBar();

    alert("request id ->"+request_id);

     /*retrieve the response organization name to be used in the breadcrumbs*/
    request = $.ajax({
        url: "http://localhost/icdrris/Request/getRequestHeader",
        type: "POST",
        data: {id:request_id},
        success: function(header) {
                $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + header + '</a></li>');
                $("#requestTabbable").show("slow");
        },
        error: function(header) {
            console.log("error retrieving request details");
            console.log(header);
        }
    });

    /* retrieve the response organization details */
    request = $.ajax({
        url: "http://localhost/icdrris/Request/getRequestDetails",
        type: "POST",
        data: {id:deployment_id},
        success: function(details) {
            $("#request-information").html(details);
        },
        error: function() {
            console.log("unable to fetch request details");
            console.log(details);
        }
    });

}

function displayRequestDetails(request_id, elementId)
{

    console.log('displayRequest invoked with id->'+request_id);
    $(".subBreadCrumb").remove();
    $("#requestList").hide("fast");
    openSideBar();

    alert("request id ->"+request_id);

     /*retrieve the response organization name to be used in the breadcrumbs*/
    request = $.ajax({
        url: "http://localhost/icdrris/Request/getRequestHeader",
        type: "POST",
        data: {id:request_id},
        success: function(header) {
                $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + header + '</a></li>');
                $("#requestTabbable").show("slow");
        },
        error: function(header) {
            console.log("error retrieving request details");
            console.log(header);
        }
    });

    /* retrieve the response organization details */
    request = $.ajax({
        url: "http://localhost/icdrris/Request/getRequestDetails",
        type: "POST",
        data: {id:deployment_id},
        success: function(details) {
            $("#request-information").html(details);
        },
        error: function() {
            console.log("unable to fetch request details");
            console.log(details);
        }
    });

    map.setCenter(mapElements[elementId].center);

}
//================================================================================================================================
//================================================================================================================================

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

