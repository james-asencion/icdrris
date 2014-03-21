
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
        //console.log("current props ->"+props);

    //alert("Map Element size is now -->>> "+mapElements.length+"<<<------");
    $("#incidentList").html("");
    $("#livelihoodList").html("");
    $("#barangayList").html("");
    for(var i=0;i<mapElements.length;i++){

        //console.log("current props ->"+props);
        //console.log("map elements props 4 ->"+mapElements[i].props4);
        //console.log("mapElements element Type->"+mapElements[i].elementType)
        var filterPropBinary = props.toString(2);
        var length = filterPropBinary.length;


        filterProp1 = parseInt(filterPropBinary.substring(length-2), 2);
        filterProp2 = parseInt(filterPropBinary.substring(length-7, length-2), 2);
        filterProp3 = parseInt(filterPropBinary.substring(length-9, length-7), 2);

        if( mapElements[i].elementType === 3){
            //console.log("props : "+props+"  elementProps : "+mapElements[i].props4);
        }
        if(!props){
            //do nothing
            //console.log("nothing to do here");
            mapElements[i].setVisible(false);
        }
        //if the selected filter is only the map elements filter
        else if(!(props & 384) && !(props & 124)){
            console.log("disregard filter for confirmed/unconfirmed AND disaster type");
            
            var evaluation = ((filterProp1 & mapElements[i].props1)|(props & mapElements[i].props4));
            //console.log("element no."+i+"  ,props1="+mapElements[i].props1+"  filterProps1:"+filterProp1);
            //console.log("evaluation is "+evaluation);
            mapElements[i].setVisible((evaluation)?((props)?true:false):false);
            if(evaluation) 
            {
                if(mapElements[i].elementType === 3){
                    //alert("append to livelihood list");
                    appendToLivelihoodList(mapElements[i]);
                }
                else if(mapElements[i].elementType === 6){
                    appendToBarangayList(mapElements[i]);
                } 
                else{
                    //alert("append to incident list");
                    appendToIncidentList(mapElements[i]);
                }
            }
            else{
                console.log("***************** evaluation failed *******************")
            }

        }
        //if the selected filter is only the disaster type filter
        else if(!(props & 384) && !(props & 3)){
            console.log("disregard filter for markers/polygons AND confirmed/unconfirmed");
            //console.log("element no."+i+" , props2="+mapElements[i].props2);
            //console.log("element no."+i+" , props4="+mapElements[i].props4);
            mapElements[i].setVisible((filterProp2 & mapElements[i].props2)|(props & mapElements[i].props4)?((props)?true:false):false);
            if((filterProp2 & mapElements[i].props2)|(props & mapElements[i].props4)) 
            {
                if(mapElements[i].elementType === 3){
                    appendToLivelihoodList(mapElements[i]);
                } 
                else if(mapElements[i].elementType === 6){
                    appendToBarangayList(mapElements[i]);
                } 
                else{
                    appendToIncidentList(mapElements[i]);
                }
            }
        }
        //if the selected filter is the confirmed/unconfirmed filter
        else if(!(props & 3) && !(props & 124)){
            console.log("disregard filter for marrker/polygon AND disaster type");
            
            var evaluation = ((filterProp3 & mapElements[i].props3)|(props & mapElements[i].props4));
            //console.log("element no."+i+"  ,props1="+mapElements[i].props1+"  filterProps1:"+filterProp1);
            //console.log("evaluation is "+evaluation);
            mapElements[i].setVisible((evaluation)?((props)?true:false):false);
            if(evaluation) 
            {
                if(mapElements[i].elementType === 3){
                    appendToLivelihoodList(mapElements[i]);
                } 
                else if(mapElements[i].elementType === 6){
                    appendToBarangayList(mapElements[i]);
                } 
                else{
                    appendToIncidentList(mapElements[i]);
                }
            }
        }
        //when the filters selected are the element type and and disaster type filters
        else if(!(props & 384)){
            console.log("disregard filter for confirmed/unconfirmed");
            
            var evaluation = ((filterProp1 & mapElements[i].props1) && (filterProp2 & mapElements[i].props2))|(props & mapElements[i].props4);
            //console.log("element no."+i+"  ,props1="+mapElements[i].props1+"  filterProps1:"+filterProp1);
            //console.log("evaluation is "+evaluation);
            mapElements[i].setVisible((evaluation)?((props)?true:false):false);
            if(evaluation) 
            {
                if(mapElements[i].elementType === 3){
                    appendToLivelihoodList(mapElements[i]);
                } 
                else if(mapElements[i].elementType === 6){
                    appendToBarangayList(mapElements[i]);
                } 
                else{
                    appendToIncidentList(mapElements[i]);
                }
            }
        }
        //when the selected filters are the element type and confirmation 
        else if(!(props & 124)){
            console.log("disregard filter for disaster type");
            
            var evaluation = ((filterProp1 & mapElements[i].props1) && (filterProp3 & mapElements[i].props3))|(props & mapElements[i].props4);
            //console.log("element no."+i+"  ,props1="+mapElements[i].props1+"  filterProps1:"+filterProp1);
            //console.log("evaluation is "+evaluation);
            mapElements[i].setVisible((evaluation)?((props)?true:false):false);
            if(evaluation) 
            {
                if(mapElements[i].elementType === 3){
                    appendToLivelihoodList(mapElements[i]);
                } 
                else if(mapElements[i].elementType === 6){
                    appendToBarangayList(mapElements[i]);
                } 
                else{
                    appendToIncidentList(mapElements[i]);
                }
            }
        }
        //when the selected filters are the disaster type and confirmation
        else if(!(props & 3)){
            console.log("disregard filter for element type");
            
            var evaluation = ((filterProp2 & mapElements[i].props2) && (filterProp3 & mapElements[i].props3))|(props & mapElements[i].props4);
            //console.log("element no."+i+"  ,props1="+mapElements[i].props1+"  filterProps1:"+filterProp1);
            //console.log("evaluation is "+evaluation);
            mapElements[i].setVisible((evaluation)?((props)?true:false):false);
            if(evaluation) 
            {
                if(mapElements[i].elementType === 3){
                    appendToLivelihoodList(mapElements[i]);
                } 
                else if(mapElements[i].elementType === 6){
                    appendToBarangayList(mapElements[i]);
                } 
                else{
                    appendToIncidentList(mapElements[i]);
                }
            }
        }
        //when all the filters are selected
        else{
            console.log("APPLY ALL FILTERS");
            
            var evaluation = ((filterProp1 & mapElements[i].props1) && (filterProp2 & mapElements[i].props2) && (filterProp3 & mapElements[i].props3))|(props & mapElements[i].props4);
            //console.log("element no."+i+"  ,props1="+mapElements[i].props1+"  filterProps1:"+filterProp1);
            //console.log("evaluation is "+evaluation);
            mapElements[i].setVisible((evaluation)?((props)?true:false):false);
            if(evaluation) 
            {
                if(mapElements[i].elementType === 3){
                    appendToLivelihoodList(mapElements[i]);
                } 
                else if(mapElements[i].elementType === 6){
                    appendToBarangayList(mapElements[i]);
                } 
                else{
                    appendToIncidentList(mapElements[i]);
                }
            }
        }
    }

