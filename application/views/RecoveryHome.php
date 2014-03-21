    </div>
        
        <div id="controls" style="display:block">
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
              <a onclick="barangayList()" id="a-ListofBarangays"> Barangays</a>
          </div>

       <!--  <div id="mapElementsDetails" style="display:none"> -->
          <!-- LIST OF INCIDENTS -->

            <!-- LIST OF Barangays -->
        <div class = "span12" id="barangayList" style="display:none"></div>

            <!--  display Barangay Resources details -->
            <div id="barangayTabbable" class="barangayTabbable" style="display:none">
              <h4><div style="color:darkorange;">Recovery Status</div></h4>
              <div id="recovery-status" style="color:white;"></div>
              <h4><div style="color:darkorange;" >Recovery Assessment</div></h4>
              <div id="recovery-assessment" style="color:white;"></div>
            </div>

          
        <!-- </div>  end of map elements details div  -->
        </div>  <!-- end #PANEL .PANEL  -->
                   
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

