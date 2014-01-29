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
             
              <div class="panel" style="height: 87%;">
                <div class = "span12" id="incidentList"></div>
		<div style="clear:both;"></div>
                <!--<div class="pagination">
                    <ul>
                      <li class="disabled"><a href="#">&laquo;</a></li>
                      <li class="active"><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li><a href="#">&raquo;</a></li>
                    </ul>
                </div> -->
                <?php //echo $links; ?> <br />
                <?php //echo $total_rows; ?>
            </div>
                   
              <a class="trigger" href="#">
                 <i class="icon-chevron-right-white" id="field" type="button" onclick="displayList()">   </i>
                 <!--<i onclick="displayList()"></i>-->
              </a>
	
              <div id="map_canvas" style="width:100%; height:600px;"></div>   
              <div id="directionsPanel"></div>
	    </div>
	  </div>
	</div>

