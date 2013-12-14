<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Google Maps JavaScript API v3 Example: Common Loader</title>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="util.js"></script>
<script type="text/javascript">
  var infowindow;
  var map;
  var states;


  function initialize() {
    var latlng = new google.maps.LatLng(47.6089, -122.34 );
    var mapOptions = {
      zoom: 4,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.TERRAIN,
	  navigationControl: true,
	    navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
	  mapTypeControl: true,
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
    }
    
	map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    
	downloadUrl("polyXML.php", function(data) {
	  var polygons = data.documentElement.getElementsByTagName("polygon");
	  for (var a = 0; a < polygons.length; a++) {
		var pts = [];
		var points = polygons[a].getElementsByTagName("point");
		for (var i = 0; i < points.length; i++) {
			pts[i] = new google.maps.LatLng(points[i].getAttribute("latitude"),
								points[i].getAttribute("longitude"));
	  }
      
	  var polyOptions = {
		paths: pts,
		strokeColor: "#FF0000",
		strokeOpacity: 0.8,
		strokeWeight: 0.5,
		fillColor: "#FF0000",
		fillOpacity: 0.4
	  }
	  
	  states = new google.maps.Polygon(polyOptions);
	  
	  states.setMap(map);

      google.maps.event.addListener(states, 'click', showArrays);
    
      infowindow = new google.maps.InfoWindow({content: name});

	  }		  

	  function showArrays(event) {
        infowindow.setPosition(event.latLng);  
        infowindow.open(map);
      }  

	});
  }


</script>
</head>
<body onload="initialize()">
   <div id="map_canvas" style="width:100%; height:100%; border:1px solid #000000"></div>
</body>

</html>
