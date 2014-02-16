    </div>
        
        <div id="controls" style="display:block">
            <div class="toppanel">
                <form class = "navbar-form pull-left" name="filterForm1">
                    <div class="center" align="center"><p>View Incidents by:</p>   
                            <select class="span2" name="filterMenu1" onChange="filterReports()">
                                    <option value='null'></option>
                                    <option value='Marker'> <i class = "icon-map-marker"></i>  Marker</option>
                                    <option value='Polygon'>Polygon</option>
                            </select>
                    </div> 
                </form>
            </div>
            <div class="toppanel">
                <form class = "navbar-form pull-left" name="filterForm2">
                    <div class="center" align="center"><p>Filter Incidents:</p>   
                        <select class="span2" name="filterMenu2" onChange="filterReports()">
                                <option value='null'></option>
                                <option value='Flashflood'>Flashflood</option>
                                <option value='Landslide'>Landslide</option>
                                <option value='Mudslide'>Mudslide</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="toppanel"> 
                <form class = "navbar-form pull-left" name="filterForm3">
                    <div class="center" align="center"><p>Date To:</p>   
                        <input type = "date" name = "birthdate" class = "span2" />
                    </div>
                </form>
            </div>
            <div class="toppanel"> 
                <form class = "navbar-form pull-left" name="filterForm4">
                    <div class="center" align="center"><p>Date From:</p>   
                       <input type = "date" name = "birthdate" class = "span2" />
                    </div>
                </form>
            </div>
            <div class="toppanel"></div>
        </div>		
</div>
        
	
	<div class = "container-fluid">
          <div class = "row-fluid">
            <div class = "span12">
             
				<div id= "panel" class="panel" style="height: 95%;">
					<!-- BREADCRUMBS -->
						<ul class="breadcrumb" style="padding: 2px 15px;">
								<li id="li0" onclick = "backToList()" ><a id="a-ListofIncidents"> List of Incidents</a> <span class="divider">/</span></li>
						</ul>
					<!-- LIST OF INCIDENTS -->
						<div class = "span12" id="incidentList"></div>
					<!-- end LIST OF INCIDENTS -->
					
					<!-- PAGINATION --INSIDE INCIDENTLIST DIV
						<div id= "pagination" class="pagination">
							<ul>
							  <li class="disabled"><a href="#">&laquo;</a></li>
							  <li class="active"><a href="#">1</a></li>
							  <li><a href="#">2</a></li>
							  <li><a href="#">3</a></li>
							  <li><a href="#">4</a></li>
							  <li><a href="#">5</a></li>
							  <li><a href="#">&raquo;</a></li>
							</ul>
						</div> 
					-->
						<?php //echo $links; ?>
						<?php //echo $links; ?>
						<?php //echo $total_rows; ?>
					<!-- end PAGINATION -->
					
					
					<!-- DISPLAY DETAILS DIV -->
                   
                       <div id="tabbable" class="tabbable" style="display:none">
                           
						   <ul class="nav nav-tabs" style="margin-bottom:10px;">
								<li class="span8" style="color:darkorange">
									<h4><div id="incident-title"> <!-- INCIDENT TITLE--></div></h4>
								</li>
								<li class="active"><a  id="details-tab" href="#tab1" data-incidentid="" data-toggle="tab"> Details </a></li>
								<li onclick="victimsTab()"><a href="#tab2" id="victims-tab" class="victims-tab" data-incidentid="" data-toggle="tab"> Victims </a></li>
							</ul> 
							
							
                           
                           <div id="tab-content" class="tab-content">
                              
                                <div class="tab-pane active" id="tab1">
                                    <ul class="nav nav-pills">
                                        <li class="active">
                                          <a href="#" id="overview-li" data-incidentid="" onclick="displayDetails()"><i class="icon-white icon-info-sign"></i> Overview</a>
                                        </li>
                                        <li data-id="">
                                          <a href="#" id="editinfo-li" data-incidentid="" onclick="modifyIncident()"><i class="icon-white icon-edit"></i> Edit Info</a>
                                        </li>
                                        <li>
                                          <a href="#myModal" id="delete-li" data-incidentid="" role="button" data-toggle="modal" ><i class="icon-white icon-trash"></i> Delete</a>
                                        </li>
                                        <li >
                                          <a href="#" id="displaychart-li" data-incidentid=""><i class="icon-white icon-globe"></i> Display Chart</a>
                                        </li>
                                    </ul> 
								    <div id="incident-information" style="font-size: 12px; line-height:normal"></div>
                                     
                              </div>
                              <div class="tab-pane" id="tab2">
								<ul class="nav nav-pills">
								  <li class="active" onclick="victimsTab()">
									<a href="#" id="victimslist-li" data-incidentid=""><i class="icon-white icon-list-alt"></i> List of Victims</a>
								  </li>
								  <li onclick="victimsTab()">
									<a href="#" id="reportvictim-li" data-incidentid=""><i class="icon-white icon-pencil"></i> Report Victim</a>
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
					<!-- end DISPLAY DETAILS -->
					
					
				</div>	<!-- end #PANEL .PANEL 	-->
                   
              <a  id= "trigger" class="trigger" href="#">
                  <!-- onclick="displayList()-->
                 <i class="icon-chevron-right-white" id="field" type="button">   </i>              
              </a>
           
<div id= "map_canvass">
    <div id="map_canvas" style="top:30px; width:100%; height:595px;"></div>   
</div>
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
			<div id="directionsPanel"></div>
                        
	    </div>
	  </div>
	</div>

