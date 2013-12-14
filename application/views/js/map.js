
			var directionDisplay;
			
			var directionsService = new google.maps.DirectionsService();


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

      /**
      var marker = new google.maps.Marker({
        position: latlng, 
        map: map, 
        title:"My location"
      }); 
      */
      }

    function displayList(){

          downloadUrl("http://localhost/icdrris/application/views/polyXML.php", function(data) {
          
          var xml = data.responseXML;
          console.log(xml);
          var polygon = xml.documentElement.getElementsByTagName("polygon");
         
          var output="<ul class=\"list-group\">"; 
          
          for (var i = 0; i < polygon.length; i++) {
              var desc=polygon[i].getAttribute("description");
              var type=polygon[i].getAttribute("type");
              var address=polygon[i].getAttribute("address");
              var affected=polygon[i].getAttribute("affected");
                output+="<div class=\"accordion\" id=\"accordion"+i+"\">";
                output+="<div class=\"accordion-group\">";
                   output+="<div class=\"accordion-heading\">";
                    output+="<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion"+i+"\" href=\"#collapse"+i+"\">"+type+"</a>";
                        output+="</div>";
                        output+="<div id=\"collapse"+i+"\" class=\"accordion-body collapse in\">";
                          output+="<div class=\"accordion-inner\">";
                            output+="<p class=\"list-group-item-text\">description:"+desc+"/naddress:"+address+"/nfamilies affected"+affected+"</p>";
                          output+="</div></div></div>";
                
          }
          output+="</ul>";

          insertToDocument(output);

    });
  }
      
  function insertToDocument(content)
  {
    document.getElementById('incidentList').innerHTML=(content);
  }
  function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }
  function bindInfoWindowToSidePanel(map,element,marker,content)
  {
    //-------------------------------------------------------------------------------------
      google.maps.event.addDomListener(element, 'click', function() {
         map.setCenter(marker.getPosition());
         infowindow.setContent(content);
         infowindow.open(map,marker);
      });
    //-------------------------------------------------------------------------------------
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

    function filterPolygon() {
    
      if(document.filterForm.filterMenu.value!=null)
      {
        var filterValue=document.filterForm.filterMenu.value;

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
        downloadUrl("http://localhost/icdrris/application/views/polyXML.php", function(data) {
          
          var xml = data.responseXML;
          console.log(xml);
          var polygons = xml.documentElement.getElementsByTagName("polygon");
          

          for (var i = 0; i < polygons.length; i++) {
              //var name = points[i].getAttribute("name");
              //var address = markers[i].getAttribute("address");
              //var type = markers[i].getAttribute("type");
              //var disaster_intensity = markers[i].getAttribute("disaster_intensity");
              //var disaster_description = markers[i].getAttribute("disaster_description");
              //var casualties = markers[i].getAttribute("casualties");
              //var families_affected = markers[i].getAttribute("families_affected");
              //var estimated_cost = markers[i].getAttribute("estimated_cost");
              //var type = markers[i].getAttribute("type");
              //var html = "<b>" + barangay + "</b> : " + address + "<br/>" + "<b> disaster_type:" + disaster_type + "</b>   disaster_description" + disaster_description+ "<br/><b> casualties:"+casualties+"</b>"+"  families_affected:"+families_affected+"<br/>"+"estimated_cost: "+estimated_cost;
              //var html = "<b>" + name + "</b> <br/>" + disaster_description+"<br>"+"casualties: "+casualties;
              //var icon = customIcons[type] || {};
              //============DECLARE VARIABLES=============
            var type=polygons[i].getAttribute("type");
            if(filterValue===type)
            {            
              var coordinates = [];
              var myPolygon;
              var points=polygons[i].getElementsByTagName("point");


                //======EXTRACT MULTIPLE POINTS======
                for(var j=0 ; j<points.length; j++)
                { 
                  var point = new google.maps.LatLng(
                  parseFloat(points[j].getAttribute("lat")),
                  parseFloat(points[j].getAttribute("lng")));
                  coordinates[j]=point;
                }
                
              var polyOptions = {
                paths: coordinates,
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: 0.35
              }

              myPolygon = new google.maps.Polygon(polyOptions); 
            
              myPolygon.setMap(map);

            }

          }

        });
        
      }
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

      if(document.filterForm.filterMenu.value!=null)
      {
        var filterValue=document.filterForm.filterMenu.value;

        var latlng = new google.maps.LatLng(8.228021,124.245242);
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


      var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
      directionsDisplay.setMap(map);
      directionsDisplay.setPanel(document.getElementById("directionsPanel"));
      
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
          downloadUrl("genXML.php", function(data) {
          var xml = data.responseXML;
          var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {

              if(filterValue===markers[i].getAttribute("type"))
              {              

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

            }
          });
      }
    }
