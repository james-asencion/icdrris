<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
  <head>
	<title>Project Dasig</title>
	<link rel="icon" href="<?php echo base_url(); ?>img/Tsunami-256.png" type="image/gif">	
		
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
       <!-- Bootstrap -->
 
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        
        <!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

		<script src="<?php echo base_url();?>application/views/js/confirmation.js"></script>
		<script src="<?php echo base_url();?>application/views/js/formSubmission.js"></script>
		<script src="<?php echo base_url();?>application/views/js/externalOrganizationModal.js"></script>
		<script src="<?php echo base_url();?>application/views/js/deployLivelihoodScript.js"></script>
		<script src="<?php echo base_url();?>application/views/js/responseOrganization.js"></script>
		<script src="<?php echo base_url();?>application/views/js/map.js"></script>


         <!--
		<script src="<?php //echo base_url();?>application/views/js/dropdown.js"></script>
		<script src="<?php //echo base_url();?>application/views/js/polygonScript.js"></script>
		<script src="<?php //echo base_url();?>application/views/js/polygonScript.js"></script>
		<script src="<?php //echo base_url();?>application/views/js/markerScript.js"></script>
		<script src="<?php //echo base_url();?>application/views/js/verify.js"></script>-->
		
		    <!-- bootstrap -->
		<!--
		<link href="<?php echo base_url();?>application/views/css/bootstrap.css">
		-->
    	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    	
    	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  
		<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen">
	
	    <!-- x-editable (bootstrap version) -->
	    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>
		<script src="<?php echo base_url();?>application/views/js/x-editable.js"></script>
		<script src="<?php echo base_url();?>application/views/js/x-editable1.js"></script>







		<style type = "text/css">
			#googlemap img,object,embed{max-width:none}
			#map_canvas embed{max-width:none}
			#map_canvas img{max-width:none}
			#map_canvas object{max-width:none}
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
			//localStorage.clear();
				$(".trigger").click(function(){
                    $("#map_canvass").removeClass("span12");
					$("#map_canvass").addClass("span8"); //added
					$("#map_canvass").css({"float":"right"}); //added					
                                        lastCenter=map.getCenter(); 
                                        google.maps.event.trigger(map_canvas, 'resize');
                                        map.setCenter(lastCenter);
                                        $(".panel").toggle("fast");
					$(this).toggleClass("active");
					return false;
				});
				$(".trigger").click(function(){
					if (!$(this).hasClass("active")) {
					 $("#map_canvass").removeClass("span8");
					 $("#map_canvass").addClass("span12");
                                        lastCenter=map.getCenter(); 
                                        google.maps.event.trigger(map_canvas, 'resize');
                                        map.setCenter(lastCenter);
					 }
				});
			});
                       
		</script>
		
  </head>
  
  <!--onload="initializeMap()"-->
  <body >
      
	<div class = "navbar navbar-inverse">
		<div class = "navbar-inner">
			<!-- SITE TITLE -->
			<a class = "brand" href = "<?php echo base_url();?>">Project Dasig</a>
			<ul class = "nav">
				<li class = "active"><a href = "<?php echo base_url();?>"><i class = "icon-home"></i> Home</a></li>
			</ul>
                   
	<!-- HEADER MENUS-->
	<ul class= "nav">
			<a href="#modalReportIncident" class="btn btn-danger btn-small" role="button" data-toggle="modal">
				<i class = "icon-white icon-bell"></i> Report Incident 
			</a>
                            
	</ul>
	
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
                    <h3><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_333_bell.png"  alt="bin" style="margin-top:-10px"> Report Incident</h3>
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
							print_r($this->session->userdata('firstname').' '.$this->session->userdata('lastname')); 
						 ?>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href = "#" class="editAccountSettings" role="button" data-toggle="modal"><i class = "icon-pencil"></i> Edit User Info</a></li>
						<li><a href = "<?php echo base_url().'Home/logout' ?>"><i class = "icon-off"></i> Log-out</a></li>			
					</ul>
				</li>
			</ul>
			<?php
				/**
				*	EDIT USER INFO MODAL
				*/
				$this->load->view('forms/user_info_form');
			?>
        <?php } ?>
		
		<?php if(!$this->session->userdata('is_logged_in')){ ?>
			<ul class="nav pull-right">
				<li>
                    <a href="#modalLogin" id="login-btn" class="login-btn" role="button" data-toggle="modal">Log-in</a>
				</li>
			</ul>
		<?php  
		/** A LOGIN MODAL
		 ** uses application/views/js/formSubmission.js 
		 */
				$this->load->view('forms/login_form');
			}				
		?>
