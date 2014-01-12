<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
  <head>
		<title>Iligan City Disaster Response and Recovery Information System</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen">
	   <!--    <link href="<?php //echo base_url();?>css/bootstrap-glyphicons.css" rel="stylesheet">-->
	   
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="application/views/js/map.js"></script>
               
		<style type = "text/css">
			#googlemap img,object,embed{max-width:none}
			#map_canvas embed{max-width:none}
			#map_canvas img{max-width:none}
			#map_canvas object{max-width:none}
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".trigger").click(function(){
					$(".panel").toggle("fast");
					$(this).toggleClass("active");
					return false;
				});
			});
		</script>
	
  </head>
  
  <body onload="initialize()">
      
	<div class = "navbar navbar-inverse">
		<div class = "navbar-inner">
			<a class = "brand" href = "<?php echo base_url();?>reg1.html">ICDRRIS</a>
			<ul class = "nav">
				<li class = "active"><a href = "<?php echo base_url();?>reg1.html">Home</a></li>
			</ul>
                   
	<!-- HEADER-->
		<?php if($this->session->userdata('is_logged_in')){ ?>	
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
			
	<!-- userLogout (condition: LOGGED IN)-->		
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class = "icon-user icon-white"></i> 	
						<?php 
							// Capital the first letter
							// Username OR Name of the User??
							print_r($this->session->userdata('username')); 
						 ?>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href = "#"><i class = "icon-pencil"></i> Edit User Info</a></li>
						<li><a href = "<?php echo base_url().'Login/logout' ?>"><i class = "icon-off"></i> Log-out</a></li>			
					</ul>
				</li>
			</ul>
	<!-- FILTER FORM -->				
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
<?php } ?>			