console.log("=================================================================================================================================");
    });
//------------------------------------------------------------------------------

});

function createPropertiesArray1(mapElement){

    var elementType = mapElement.getAttribute("elementType");
    var propArray = new Array(2);
    
    //console.log(propArray[6]);
    (elementType === "1")?propArray[1]=1:propArray[1]=0;
    //console.log(propArray[6]);
    (elementType === "2")?propArray[0]=1:propArray[0]=0;

    return propArray;
}
function createPropertiesArray2(mapElement){
    var disasterType = mapElement.getAttribute("disaster_type");
    var propArray = new Array(5);
    
    (disasterType === "Flashflood")?propArray[4]=1:propArray[4]=0;
    //console.log(propArray[4]);
    (disasterType === "Tsunami")?propArray[3]=1:propArray[3]=0;
    //console.log(propArray[3]);
    (disasterType === "Landslide")?propArray[2]=1:propArray[2]=0;
    //console.log(propArray[2]);
    (disasterType === "Mudslide")?propArray[1]=1:propArray[1]=0;
    //console.log(propArray[1]);
    (disasterType === "Infrastructure Damage")?propArray[0]=1:propArray[0]=0;

    return propArray;
}
function createPropertiesArray3(mapElement){

    var confirmed = mapElement.getAttribute("flag_confirmed");
    var propArray = new Array(2);
    
    (confirmed === "1")?propArray[1]=1:propArray[1]=0;
    (confirmed === "0")?propArray[0]=1:propArray[0]=0;

    return propArray;
}
function createPropertiesArray4(mapElement){
    var elementType = mapElement.getAttribute("elementType");
    var prop = 0;

    prop += (elementType === "3")?Math.pow(2,9):0;
    prop += (elementType === "6")?Math.pow(2,10):0;

    

    return prop;
}
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

