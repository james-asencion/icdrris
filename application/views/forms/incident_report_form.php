
		<div class = "row-fluid">
			<strong>Incident Description</strong><br>
			<?php 
				$fNameProperties=array('type'=>'text','class'=>'span8','id'=>'incident_description','name'=>'incident_description', 'value'=>set_value('incident_description'), 'required'=>'required');
				echo form_input($fNameProperties);?>
		</div>

		<div class = "row-fluid">
			<strong>Disaster Type</strong><br>
				<select id="disasterType" required="required">
					<option value="" SELECTED>-SELECT-</option>
					<option value="Flashflood">Flash Flood</option>
					<option value="Tsunami">Tsunami</option>
					<option value="Landslide">Landslide</option>
					<option value="Mudslide">Mudslide</option>
				</select>
		</div>

		<div class = "row-fluid">
			<strong>Date Happened</strong><br>
			<?php 
				$lNameProperties=array('type'=>'date','class'=>'span5', 'id'=>'date_happened', 'name'=>'date_happened','value'=>set_value('date_happened'), 'required'=>'required');
				echo form_input($lNameProperties);?>
		</div>