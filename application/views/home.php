<!DOCTYPE html>
<html>
  <head>
    <title>Iligan City Disaster Response and Recovery Information System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/ICDRRIS/css/bootstrap.min.css" rel="stylesheet" media="screen">
	
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">
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


		function initialize() {
				var latlng = new google.maps.LatLng(8.228021,124.245242);
				directionsDisplay = new google.maps.DirectionsRenderer();
				var myOptions = {
					zoom: 14,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					mapTypeControl: false
				};
			var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
			directionsDisplay.setMap(map);
			directionsDisplay.setPanel(document.getElementById("directionsPanel"));
			
			var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      		downloadUrl("genXML.php", function(data) {
        	var xml = data.responseXML;
        	var markers = xml.documentElement.getElementsByTagName("marker");
        	for (var i = 0; i < markers.length; i++) {
          		var name = markers[i].getAttribute("name");
          		var address = markers[i].getAttribute("address");
          		var type = markers[i].getAttribute("type");
          		//var disaster_intensity = markers[i].getAttribute("disaster_intensity");
          		var disaster_description = markers[i].getAttribute("disaster_description");
          		var casualties = markers[i].getAttribute("casualties");
          		//var families_affected = markers[i].getAttribute("families_affected");
          		//var estimated_cost = markers[i].getAttribute("estimated_cost");
          		//var type = markers[i].getAttribute("type");
          		//var html = "<b>" + barangay + "</b> : " + address + "<br/>" + "<b> disaster_type:" + disaster_type + "</b>   disaster_description" + disaster_description+ "<br/><b> casualties:"+casualties+"</b>"+"  families_affected:"+families_affected+"<br/>"+"estimated_cost: "+estimated_cost;
          		var html = "<b>" + name + "</b> <br/>" + disaster_description+"<br>"+"casualties: "+casualties;
          		var icon = customIcons[type] || {};
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
      		});

			/**
			var marker = new google.maps.Marker({
				position: latlng, 
				map: map, 
				title:"My location"
			}); 
			*/
			}
 			
 	function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}
 
		</script>
		
		<style type = "text/css">
			#googlemap img,object,embed{max-width:none}
			#map_canvas embed{max-width:none}
			#map_canvas img{max-width:none}
			#map_canvas object{max-width:none}
		</style>
  </head>
  <body onload="initialize()">
    <div class = "navbar navbar-inverse">
		<div class = "navbar-inner">
			<a class = "brand" href = "#">ICDRRIS</a>
			<ul class = "nav">
				<li class = "active"><a href = "#">Home</a></li>	
			</ul>
			
			<ul class="nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Actions
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href = "#"><i class = "icon-plus"></i> Add</a></li>
						<li><a href = "#"><i class = "icon-edit"></i> Edit</a></li>
						<li><a href = "#"><i class = "icon-trash"></i> Delete</a></li>
					</ul>
				</li>
			</ul>
			
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class = "icon-user icon-white"></i> [Name of User]
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href = "#"><i class = "icon-pencil"></i> Edit User Info</a></li>
						<li><a href = "D:/bootstrap/reg1.html"><i class = "icon-off"></i> Log-out</a></li>			
					</ul>
				</li>
			</ul>
			
			<form class = "navbar-search pull-right">
				<input type = "text" class = "search-query" placeholder = "Search">
			</form>
			
			
			
		</div>
	</div>
	
	<div class = "container-fluid">
	<div class = "row-fluid">
	
	<div class = "span2"></div>
	<div class = "span10">
	<div id="map_canvas" style="width:100%; height:600px;"></div>   
			<div id="directionsPanel"></div>
	</div>
	</div>
	</div>
    <script src="/ICDRRIS/js/jquery.js"></script>
    <script src="/ICDRRIS/js/bootstrap.min.js"></script>
  </body>
</html>