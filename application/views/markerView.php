<!--
/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */
-->
<script src="<?php echo base_url();?>application/views/js/markerScript.js"></script>

</div>
 <div id= "map_canvass">
              <div id="map_canvas" style="width:100%; height:570px;"></div>   
 </div>

<div class = "modal hide fade" id="markerInstructionModal">
  	<div class = "modal-header">
  		<a class="close" data-dismiss="modal">x</a>
  		<h3>Click a point on the map to produce a marker</h3><br>
  		<h5>hint: "you can drag the marker to change the location"</h5>
  	</div>
  	<div class="modal-body">
  		<p>This is an instruction...</p>
  	</div>
  	<div class="modal-footer">
  		<a data-dismiss="modal" class="btn btn-primary">Okay Got it</a>
  	</div>
</div>
<div class = "modal hide fade" id="modalSuccessReportMarker">
  	<div class = "modal-header">
  		<a class="close" data-dismiss="modal">x</a>
  		<h3>Incident successfully reported</h3>
  	</div>
  	<div class="modal-footer">
  		<a href="http://localhost/icdrris/" class="btn btn-primary">Okay</a>
  	</div>
</div>
<div class = "modal hide fade" id="modalSuccessReportPolygon">
  	<div class = "modal-header">
  		<a class="close" data-dismiss="modal">x</a>
  		<h5>Sorry something went wrong</h5>
  	</div>
  	<div class="modal-footer">
  		<a href="http:/localhost/icdrris/" data-dismiss="modal" class="btn btn-primary">Back to Home</a>
  	</div>
</div>

</div>