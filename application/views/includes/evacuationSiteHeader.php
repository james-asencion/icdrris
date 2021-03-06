<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
  <head>
	<title>Project Dasig</title>
	<link rel="icon" href="<?php echo base_url(); ?>img/logo.png" type="image/gif">	
		
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
       <!-- Bootstrap -->
 
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="<?php echo base_url();?>application/views/js/confirmation.js"></script>
		<script src="<?php echo base_url();?>application/views/js/formSubmission.js"></script>

    	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    	
    	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  
		<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen">






		<style type = "text/css">
			#googlemap img,object,embed{max-width:none}
			#map_canvas embed{max-width:none}
			#map_canvas img{max-width:none}
			#map_canvas object{max-width:none}
		</style>
  </head>
  
  <!--onload="initializeMap()"-->
  <body >
      
	<div class = "navbar navbar-inverse">
		<div class = "navbar-inner">
			<!-- SITE TITLE -->
			<a class = "brand" href = "<?php echo base_url();?>" style="width:17%"><img src="<?php echo base_url(); ?>img/logo.png" width="14%"/> Project Dasig </a>
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
                            <li><a href = "#"><i class = "icon-briefcase"></i> List of Barangays</a></li>
                            <li><a href = "#"><i class = "icon-briefcase"></i> List of Evacuation Centers</a></li>
                            <li><a href = "javascript:incidentList()"><i class = "icon-briefcase"></i> List of Incidents</a></li>
                            <li><a href = "javascript:requestList()"><i class = "icon-briefcase"></i> List of Requested Needs</a></li>

					</li>
				</ul>
			</li>
    </ul>

    <?php if(($this->session->userdata('user_type') === 'bdrrmo') & ($this->session->userdata('is_logged_in'))){?>
    <ul class="nav">
        <a class="btn btn-primary btn-small" href="http://localhost/icdrris/Evacuation/mapEvacuationSite" >Map an Evacuation Site</a>
    </ul>
    <?php   } ?>
	
  <!-- modal Report Incident -->
            <div id="modalReportIncident" class="modal hide fade" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <h3><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_333_bell.png"  alt="bin" style="margin-top:-10px"> Report an Incident</h3>
                </div>
                 <div class="modal-body">
                 	<center>
	                 	<a href="<?php echo base_url();?>Incident/reportIncidentMarker" class="btn btn-large btn-info"> <img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_242_google_maps.png"  alt="bin" style="margin-top:-10px">  By Marker</a>
	                    <a href="<?php echo base_url();?>Incident/reportIncidentPolygon" class="btn btn-large btn-info"> <img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_096_vector_path_polygon.png"  alt="bin" style="margin-top:-10px">  By Polygon</a>
               		 </center>
                </div>
                <div class="modal-footer">
                    
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Cancel</a>
                </div>
            </div> 
			<!-- end modal REport Incident -->

    <?php if(($this->session->userdata('user_type') === 'livelihood organization') & ($this->session->userdata('is_logged_in'))){?>
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
                    <a href = "http://localhost/icdrris/Livelihood/getUserLivelihoodOrganizations" ><i class = "icon-search"></i> View Managed Livelihood Orgs</a>
                </li>
                <li>
                    <a href = "http://localhost/icdrris/Livelihood/viewAllLivelihoodOrgs" ><i class = "icon-search"></i> View All Livelihood Orgs</a>
                </li>
                <li>
                    <a href = "http://localhost/icdrris/Livelihood/viewAllLivelihoodPrograms" ><i class = "icon-search"></i> View All Livelihood Programs</a>
                </li>
            </ul>
    </ul>
    <?php   } ?>
    <?php if(($this->session->userdata('user_type') === 'cdlo') & ($this->session->userdata('is_logged_in'))){?>
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
                    <a href = "http://localhost/icdrris/Livelihood/registerLivelihoodProgram" ><i class = "icon-briefcase"></i> Register Livelihood Program</a>
                </li>
                <li>
                    <a href = "http://localhost/icdrris/Livelihood/registerExternalOrganization" ><i class = "icon-briefcase"></i> Register External Org</a>
                </li>
                <li>
                    <a href = "http://localhost/icdrris/Livelihood/viewAllLivelihoodOrgs" ><i class = "icon-search"></i> View All Livelihood Orgs</a>
                </li>
                <li>
                    <a href = "http://localhost/icdrris/Livelihood/viewAllLivelihoodPrograms" ><i class = "icon-search"></i> View All Livelihood Programs</a>
                </li>
                <li>
                    <a href = "http://localhost/icdrris/Livelihood/viewAllExternalOrganizations" ><i class = "icon-search"></i> View All External Organizations</a>
                </li>
            </ul>
    </ul>
    <?php   } ?>
	<?php  if(($this->session->userdata('user_type') === 'response organization') & ($this->session->userdata('is_logged_in'))){?>
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
                    <a href ="http://localhost/icdrris/ResponseOrg/viewAllUserResOrgs"><i class = "icon-search"></i> View All Response Orgs</a>
                </li>
            </ul>
    </ul>
	<?php } ?>
        
        <!-- userLogout (condition: LOGGED IN)-->	
        <?php if($this->session->userdata('is_logged_in')){?>
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class = "icon-user icon-white"></i> 	
						<?php 
							// Capital the first letter
							// Username OR Name of the User??
							print_r($this->session->userdata('user_id').'.'.$this->session->userdata('user_type').'.'.$this->session->userdata('firstname')); 
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

		
        <ul class= "nav pull-right">
            <a href="#modalReportIncident" class="btn btn-danger" role="button" data-toggle="modal">
                <i class = "icon-white icon-bell"></i> Report Incident 
            </a>
                            
    </ul>
