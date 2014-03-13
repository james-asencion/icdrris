<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
  <head>
	<title>Iligan City Disaster Response and Recovery Information System</title>
	<link rel="icon" href="<?php echo base_url(); ?>img/Tsunami-256.png" type="image/gif">	
		
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
       <!-- Bootstrap -->
 
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!--		<script src="<?php echo base_url();?>application/views/js/confirmation.js"></script>
		<script src="<?php echo base_url();?>application/views/js/markerScript.js"></script>
		<script src="<?php echo base_url();?>application/views/js/polygonScript.js"></script>
		<script src="<?php echo base_url();?>application/views/js/formSubmission.js"></script>-->
		<!--<script src="<?php echo base_url();?>application/views/js/deploymap.js"></script>-->
		<script src="<?php echo base_url();?>application/views/js/deployresorgmap.js"></script>

         <!--
		<script src="<?php //echo base_url();?>application/views/js/dropdown.js"></script>
		<script src="<?php //echo base_url();?>application/views/js/polygonScript.js"></script>
		<script src="<?php //echo base_url();?>application/views/js/polygonScript.js"></script>
		<script src="<?php //echo base_url();?>application/views/js/markerScript.js"></script>
		<script src="<?php //echo base_url();?>application/views/js/verify.js"></script>-->
		
		    <!-- bootstrap -->
    	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  
		<!--<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen">-->

	    <!-- x-editable (bootstrap version) -->
	    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>
		<script src="<?php echo base_url();?>application/views/js/x-editable.js"></script>








		<style type = "text/css">
			#googlemap img,object,embed{max-width:none}
			#map_canvas embed{max-width:none}
			#map_canvas img{max-width:none}
			#map_canvas object{max-width:none}
		</style>

  </head>
  
  <!--onload="initializeMap()"-->
  <body onload = "initializeMap2()">
      
	<div class = "navbar navbar-inverse">
		<div class = "navbar-inner">
			<!-- SITE TITLE -->
			<a class = "brand" href = "<?php echo base_url();?>">ICDRRIS</a>
			<ul class = "nav">
				<li class = "active"><a href = "<?php echo base_url();?>"><i class = "icon-home"></i> Home</a></li>
			</ul>
                   
	<!-- HEADER MENUS-->
    <ul class="nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class = "icon-tint icon-white"></i> Incidents
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-submenu">
                        <a tabindex="-1" href = "#"><i class = "icon-bullhorn"></i> Report New... </a>
                            <ul class="dropdown-menu">
                                <li> <a href="<?php echo base_url();?>Incident/reportIncident"><i class = "icon-bell"></i> Report New Incident </a></li>
                                <li> <a href="<?php echo base_url();?>Victim/reportVictim"><i class = "icon-pencil"></i> Report New Victim </a></li>
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
                    <a href = "http://localhost/icdrris/Livelihood/viewDeploy"><i class = "icon-share"></i> Deploy Livelihood Org</a>
                </li>
                <li>
                    <a href = "#"><i class = "icon-search"></i> Search Livelihood Org</a>
                </li>
                <li>
                    <a href = "http://localhost/icdrris/Livelihood/viewAllLivelihoodOrgs" ><i class = "icon-search"></i> View All Livelihood Orgs</a>
                </li>
            </ul>
    </ul>

    <ul class="nav">
            <li class="dropdown" name="organizationDropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class = "icon-flag icon-white"></i> Response Organization
                    <b class="caret"></b>
                </a>
            <ul class="dropdown-menu" role="menu">
				<li> 
						<a href = "http://localhost/icdrris/ResponseOrg/registerResOrg" ><i class = "icon-edit"></i> Register Response Org </a>
				</li>
               
                <li>
                    <a href = "http://localhost/icdrris/ResponseOrg/viewDeploy"><i class = "icon-share"></i> Deploy Response Org</a>
                </li>
                <li>
                    <a href = "#"><i class = "icon-search"></i> Search Response Org</a>
                </li>
                <li>
                    <a href = "http://localhost/icdrris/ResponseOrg/viewAllUserResOrgs" ><i class = "icon-search"></i> View All Response Orgs</a>
                </li>
            </ul>
    </ul>
	
        
        <!-- userLogout (condition: LOGGED IN)-->	
        <?php if($this->session->userdata('is_logged_in')){ ?>	
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class = "icon-user icon-white"></i> 	
						<?php 
							// Capital the first letter
							// Username OR Name of the User??
							print_r($this->session->userdata('user_id').'.'.$this->session->userdata('utype').'.'.$this->session->userdata('firstname')); 
						 ?>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href = "#"><i class = "icon-pencil"></i> Edit User Info</a></li>
						<li><a href = "<?php echo base_url().'Home/logout' ?>"><i class = "icon-off"></i> Log-out</a></li>			
					</ul>
				</li>
			</ul>
        <?php } ?>
		
		<?php if(!$this->session->userdata('is_logged_in')){ ?>
			<ul class="nav pull-right">
				<li>
                    <a href="#" id="login-btn">Log-in</a>
				</li>
			</ul>
		<?php  
		/** A LOGIN MODAL
		 ** uses application/views/js/formSubmission.js 
		 */
				$this->load->view('forms/login_form');
			}				
		?>
	</div>