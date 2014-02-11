<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
  <head>
		<title>Iligan City Disaster Response and Recovery Information System</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->

                
        <!--    <link href="<?php //echo base_url();?>css/bootstrap-glyphicons.css" rel="stylesheet">-->
		<!-- imports for jQuery  -->                 
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>


        <!--imports for custom scripts -->
		<script src="<?php echo base_url();?>application/views/js/confirmation.js"></script>
		<script src="<?php echo base_url();?>application/views/js/map.js"></script>
		<script src="<?php echo base_url();?>application/views/js/dropdown.js"></script>
		<!--<script src="<?php echo base_url();?>application/views/js/polygonScript.js"></script>
		<script src="<?php echo base_url();?>application/views/js/markerScript.js"></script> -->
		<script src="<?php echo base_url();?>application/views/js/verify.js"></script>
		<script src="<?php echo base_url();?>application/views/js/formSubmission.js"></script> 
		<script src="<?php echo base_url();?>application/views/js/sidebar.js"></script> 
		<!--imports for Bootstrap  -->
        <script src="<?php echo base_url();?>application/views/js/bootstrap.min.js"></script>
		<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url();?>application/views/temp/style1.css" type="text/css" media="screen">

		<!--imports for x-editable -->
		<link href="<?php echo base_url();?>/application/views/x-editable/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">
		<script src="<?php echo base_url();?>/application/views/x-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
		<script src="<?php echo base_url();?>application/views/js/xEditableSettings.js"></script>

		<style type = "text/css">
			#googlemap img,object,embed{max-width:none}
			#map_canvas embed{max-width:none}
			#map_canvas img{max-width:none}
			#map_canvas object{max-width:none}
		</style>

	
  </head>
  
  <body onload="initializeMap()">
      
	<div class = "navbar navbar-inverse">
		<div class = "navbar-inner">
			<a class = "brand" href = "<?php echo base_url();?>">ICDRRIS</a>
			<ul class = "nav">
				<li class = "active"><a href = "<?php echo base_url();?>"><i class = "icon-home"></i> Home</a></li>
			</ul>
                   
	<!-- HEADER-->
		<?php if(!$this->session->userdata('is_logged_in')){ ?>	
			<ul class="nav">
				<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class = "icon-tint icon-white"></i> Incidents
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="dropdown-submenu">
                                            <a tabindex="-1" href = "#"><i class = "icon-bullhorn"></i> Report an Incident </a>
                                                <ul class="dropdown-menu">
                                                    <li> <a href="http://localhost/icdrris/Livelihood/registerLivelihoodOrg"><i class = "icon-pencil"></i> Report Victim </a></li>
                                                </ul>
						<li><a href = "#"><i class = "icon-briefcase"></i> List of Incidents</a></li>
						
					</ul>
				</li>
			</ul>
			<ul class="nav">
				<li class="dropdown" name="livelihoodDropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class = "icon-flag icon-white"></i> Livelihood Matching
                                        <b class="caret"></b>
                                    </a>
                                <ul class="dropdown-menu" role="menu">
                         			<li> 
                         				<a href = "http://localhost/icdrris/Livelihood/registerLivelihoodOrg" ><i class = "icon-edit"></i> Register Livelihood Org </a>
                         			</li>
                                    <li>
                                    	<a href = "#" ><i class = "icon-briefcase"></i> Register External Org</a>
                                    </li>
                                    <li>
                                    	<a href = "#"><i class = "icon-share"></i> Deploy Livelihood Org</a>
                                    </li>
                                    <li>
                                    	<a href = "#"><i class = "icon-search"></i> Search Livelihood Org</a>
                                    </li>
                                    <li>
                                    	<a href = "http://localhost/icdrris/Livelihood/viewAllLivelihoodOrgs" ><i class = "icon-search"></i> View All Livelihood Orgs</a>
                                    </li>
								</ul>
					</ul>
				</li>
			</ul>
<!--
			<form class = "navbar-form pull-left" name="filterForm1">
				<div class="center" align="center">View Incidents by:   
					<select class="input-large custom span5" name="filterMenu1" onChange="filterReports()">
						<option value=""></option>
						<option value='Marker'> <i class = "icon-map-marker"></i>  Marker</option>
						<option value='Polygon'>Polygon</option>
					</select>
				</div>
			</form>
			
-->	

	<!-- FILTER FORM -->				
<!--			<form class = "navbar-form pull-left" name="filterForm2">
				<div class="center" align="center">Filter Incidents:   
					<select class="input-large custom span5" name="filterMenu2" onChange="filterReports()">
						<option value='null'></option>
						<option value='FlashFlood'>Flashflood</option>
						<option value='LandSlide'>Landslide</option>
						<option value='MudSlide'>Mudslide</option>
					</select>
				</div>
			</form>
-->
<?php } ?>	
        
        <!-- userLogout (condition: LOGGED IN)-->	
        <?php if($this->session->userdata('is_logged_in')){ ?>	
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class = "icon-user icon-white"></i> 	
						<?php 
							// Capital the first letter
							// Username OR Name of the User??
							print_r($this->session->userdata('utype').'.'.$this->session->userdata('firstname')); 
						 ?>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href = "#"><i class = "icon-pencil"></i> Edit User Info</a></li>
						<li><a href = "<?php echo base_url().'Login/logout' ?>"><i class = "icon-off"></i> Log-out</a></li>			
					</ul>
				</li>
			</ul>
        <?php } ?>