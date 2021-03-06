    </div>
        
        <div id="controls" style="display:block">
            <div id="elementBoxes">
              <!-- <div class="toppanel">
                <form class = "navbar-form pull-left" name="filterForm0">
                    <div class="center" align="center"><p>View Respondents:</p>   
                          <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
                              View Respondents
                              <b class="caret"></b>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-form" role="menu">
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      View Respondents
                                  </label>
                              </li>                                                                                                                     
                          </ul>
                      </div> 
                </form>
            </div> -->
            <div class="toppanel">
                <form class = "navbar-form pull-left" name="filterForm1">
                    <div class="center" align="center"><p>View Incidents by:</p>   
                          <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
                              Select Elements
                              <b class="caret"></b>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-form" role="menu">
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Marker
                                  </label>
                              </li>
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Polygon
                                  </label>
                              </li>                                                                                                                      
                          </ul>
                      </div> 
                </form>
            </div>
            <div class="toppanel">
                <form class = "navbar-form pull-left" name="filterForm2">
                    <div class="center" align="center"><p>Filter Incidents:</p>   
                      <div class="dropdown">
                          <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
                              Select Disaster Type
                              <b class="caret"></b>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-form" role="menu">
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Flashflood
                                  </label>
                              </li>
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Tsunami
                                  </label>
                              </li>  
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Landslide
                                  </label>
                              </li>
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Mudslide
                                  </label>
                              </li>
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Infrastructure Damage
                                  </label>
                              </li>                                                                                                                    
                          </ul>
                      </div>
                    </div>
                </form>
            </div>
          <div class="toppanel">
                <form class = "navbar-form pull-left" name="filterForm1">
                    <div class="center" align="center"><p>Filter Reports by:</p>   
                          <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
                              Filter Reports
                              <b class="caret"></b>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-form" role="menu">
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Confirmed
                                  </label>
                              </li>
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Not Confirmed
                                  </label>
                              </li>                                                                                                                      
                          </ul>
                      </div> 
                </form>
            </div>
          <div class="toppanel">
                <form class = "navbar-form pull-left" name="filterForm0">
                    <div class="center" align="center"><p>Livelihood Mapping:</p>   
                          <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
                              Livelihood Orgs
                              <b class="caret"></b>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-form" role="menu"> 
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Livelihood Organizations
                                  </label>
                              </li>  
                              <li>
                                  <label class="checkbox">
                                      <input type="checkbox">
                                      Barangay Resources
                                  </label>
                              </li>                                                                                                                    
                          </ul>
                      </div> 
                </form>
            </div>
            </div>
            <div class="toppanel"> 
                <form class = "navbar-form pull-left" name="filterForm3">
                    <div class="center" align="center"><p>Date To:</p>   
                        <input id="dateTo" type = "date" class="span2" name = "birthdate" value="<?php echo date('Y-m-d'); ?>" onchange="getAllMapElements()"/>
                    </div>
                </form>
            </div>
            <div class="toppanel"> 
                <form class = "navbar-form pull-left" name="filterForm4">
                    <div class="center" align="center"><p>Date From:</p>   
                       <input id="dateFrom" type = "date" class="span2" name = "birthdate" value="<?php echo date('Y-m-d', strtotime('-1 month')); ?>" onchange="getAllMapElements()"/>
                    </div>
                </form>
            </div>
            <div class="toppanel"></div>
        </div>		