function bindPolygonToSidePanel(polygon) {
    var incidentReportId = polygon.id;
    var incidentLocationId = polygon.incidentLocationId;
    google.maps.event.addListener(polygon, 'click', function() {
        //alert("element props: "+polygon.elementProps+ " disaster type props: "+polygon.disasterTypeProps+" confirmation props"+polygon.statusProps+" respondent props: "+polygon.respondentProps);
        displayIncidentDetailsFromMap(incidentReportId, incidentLocationId);
        map.setCenter(polygon.center);
    });
}
function bindBarangayToSidePanel(polygon) {
    var location_id = polygon.id;
    google.maps.event.addListener(polygon, 'click', function() {
        displayBarangayDetailsFromMap(location_id);
        map.setCenter(polygon.center);
    });
}
function bindMarkerToSidePanel(marker) {
    var incidentReportId = marker.id;
    var incidentLocationId = marker.incidentLocationId;
    google.maps.event.addListener(marker, 'click', function() {
        //alert("element props: "+marker.elementProps+ " disaster type props: "+marker.disasterTypeProps+" confirmation props"+marker.statusProps+" respondent props: "+marker.respondentProps);
        displayIncidentDetailsFromMap(incidentReportId, incidentLocationId);
        map.setCenter(marker.center);
    });
}
function bindLivelihoodToSidePanel(marker) {
    var livelihoodId = marker.id;
    google.maps.event.addListener(marker, 'click', function() {
        //alert("element props: "+marker.elementProps+ " disaster type props: "+marker.disasterTypeProps+" confirmation props"+marker.statusProps+" respondent props: "+marker.respondentProps);
        //alert("marker clicked");
        displayLivelihoodDetailsFromMap(livelihoodId);
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
    
    $("#incidentList").html("");

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

    var customIcons = {
        ResponseOrg: {
            icon: 'icons/health/sozialeeinrichtung.png'
        },
        Needs: {
            icon: 'icons/flag.png'
        },
        Livelihood: {
            icon: 'icons/livelihood.png'
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

    downloadUrl("http://localhost/icdrris/MapController/getLivelihoodMappingElements/dateTo/"+dateTo+"/dateFrom/"+dateFrom, function(data) {

        var xml = data.responseXML;
        console.log(xml);
        var polygons = xml.documentElement.getElementsByTagName("polygons")[0].getElementsByTagName("polygon");
        var markers = xml.documentElement.getElementsByTagName("markers")[0].getElementsByTagName("marker");
        var organizations = xml.documentElement.getElementsByTagName("livelihoodOrganizations")[0].getElementsByTagName("livelihoodOrganization");
        var barangays = xml.documentElement.getElementsByTagName("barangays")[0].getElementsByTagName("barangay");
        //empty the Polygon array first
        //emptyArray(polygonsArray1);
        //console.log("polygons array length: "+polygonsArray1.length);
        //initialize the div for the list in the sidebar
        //and empty the output string to fill with fresh values
        var polygonIndex = 0;
        for (polygonIndex = 0; polygonIndex < polygons.length; polygonIndex++) {

            var arr1 = createPropertiesArray1(polygons[polygonIndex]);
            var int1 = parseInt(arr1.join(''),2);

            var arr2 = createPropertiesArray2(polygons[polygonIndex]);
            var int2 = parseInt(arr2.join(''),2);

            var arr3 = createPropertiesArray3(polygons[polygonIndex]);
            var int3 = parseInt(arr3.join(''),2);

            var int4 = createPropertiesArray4(polygons[polygonIndex]);

            //console.log("Integer Equivalent -->>"+int+"<<<---");
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
                props1: int1,
                props2: int2, 
                props3: int3,
                props4: int4
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
            var arr1 = createPropertiesArray1(markers[i]);
            var int1 = parseInt(arr1.join(''),2);

            var arr2 = createPropertiesArray2(markers[i]);
            var int2 = parseInt(arr2.join(''),2);

            var arr3 = createPropertiesArray3(markers[i]);
            var int3 = parseInt(arr3.join(''),2);

            var int4 = createPropertiesArray4(markers[i]);
            //console.log("Integer Equivalent -->>"+int+"<<<---");

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
                props1: int1,
                props2: int2, 
                props3: int3,
                props4: int4
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
        for (j = 0; j < organizations.length; j++) {

            var arr1 = createPropertiesArray1(organizations[j]);
            var int1 = parseInt(arr1.join(''),2);

            var arr2 = createPropertiesArray2(organizations[j]);
            var int2 = parseInt(arr2.join(''),2);

            var arr3 = createPropertiesArray3(organizations[j]);
            var int3 = parseInt(arr3.join(''),2);

            var int4 = createPropertiesArray4(organizations[j]);

            //console.log("Integer Equivalent -->>"+int+"<<<---");

            var livelihood_organization_id = organizations[j].getAttribute("livelihood_organization_id");
            var livelihood_organization_name = organizations[j].getAttribute("livelihood_organization_name");
            var livelihood_organization_address = organizations[j].getAttribute("livelihood_organization_address");
            var no_of_members = organizations[j].getAttribute("no_of_members");
            var initial_income = organizations[j].getAttribute("initial_income");
            var livelihood_organization_status = organizations[j].getAttribute("livelihood_organization_status");
            var date_established = organizations[j].getAttribute("date_established");
            var business_activity_type = organizations[j].getAttribute("business_activity_type");
            var elementType = organizations[j].getAttribute("elementType");
            var point = new google.maps.LatLng(
                    parseFloat(organizations[j].getAttribute("lat")),
                    parseFloat(organizations[j].getAttribute("lng")));
            var icon = customIcons['Livelihood'];

            
            var markerOptions = {
                position: point,
                visible:false,
                icon: icon.icon,
                shadow: icon.shadow,
                center: point,
                arrId: (polygonIndex+i+j),
                id: livelihood_organization_id,
                livelihood_organization_name: livelihood_organization_name,
                livelihood_organization_address: livelihood_organization_address,
                no_of_members: no_of_members,
                initial_income: initial_income,
                livelihood_organization_status:livelihood_organization_status,
                date_established:date_established,
                business_activity_type:business_activity_type,
                elementType: 3,
                props1: int1,
                props2: int2, 
                props3: int3,
                props4: int4
            }
            var marker = new google.maps.Marker(markerOptions);
            mapElements.push(marker);
            marker.setMap(map);
            bindLivelihoodToSidePanel(marker);
        }
        //================================================================================================================
        var barangayIndex=0;
        for (barangayIndex = 0; barangayIndex < barangays.length; barangayIndex++) {

            var arr1 = createPropertiesArray1(barangays[barangayIndex]);
            var int1 = parseInt(arr1.join(''),2);

            var arr2 = createPropertiesArray2(barangays[barangayIndex]);
            var int2 = parseInt(arr2.join(''),2);

            var arr3 = createPropertiesArray3(barangays[barangayIndex]);
            var int3 = parseInt(arr3.join(''),2);

            var int4 = createPropertiesArray4(barangays[barangayIndex]);

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
                visible: false, 
                strokeColor: color.fillColor,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: color.strokeColor,
                fillOpacity: 0.35,
                arrId: (polygonIndex+i+j+barangayIndex),
                id: location_id,
                location_address: location_address,
                location_type: location_type,
                elementType: 6,
                props1: int1,
                props2: int2, 
                props3: int3,
                props4: int4
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
        //================================================================================================================
        
        triggerFilters();
    });

}
function triggerFilters(){
    $('#elementBoxes input:checkbox').trigger("change");
}
function appendToIncidentList(mapElement) {
    console.log("append to incident list invoked");

    var listItem="";
    listItem += "<div class=\"accordion\" id=\"accordion" + mapElement.id + "\">";
    listItem += "<div class=\"accordion-group\">";
    listItem += "<div class=\"accordion-heading\">";
    listItem += "<label class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" + mapElement.id + "\" href=\"#collapse" + mapElement.id + "\" style= \"display: inline-block; width: 200px; color: white;\">" + mapElement.disasterType + " </label> ";
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
    //console.log(div);
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


function appendToLivelihoodList(mapElement) {
    console.log("append to livelihood list invoked");
    
    var listItem="";
    listItem += "<div class=\"accordion\" id=\"accordion" + mapElement.id + "\">";
    listItem += "<div class=\"accordion-group\">";
    listItem += "<div class=\"accordion-heading\">";
    listItem += "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" + mapElement.id + "\" href=\"#collapse" + mapElement.id + "\" style= \"display: inline-block; width: 200px;\">" + mapElement.livelihood_organization_name + "</a>";
    //place icon-links here [show details]
    listItem += "| <a class= \"label label-info\"  data-id=\"" + mapElement.id + "\" onclick=\"displayLivelihoodDetails("+mapElement.id+","+mapElement.arrId+");\"><i class= \"icon-eye-open icon-white\" data-arrId=\""+mapElement.arrId+"\"data-id=\"" + mapElement.id + "\" id= \"show-details-btn\" title= \"Show details\"> </i> Open </a> "; // show details icon
    //end div
    listItem += "</div>";
    listItem += "<div id=\"collapse" + mapElement.id + "\" class=\"accordion-body collapse in\">";
    listItem += "<div class=\"accordion-inner\">";
    listItem += "<p class=\"list-group-item-text\">Livelihood Organization Address :" + mapElement.livelihood_organization_address + "<br> Business Activity Type:" + mapElement.business_activity_type + "<br> Organization Status: " + mapElement.livelihood_organization_status + "</p>";
    listItem += "</div></div></div>";

    //append to the list
    var div = document.getElementById('livelihoodList');
    //console.log(div);
    div.innerHTML = div.innerHTML + listItem;

    //map.setCenter(new google.maps.LatLng(parseFloat(markerDetails.getAttribute("lat")), parseFloat(markerDetails.getAttribute("lng"))));
}
function appendToBarangayList(mapElement) {
    console.log("append to barangay list invoked");
    
    var listItem="";
    listItem += "<div class=\"accordion\" id=\"accordion" + mapElement.id + "\">";
    listItem += "<div class=\"accordion-group\">";
    listItem += "<div class=\"accordion-heading\">";
    listItem += "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" + mapElement.id + "\" href=\"#collapse" + mapElement.id + "\" style= \"display: inline-block; width: 200px;\">" + mapElement.location_address + "</a>";
    //place icon-links here [show details]
    listItem += "| <a class= \"label label-info\"  data-id=\"" + mapElement.id + "\" onclick=\"displayBarangayResource("+mapElement.id+","+mapElement.arrId+");\"><i class= \"icon-eye-open icon-white\" data-arrId=\""+mapElement.arrId+"\"data-id=\"" + mapElement.id + "\" id= \"show-details-btn\" title= \"Show details\"> </i> Show Resources </a> "; // show details icon
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
    $("#incidentList").hide();
    $(".incidentTabbable").hide();
    $("#livelihoodList").hide();
    $(".livelihoodTabbable").hide();
    $("#barangayList").hide();
    $(".barangayTabbable").hide();
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
function livelihoodList(){
    $("#homeView").hide();
    $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToLivelihoodList()" class="subBreadCrumb1" id="subBreadCrumb1">Livelihood Orgs List</a><span class="divider">/</span></li>');
    $("#livelihoodList").show("fast");
}
function barangayList(){
    $("#homeView").hide();
    $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToBarangayList()" class="subBreadCrumb1" id="subBreadCrumb1">Barangay List</a><span class="divider">/</span></li>');
    $("#barangayList").show("fast");
    var boxes = $('#elementBoxes input:checkbox');
    $.each(boxes, function(i,b){
            //console.log("im inside the function");
            if(!($(b).is(':checked')) & i==10){
                //console.log("value of barangay resources here is->"+i);
                $(b).trigger('click');
            }else if(($(b).is(':checked')) & i==10){
                $(b).trigger('click');
                $(b).trigger('click');
            }
            else{
                
            }
    });
}
function backToIncidentList() {
    console.log(">>>>---backToIncidentList invoked---<<<<<");
    $(".subBreadCrumb2").remove();
    $(".incidentTabbable").hide();
    $("#IncidentTabbable").hide("fast");
    $("#incidentList").show("fast");
}
function backToLivelihoodList() {
    console.log(">>>>---backToRespondentList invoked---<<<<<");
    $(".subBreadCrumb2").remove();
    $(".livelihoodTabbable").hide();
    $("#livelihoodTabbable").hide("fast");
    $("#livelihoodList").show("fast");
}
function backToBarangayList() {
    console.log(">>>>---backToRespondentList invoked---<<<<<");
    //alert("back to Barangay List invoked");
    $(".subBreadCrumb2").remove();
    $(".barangayTabbable").hide();
    $("#barangayTabbable").hide("fast");
    $("#barangayList").show("fast");
    var boxes = $('#elementBoxes input:checkbox');
    $.each(boxes, function(i,b){
            //console.log("im inside the function");
            if(!($(b).is(':checked')) & i==10){
                //console.log("value of barangay resources here is->"+i);
                $(b).trigger('click');
            }else if(($(b).is(':checked')) & i==10){
                $(b).trigger('click');
                $(b).trigger('click');
            }
            else{

            }
    });

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
                $(" #details-tab, #overview-li, #editinfo-li, #delete-li, .approve-li, .disapprove-li").attr("data-incidentreportid", incidentReportId)
                $(" #details-tab, #overview-li, #editinfo-li, #delete-li, .approve-li, .disapprove-li").attr("data-elementid", elementId)
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
function displayLivelihoodDetailsFromMap(livelihoodId,element)
{

    console.log('displayLivelihoodDetails invoked with id'+livelihoodId);
    backToHome();
    $("#homeView").hide();
    openSideBar();

    //alert("respondent id ->"+deployment_id);
    $("#livelihoodTabbable").show("slow");
    $("#livelihood-membersTable").show("slow");

     /*retrieve the response organization name to be used in the breadcrumbs*/
     request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getLivelihoodOrganizationName",
        type: "POST",
        data: {id:livelihoodId},
        success: function(name) {
            $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToLivelihoodList()" class="subBreadCrumb1" id="subBreadCrumb1">Livelihood Orgs List</a><span class="divider">/</span></li>');
            $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + name + '</a></li>');
            //alert("name retrieved: "+name);
        },
        error: function() {
            console.log("error retrieving response organization name");
            console.log(name);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getLivelihoodOrganizationDetails",
        type: "POST",
        data: {id:livelihoodId},
        success: function(msg) {
                 $("#livelihood-information").html(msg);
        },
        error: function() {
            console.log("error retrieving response organization name");
            console.log(msg);
        }
    });
}
function displayBarangayDetailsFromMap(location_id)
{

    backToHome();
    $("#homeView").hide();
    openSideBar();

    //alert("respondent id ->"+deployment_id);
    $("#barangayTabbable").show("slow");
    $("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToBarangayList()" class="subBreadCrumb1" id="subBreadCrumb1">Barangay List</a><span class="divider">/</span></li>');
    $("#manageResourceButton").html("<a class=\"btn btn-small btn-primary\" href=\"http://localhost/icdrris/Livelihood/manageBarangayResources/id/"+location_id+"\">Manage Resources</a>");
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
        url: "http://localhost/icdrris/Livelihood/getResourceByCategory",
        type: "POST",
        data: {location_id:location_id,resource_category:'1'},
        success: function(msg) {
                    $("#physical-resource").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getResourceByCategory",
        type: "POST",
        data: {location_id:location_id,resource_category:'2'},
        success: function(msg) {
                    $("#natural-resource").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getResourceByCategory",
        type: "POST",
        data: {location_id:location_id,resource_category:'3'},
        success: function(msg) {
                    $("#human-resource").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getResourceByCategory",
        type: "POST",
        data: {location_id:location_id,resource_category:'4'},
        success: function(msg) {
                    $("#social-resource").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getResourceByCategory",
        type: "POST",
        data: {location_id:location_id,resource_category:'5'},
        success: function(msg) {
                    $("#financial-resource").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });    

    var i, n = mapElements.length;
    for (i = 0; i < n; ++i) {
        if(mapElements[i].id==location_id){   
            mapElements[i].setVisible(true);
        }else{
            if(!(mapElements[i].elementType==3)){
                mapElements[i].setVisible(false);
            }
            
        }
    }

}
function displayLivelihoodDetails(livelihoodId,elementId)
{

    //alert('displayDetails invoked with id->'+livelihoodId);
    //$("#subBreadCrumb1").remove();
    $("#livelihoodList").hide("fast");
    //openSideBar();

    //alert("respondent id ->"+deployment_id);

     /*retrieve the response organization name to be used in the breadcrumbs*/
    $("#livelihoodTabbable").show("slow");
    $("#livelihood-membersTable").show("slow");

     /*retrieve the response organization name to be used in the breadcrumbs*/
     request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getLivelihoodOrganizationName",
        type: "POST",
        data: {id:livelihoodId},
        success: function(name) {
            //$("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToLivelihoodList()" class="subBreadCrumb1" id="subBreadCrumb1">Livelihood Orgs List</a><span class="divider">/</span></li>');
            $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + name + '</a></li>');
            //alert("name retrieved: "+name);
        },
        error: function() {
            console.log("error retrieving response organization name");
            console.log(name);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getLivelihoodOrganizationDetails",
        type: "POST",
        data: {id:livelihoodId},
        success: function(msg) {
                 $("#livelihood-information").html(msg);
        },
        error: function() {
            console.log("error retrieving response organization name");
            console.log(msg);
        }
    });

    map.setCenter(mapElements[elementId].center);
    mapElements[elementId].setAnimation(google.maps.Animation.BOUNCE);
    stopAnimation(mapElements[elementId]);

}
function displayBarangayResource(locationId, elementId)
{

    //alert('displayDetails invoked with id->'+livelihoodId);
    //$("#subBreadCrumb1").remove();
    $("#barangayList").hide("fast");
    $("#physical-resource").html('');
    $("#natural-resource").html('');
    $("#social-resource").html('');
    $("#human-resource").html('');
    $("#financial-resource").html('');
    //openSideBar();

    //alert("respondent id ->"+deployment_id);

     /*retrieve the response organization name to be used in the breadcrumbs*/
    $("#barangayTabbable").show("fast");
    $(".barangayTabbable").show("fast");
    $("#manageResourceButton").html("<a class=\"btn btn-small btn-primary\" href=\"http://localhost/icdrris/Livelihood/manageBarangayResources/id/"+locationId+"\">Manage Resources</a>");
      /*retrieve the response organization name to be used in the breadcrumbs*/

    

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
        url: "http://localhost/icdrris/Livelihood/getResourceByCategory",
        type: "POST",
        data: {location_id:locationId,resource_category:'1'},
        success: function(msg) {
                    $("#physical-resource").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getResourceByCategory",
        type: "POST",
        data: {location_id:locationId,resource_category:'2'},
        success: function(msg) {
                    $("#natural-resource").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getResourceByCategory",
        type: "POST",
        data: {location_id:locationId,resource_category:'3'},
        success: function(msg) {
                    $("#human-resource").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getResourceByCategory",
        type: "POST",
        data: {location_id:locationId,resource_category:'4'},
        success: function(msg) {
                    $("#social-resource").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });
    request = $.ajax({
        url: "http://localhost/icdrris/Livelihood/getResourceByCategory",
        type: "POST",
        data: {location_id:locationId,resource_category:'5'},
        success: function(msg) {
                    $("#financial-resource").html(msg);
        },
        error: function() {
            //console.log("error retrieving response organization deployment details");
            console.log(msg);
        }
    });


     /*retrieve the response organization name to be used in the breadcrumbs*/
    //  request = $.ajax({
    //     url: "http://localhost/icdrris/Livelihood/getLivelihoodOrganizationName",
    //     type: "POST",
    //     data: {id:livelihoodId},
    //     success: function(name) {
    //         //$("#homeBreadCrumb").after('<li id="subBreadCrumb1"><a onclick="backToLivelihoodList()" class="subBreadCrumb1" id="subBreadCrumb1">Livelihood Orgs List</a><span class="divider">/</span></li>');
    //         $("#subBreadCrumb1").after('<li><a class="subBreadCrumb2">' + name + '</a></li>');
    //         //alert("name retrieved: "+name);
    //     },
    //     error: function() {
    //         console.log("error retrieving response organization name");
    //         console.log(name);
    //     }
    // });
    // request = $.ajax({
    //     url: "http://localhost/icdrris/Livelihood/getLivelihoodOrganizationDetails",
    //     type: "POST",
    //     data: {id:livelihoodId},
    //     success: function(msg) {
    //              $("#livelihood-information").html(msg);
    //     },
    //     error: function() {
    //         console.log("error retrieving response organization name");
    //         console.log(msg);
    //     }
    // });
    //alert("element center ->"+mapElements.length);
    
    var i, n = mapElements.length;
    for (i = 0; i < n; ++i) {
        if(i==elementId){   
            mapElements[i].setVisible(true);
        }else{
            if(!(mapElements[i].elementType==3)){
                mapElements[i].setVisible(false);
            }
        }
    }
    map.setCenter(mapElements[elementId].center);
    //mapElements[elementId].setAnimation(google.maps.Animation.BOUNCE);
    //stopAnimation(mapElements[elementId]);

}

function grantLivelihoodProgram(id){
    //show list of Deployable Livelihood Programs modal
    //after click show all available resources, specify quantity for each resource then deploy
    //uodate the grants table for the livelihoodOrganization

}

function victimsTab() {

		var incident_report_id = $(".victims-tab, #victims-tab").data('incidentid');
       
	   console.log(incident_report_id);
      //  var dataStr = 'id=' + incident_report_id;

        /* Send the data using post and put results to the members table */
        request = $.ajax({
            url: "http://localhost/icdrris/Victim/viewAllVictims",
            type: "POST",
            data: {id:incident_report_id},
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
function manageBarangayResources(locationId){
    window.location("http://localhost/icdrris/Livelihood/id/"+locationId);
}

