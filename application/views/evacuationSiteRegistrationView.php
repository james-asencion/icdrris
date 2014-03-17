<!--
/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */
-->
<script src="<?php echo base_url();?>application/views/js/evacuationSiteScript.js"></script>

</div>
 <div id= "map_canvass">
              <div id="map_canvas" style="width:100%; height:570px;"></div>   
 </div>

<div class = "modal hide fade" id="evacuationSiteRegistrationInstruction">
  	<div class = "modal-header">
  		<a class="close" data-dismiss="modal">x</a>
  		<h3>Click a point on the map to produce a marker corresponding to the location of the evacuation site</h3><br>
      <h4>after indicating the location you can click on the marker and fill-up the form that will pop-out</h4><br>
  		<h5>hint: "you can drag the marker to change the location"</h5>
  	</div>
  	<div class="modal-footer">
  		<a data-dismiss="modal" class="btn btn-primary">Okay Got it</a>
  	</div>
</div>
<div class = "modal hide fade" id="successEvacuationSiteRegistration">
  	<div class = "modal-header">
  		<a class="close" data-dismiss="modal">x</a>
  		<h3>Evacuation Site successfully mapped and registered</h3>
  	</div>
  	<div class="modal-footer">
  		<a href="http://localhost/icdrris/" class="btn btn-primary">Okay</a>
  	</div>
</div>
<div class = "modal hide fade" id="errorEvacuationSiteRegistration">
    <div class = "modal-header">
      <a class="close" data-dismiss="modal">x</a>
      <h3>Oppss... there's something wrong with the registration please try again</h3>
    </div>
    <div class="modal-footer">
      <a href="http://localhost/icdrris/" class="btn btn-primary">Try Again</a>
    </div>
</div>

</div>