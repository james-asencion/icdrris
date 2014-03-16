
    <?php  if((function_exists('validation_errors') && validation_errors() != '') || isset($err_message)){?>
                <div class="alert alert-error" >  
                    <a class="close" data-dismiss="alert">&times;</a>  
                    <strong>Error!</strong>	<br />
                    <?php // found in system/libraries/Form_validation.php
                            echo validation_errors();
                            echo $err_message;
                            
                    ?>
                </div> 
    <?php } ?>

    <?php  if(isset($succ_message)){ ?>
                <div class="alert alert-success" >  
                    <a class="close" data-dismiss="alert">&times;</a>  
                    <strong>Success!</strong>	<br />
                    <?php 
                            echo $succ_message;  
                    ?>
                </div> 
    <?php } ?>

    
		<div class = "row-fluid">
			<strong>Incident Description</strong><br>
			<?php 
				$fNameProperties=array('type'=>'text','class'=>'span8','id'=>'incident_description','name'=>'incident_description', 'value'=>set_value('incident_description'));
				echo form_input($fNameProperties);?>
		</div>

		<div class = "row-fluid">
			<strong>Disaster Type</strong><br>
				<select id="disasterType">
					<option value="" SELECTED>-SELECT-</option>
					<option value="Flashflood" >Flash Flood</option>
					<option value="Tsunami">Tsunami</option>
					<option value="Landslide">Landslide</option>
					<option value="Mudslide">Mudslide</option>
					<option value="Infrastructure Damage">Infrastructure Damage</option>
				</select>
		</div>

		<div class = "row-fluid">
			<strong>Date Happened</strong><br>
			<?php 
				$lNameProperties=array('type'=>'date','class'=>'span5', 'id'=>'date_happened', 'name'=>'date_happened','value'=>set_value('date_happened'));
				echo form_input($lNameProperties);?>
		</div>