</div>
        
	
	<div class = "container-fluid" style="padding:0px">
          <div class = "row-fluid">
            <div class = "span12">
             
				<div id= "panel" class="panel" style="height: 77.5%;">

					<!-- BREADCRUMBS -->
						<ul class="breadcrumb" style="padding: 2px 15px;">
                <li id="homeBreadCrumb" onclick = "backToHome()" ><a id="a-ListofIncidents"> Home </a> <span class="divider">/</span></li>
						</ul>

          <!-- HOME VIEW -->
          <div class="span12" id="homeView">
              <a onclick="incidentList()" id="a-ListofIncidents"> Incidents</a><br>
              <a onclick="livelihoodList()" id="a-ListofLivelihoodOrgs"> Livelihood Organizations</a><br>
              <a onclick="barangayList()" id="a-ListofBarangays"> Barangays</a>
          </div>

       <!--  <div id="mapElementsDetails" style="display:none"> -->
					<!-- LIST OF INCIDENTS -->
					<div class = "span12" id="incidentList" style="display:none"></div>
					<!-- end LIST OF INCIDENTS -->

					
					
					<!-- DISPLAY INCIDENT DETAILS DIV -->
          <div id="incidentTabbable" class="incidentTabbable" style="display:none;">
              <h5><div id="incident-title" style="color:darkorange;"> <!-- INCIDENT TITLE--></div></h5>
              
            <ul class="nav nav-tabs">
						  
								<li class="active"><a id="details-tab" href="#tab1" data-incidentid="" data-toggle="tab"> Details </a></li>
								<li onclick="victimsTab()"><a href="#tab2" id="victims-tab" class="victims-tab" data-incidentid="" data-toggle="tab"> Victims </a></li>
							</ul>
							<div id="tab-content" class="tab-content">
                              
                                <div class="tab-pane active" id="tab1">
                                    <ul class="nav nav-pills">
                                        <li class="active">
                                          <a href="#" id="overview-li" data-incidentid="" onclick="displayDetails()"><i class="icon-white icon-info-sign"></i> Overview</a>
                                        </li>
                                         <li>
                                             <a href="#" id="approve-li" class="approve-li" data-incidentid="" onclick="rateIncident(1)" style="color:whitesmoke"> <span id="span-approve-li" style="font-size:21px"></span> <i class="icon-white icon-thumbs-up"></i> Approve</a>
                                         </li>
                                         <li>
                                             <a href="#" id="disapprove-li" class="disapprove-li" data-incidentid="" onclick="rateIncident(0)" style="color:whitesmoke"> <span id="span-disapprove-li" style="font-size:21px"></span> <i class="icon-white icon-thumbs-down"></i> Disapprove</a>
                                         </li>
                                        <?php if($this->session->userdata('user_type') == 'cdrrmo' || $this->session->userdata('user_type') == 'bdrrmo'){?>
                                            <li>
                                              <a href="#" id="editinfo-li" data-incidentid="" onclick="modifyIncident()"><i class="icon-white icon-edit"></i> Edit Info</a>
                                            </li>
                                            <li>
                                              <a href="#" id="delete-li" data-incidentid="" role="button" data-toggle="modal" ><i class="icon-white icon-trash"></i> Delete</a>
                                            </li>
                                        <?php }?>
                                         
                                    </ul> 
								    <div id="incident-information" style="font-size: 12px; line-height:normal"></div>
                                     
                              </div>
                              <div class="tab-pane" id="tab2">
								<ul class="nav nav-pills">
								  <li class="active" onclick="victimsTab()">
									<a href="#" id="victimslist-li" data-incidentid=""><i class="icon-white icon-list-alt"></i> List of Victims</a>
								  </li>
								  <li>
									<a href="#" id="reportvictim-li" role="button" data-toggle="modal" ><i class="icon-white icon-pencil"></i> Report Victim</a>
								  </li>
								</ul>
                                  <div id="victimListID">
                                    <center>
                                        <form class="form-search">
                                            <input type="text" class="input-large search-query" placeholder="Type name here...">
                                            <button type="submit" class="btn"><i class="icon-search"> </i></button>
                                        </form>
                                    </center>
										<!-- TABLE: LIST OF VICTIMS -->
                                          <div id="table-rows-victims"></div>
										<!-- end of the table-->
                                  </div>
                              </div>
                                
                            </div>
               </div>
					<!-- end DISPLAY INCIDENT DETAILS -->



        <!-- LIST OF Livelihood Programs -->
        <div class = "span12" id="livelihoodList" style="display:none"></div>

            <!--  DISPLAY Livelihood Program Details -->
            <div id="livelihoodTabbable" class="livelihoodTabbable" style="display:none">
              <div id="livelihood-information" ></div>
              <div id="livelihood-membersTable" class="table table-condensed " style="color:#cccccc;"></div>
            </div>

            <!-- LIST OF Barangays -->
        <div class = "span12" id="barangayList" style="display:none"></div>

            <!--  display Barangay Resources details -->
            <div id="barangayTabbable" class="barangayTabbable" style="display:none">
              <div id="manageResourceButton"></div>
              <h4><div style="color:darkorange;">Physical Resources</div></h4>
              <div id="physical-resource" style="color:white;"></div>
              <h4><div style="color:darkorange;" >Natural Resources</div></h4>
              <div id="natural-resource" style="color:white;"></div>
              <h4><div style="color:darkorange;">Human Resources</div></h4>
              <div id="human-resource" style="color:white;"style="color:white;"></div>
              <h4><div style="color:darkorange;">Social Resources</div></h4>
              <div id="social-resource" style="color:white;" ></div>
              <h4><div style="color:darkorange;">Financial Resources</div></h4>
              <div id="financial-resource" style="color:white;"></div>
              <!--<div id="livelihood-membersTable" class="table table-condensed " style="color:#cccccc;"></div> -->
            </div>

					
				<!-- </div>  end of map elements details div  -->
				</div>	<!-- end #PANEL .PANEL 	-->
                   
              <a  id= "trigger" class="trigger" href="#">
                  <!-- onclick="displayList()-->
                 <i class="icon-chevron-right-white" id="field" type="button">   </i>              
              </a>

            <div id= "map_canvass">
              <div id="map_canvas" style="top:40px; width:100%; height:585px;"></div>   
            </div>
            <div id="customSearchBox">
              <br><input id="pac-input" type="text" placeholder="Search Box">
			     </div>
	<!-- MODALS: confirmVictim, confirmIncident, detailsVictim, reportVictim, deleteIncident, deleteVictim, updateVictim>
			
 	<!-- modalConfirmVictim -->
            <div id="modalConfirmVictim" class="modal hide fade" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_016_bin.png"  alt="bin" style="margin-top:-10px"> Confirm Victim</h3>
                </div>
                 <div class="modal-body">
                    <div name="message">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btnYesConfirmVictim" class="btn btn-primary" onclick="btnYesConfirmVictim()">Confirm</a>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Cancel</a>
                </div>
            </div> 
			<!-- end modalConfirmVictim -->
			
			<!-- modalConfirmIncident -->
			 <div id="modalConfirmIncident" class="modal hide fade" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_016_bin.png"  alt="bin" style="margin-top:-10px"> Confirm Incident</h3>
                </div>
                 <div class="modal-body">
                    <div name="message">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btnYesConfirmIncident" class="btn btn-primary" onclick="btnYesConfirmIncident()">Confirm</a>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Cancel</a>
                </div>
            </div> 
			<!-- end modalConfirmIncident -->
			
 
			<!-- modalDetailsVictim -->
			  <div id="modalDetailsVictim" class="modal hide fade" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_024_parents.png"  alt="bin" style="margin-top:-10px"> Victim Details</h3>
                </div>
                 <div class="modal-body">
					<div class= "row-fluid">
						<div class="span4">Victim Name: </div><div class="span8" id="full_name"></div>
					</div>
					<div class= "row-fluid">
						<div class="span4">Address: </div><div class="span8" id="address"></div>
					</div>
					<div class= "row-fluid">
						<div class="span4">Status: </div><div class="span8" id="victim_status"></div>
					</div><br /> 
					<div class= "row-fluid"><span class="span2"></span><center>
						<button id="approved-victim" class="span3 btn btn-large alert-info" type="button"><img id="iThumbsUp2" src= "<?php echo base_url();?>img/glyphicons/png/glyphicons_343_thumbs_up.png" /><h4><div class="rateTrue" style="color: blue; display:inline-table;"> </div></h4></button>
						<span class="span1"></span>
						<button id="disapproved-victim" class="span3 btn btn-large alert-error" type="button"><img id= "iThumbsDown2" src= "<?php echo base_url();?>img/glyphicons/png/glyphicons_344_thumbs_down.png" /><h4><div class="rateFalse" style="color: red; display:inline-table;"> </div></h4></button>
					</center></div>
					<br />
					<div id="flag_confirmed"> </div>
				
					
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Back</a>
                </div>
            </div> 
			<!-- end modalDetailsVictim -->
			
			<!-- modalReportVictim -->
			  <div id="modalReportVictim" class="modal hide fade" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_333_bell.png"  alt="bin" style="margin-top:-10px"> Report Victim</h3>
                </div>
                 <div class="modal-body">
				 
					<form method = "post" action = "" name= "reportVictimForm" id= "reportVictimForm">
				 
                    <?php  
						/** A LOGIN MODAL
						 ** uses application/views/js/formSubmission.js 
						 */
							$this->load->view('forms/victimReport');		
					?>
					<div name="message">
                    </div>
                </div>
                <div class="modal-footer">
				
					<?php 
					$buttonProperties=array('type'=>'submit', 'id'=>'btnYesReportVictim', 'class'=>'btn btn-primary','name'=>'victim_report','value'=>'Submit Report');
					echo form_submit($buttonProperties);
					?>
					</form>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancel</a>
                </div>
            </div> 
			<!-- end modalReportVictim -->
			
			<!-- modalUpdateVictim -->
			<div id="modalUpdateVictim" class="modal hide fade" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_150_edit.png"  alt="bin" style="margin-top:-10px"> Edit Victim</h3>
                </div>
                
				<div class="modal-body">
				
						
						<form method = "post" action = "<?php echo base_url();?>Victim/updateVictim" name= "updateVictimForm" id= "updateVictimForm">
				 						<?php $this->load->view('forms/victimReport');?>
                </div>
                <div class="modal-footer">
					<?php $submit_property = array( 'type' => 'submit', 'class' => 'btn btn-primary', 'name' => 'update', 'value' =>'Update Victim');
						   echo form_submit($submit_property);
					?>
					</form>
					<a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancel</a>
                </div>
            </div> 
			<!-- end modalUpdateVictim -->
			
			<!-- modalDeleteIncident -->
			 <div id="modalDeleteIncident" class="modal hide fade" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_016_bin.png"  alt="bin" style="margin-top:-10px"> Delete Incident</h3>
                </div>
                     <div class="modal-body">
                    <div name="message">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btnYesDeleteIncident" class="btn danger">Yes</a>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
                </div>
      </div> 
			<!-- end modalDeleteIncident -->
			
			<!-- modalDeleteVictim -->
			 <div id="modalDeleteVictim" class="modal hide fade" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_016_bin.png"  alt="bin" style="margin-top:-10px"> Delete Incident</h3>
                </div>
                 <div class="modal-body">
                    <div name="message">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btnYesDeleteVictim" class="btn danger">Yes</a>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
                </div>
      </div> 
			<!-- end modalDeleteVictim -->
      <div class = "modal hide fade" id="modalSuccessResponseOrgUndeploy">
          <div class = "modal-header">
            <a class="close" data-dismiss="modal">x</a>
            <h3>Response Organization successfully undeployed</h3>
          </div>
          <div class="modal-footer">
            <a href="http://localhost/icdrris/" class="btn btn-primary">Okay</a>
          </div>
      </div>
      <div id="modalLivelihoodProgramList" class="modal hide fade" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_016_bin.png"  alt="bin" style="margin-top:-10px"> Select Livelihood Program</h5>
                </div>
                <div class="modal-body">
                    <div id='livelihoodProgramsList'>
                      <?php
                        foreach ($programs as $program) {
                            echo "<label class='radio'><input type='radio' name='programs_radio_button' id='programs_radio_button' data-id=".$program->livelihood_program_id.">".$program->livelihood_description."</input></label>";
                        }
                      ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="proceedToResourcesList" class="btn danger">Next</a>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancel</a>
                </div>
      </div>
    <div id="livelihoodProgramResourceListModal" class="modal hide fade">
        <div class="modal-body" id="livelihoodProgramResourceListModalBody">           
        </div>
        <div class="modal-footer">
            <a href="javascript:$('#modalLivelihoodProgramList').modal('show'), $('#livelihoodProgramResourceListModal').modal('hide')" class="btn secondary">Back to list</a>
            <a class="btn" id="confirmDeploymentModal">Confirm Deployment</a>
            <a href="javascript:$('#livelihoodProgramResourceListModal').modal('hide')" class="btn secondary">Cancel</a>
        </div>
    </div>
    <div id="modalGrantProgramFromMapSuccess" class="modal hide">
    <div class="modal-body">
        <div name="message">
            Livelihood Program successfully deployed
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:$('#modalGrantProgramFromMapSuccess').modal('hide')" class="btn secondary">Okay</a>
    </div>
</div>
			
			<div id="directionsPanel"></div>
                        
	    </div>
	  </div>
	</div>

