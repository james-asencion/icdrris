    </div>
        
        <div id="controls" style="display:block">
            <div class="toppanel">
                <form class = "navbar-form pull-left" name="filterForm1">
                    <div class="center" align="center"><p>View Incidents by:</p>   
                            <select class="span2" name="filterMenu1" onChange="filterReports()">
                                    <option value=""></option>
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
                                <option value='FlashFlood'>Flashflood</option>
                                <option value='LandSlide'>Landslide</option>
                                <option value='MudSlide'>Mudslide</option>
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
                           
							<div id="incident-title"> <!-- INCIDENT LIST of TABS --></div>
							
                           
                           <div id="tab-content" class="tab-content">
                              
                                <div class="tab-pane active" id="tab1">
                                    <ul class="nav nav-pills">
                                        <li class="active">
                                          <a href="#" class="field" id="field" onclick="displayDetails()"><i class="icon-white icon-info-sign"></i> Overview</a>
                                        </li>
                                        <li>
                                          <a href="#" class="edit-btn" id="edit-btn" onclick="modifyIncident()"><i class="icon-white icon-edit"></i> Edit Info</a>
                                        </li>
                                        <li>
                                          <a href="#myModal" role="button" data-toggle="modal" ><i class="icon-white icon-trash"></i> Delete</a>
                                        </li>
                                        <li>
                                          <a href="#"><i class="icon-white icon-globe"></i> Stat Graphs</a>
                                        </li>
                                    </ul> 
								    <div id="incident-information" style="font-size: 12px; line-height:normal"></div>
                                     
                              </div>
                              <div class="tab-pane" id="tab2">
								<ul class="nav nav-pills">
								  <li class="active">
									<a href="#"><i class="icon-white icon-list-alt"></i> List of Victims</a>
								  </li>
								  <li >
									<a href="#"><i class="icon-white icon-pencil"></i> Report Victim</a>
								  </li>
								</ul>
                                  <div id="victimListID">
                                    <center>
                                        <form class="form-search">
                                            <input type="text" class="input-large search-query" placeholder="Type name here...">
                                            <button type="submit" class="btn"><i class="icon-search"> </i></button>
                                        </form>
                                    </center>
                       
                                   
                                          <div id="table-rows-victims"></div>
                                      
                                  </div>
                              </div>
                                
                            </div>
               </div>
					<!-- end DISPLAY DETAILS -->
					
					
				</div>	<!-- end #PANEL .PANEL 	-->
                   
              <a  id= "trigger" class="trigger" href="#">
                 <i class="icon-chevron-right-white" id="field" type="button" onclick="displayList()">   </i>
                
              </a>
			<div id= "map_canvass">
              <div id="map_canvas" style="width:100%; height:570px;"></div>   
            </div>
			<div id="directionsPanel"></div>
	    </div>
	  </div>
	</div>

