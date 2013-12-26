<!--
You are free to copy and use this sample in accordance with the terms of the
Apache license (http://www.apache.org/licenses/LICENSE-2.0.html)
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>ICDRRIS Draw Polygon</title>
    <h1>This is the part of the page where the user will draw polygon for incident reporting</h1><br>
    <h3>Instructions: please click on the map to form a polygon</h3>
    <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">

      var shape;
      function initialize() {
        var mapDiv = document.getElementById('map-canvas');
        var map = new google.maps.Map(mapDiv, {
          center: new google.maps.LatLng(24.886436490787712, -70.2685546875),
          zoom: 4,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
      
        shape = new google.maps.Polygon({
          strokeColor: '#ff0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#ff0000',
          fillOpacity: 0.35
        });
      
        shape.setMap(map);
      
        google.maps.event.addListener(map, 'click', addPoint);
      }
      
      function addPoint(e) {
        var vertices = shape.getPath();
      
        vertices.push(e.latLng);
      }
      

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body style="font-family: Arial; border: 0 none;">
    <div id="map-canvas" style="width: 500px; height: 400px"></div>
  </body>
</html>
​