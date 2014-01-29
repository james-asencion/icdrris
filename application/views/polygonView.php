<!--
/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */
--><!DOCTYPE html>
<html>
  <head>
    <title>Iligan City Disaster Response and Recovery Information System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="<?php echo base_url();?>application/views/js/polygonScript.js"></script>
	<script src="<?php echo base_url();?>application/views/js/modalScript.js"></script>
	

		<style type = "text/css">
			#googlemap img,object,embed{max-width:none}
			#map_canvas embed{max-width:none}
			#map_canvas img{max-width:none}
			#map_canvas object{max-width:none}
		</style>
  </head>
  <body onload="initialize()">
  <div class = "modal hide fade" id="instructionModal">
  	<div class = "modal-header">
  		<a class="close" data-dismiss="modal">x</a>
  		<h3>Click points on the map to form a polygon</h3>
  	</div>
  	<div class="modal-body">
  		<p>This is an instruction...</p>
  	</div>
  	<div class="modal-footer">
  		<a data-dismiss="modal" class="btn btn-primary">Okay Got it</a>
  	</div>
  </div>
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
			<ul class="nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Change Map View
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href = "MapController"> Polygons</a></li>
						<li><a href = "MapController2">Markers</a></li>
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
			
			<form class = "navbar-form pull-left" name="filterForm">
				<div class="center" align="center">Filter Incidents:   
        		<select class="input-large custom span5" name="filterMenu" onChange="filterPolygon()">
                    <option value=""></option>
                    <option value='FlashFlood'>Flashflood</option>
                    <option value='LandSlide'>Landslide</option>
                    <option value='MudSlide'>Mudslide</option>
            	</select>
    		</div>
			</form>
			
			
			
		</div>
	</div>
        <div id="message"></div>
        
	<div class = "span4" id="incidentList">
			<button class="btn btn-mini" id="field" type="button" onclick="displayList()"/>Show All Incidents</button><br><br><br>
	</div>
	<div class = "container-fluid">
	<div class = "row-fluid">
	
	<div class = "span8">
	<div id="map_canvas" style="width:100%; height:600px;"></div>   
			<div id="directionsPanel"></div>
	</div>
	</div>
	</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
  </body>
</html>