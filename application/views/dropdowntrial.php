</div></div>
<!--	<div class="multiselect">
    	<label><input type="checkbox" name="option[]" value="1" />Green</label>
    	<label><input type="checkbox" name="option[]" value="2" />Red</label>
    	<label><input type="checkbox" name="option[]" value="3" />Blue</label>
	</div>

<style type = "text/css">
.multiselect {
    width:10em;
    height:3em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
    color:#ffffff;
    background-color:#4DD025;
}
</style>

<script type = "text/javascript">
	jQuery.fn.multiselect = function() {
    $(this).each(function() {
        var checkboxes = $(this).find("input:checkbox");
        checkboxes.each(function() {
            var checkbox = $(this);
            // Highlight pre-selected checkboxes
            if (checkbox.prop("checked"))
                checkbox.parent().addClass("multiselect-on");
 
            // Highlight checkboxes that the user selects
            checkbox.click(function() {
                if (checkbox.prop("checked"))
                    checkbox.parent().addClass("multiselect-on");
                else
                    checkbox.parent().removeClass("multiselect-on");
            	});
        	});
    	});
	};

	$(function() {
    	$(".multiselect").multiselect();
	});

</script> -->
<div class = "container-fluid">
<div class="dropdown">
    <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
        Select Skills
        <b class="caret"></b>
    </a>
    <ul class="dropdown-menu dropdown-menu-form" role="menu">
       <?php 
        foreach($skills as $skill) {
          echo "<li><label class = \"checkbox\"><input type = \"checkbox\">".$skill->skillset_description."</label></li>";
        }
       ?>

   
    </ul>
</div>
</div>

<!--
<div class = "container-fluid">
  <div class = "row-fluid">
    <form class = "form-horizontal">
    <div class = "control-group"><label class = "control-label" for="name">Skills: </label><div class = "controls"><select multiple="multiple"><?php foreach($skills as $skill) { echo "<input type = \"checkbox\" data-label = \"suffix\" /><option id=".$skill->skillset_id.">".$skill->skillset_description."</option>";}?></select></div></div>
  </form></div>
</div>

-->
<!--

<div class = "toppanel1">
<div class="center"><p>View Incidents by:</p>   
                          <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
                              Select Elements
                              <b class="caret"></b>
                          </a>
    <ul class = "dropdown-menu dropdown-menu-form" role="menu">

	<?php	foreach($skills as $skill) {
      echo "<li><label class = \"checkbox\"><input type=\"checkbox\">".$skill->skillset_description."</label></li>";
		
		} ?></ul>
	</div>
</div>
-->

<!--<div id="controls" style="display:block">
            <div id="elementBoxes">
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
            </div>
        </div>-->