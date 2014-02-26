</div></div>
<div class = "container-fluid">
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

	<select name = "trial">
		<option value = "null">Select</option>
	<?php	foreach($skills as $skill) {
			echo "<label class=\"checkbox\"><input type=\"checkbox\">";
			echo "<option value = \"".$skill->skillset_description."\">".$skill->skillset_description."</option>";
			echo "</label>";
		} ?>
	</select>
</div>