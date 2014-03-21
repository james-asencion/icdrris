
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
			<strong>Deaths</strong><br>
			<?php 
				$deaths=array('type'=>'number', 'min'=>'0', 'class'=>'span5','id'=>'death','name'=>'death', 'value'=>set_value('death'));
				echo form_input($deaths);?>
		</div>
		
		<div class = "row-fluid">
			<strong>Injured</strong><br>
			<?php 
				$injured=array('type'=>'number', 'min'=>'0', 'class'=>'span5','id'=>'injured','name'=>'injured', 'value'=>set_value('injured'));
				echo form_input($injured);?>
		</div>
		
		<div class = "row-fluid">
			<strong>Missing</strong><br>
			<?php 
				$missing=array('type'=>'number', 'min'=>'0', 'class'=>'span5','id'=>'missing','name'=>'missing', 'value'=>set_value('missing'));
				echo form_input($missing);?>
		</div>
	
		<div class = "row-fluid">
			<strong>Families Affected</strong><br>
			<?php 
				$families_affected=array('type'=>'number', 'min'=>'0', 'class'=>'span5','id'=>'families_affected','name'=>'families_affected', 'value'=>set_value('families_affected'));
				echo form_input($families_affected);?>
		</div>
		
		<div class = "row-fluid">
			<strong>Houses Destroyed</strong><br>
			<?php 
				$houses_destroyed=array('type'=>'number', 'min'=>'0', 'class'=>'span5','id'=>'houses_destroyed','name'=>'houses_destroyed', 'value'=>set_value('houses_destroyed'));
				echo form_input($houses_destroyed);?>
		</div>
		
		<div class = "row-fluid">
			<strong>Damage Costs</strong><br>
			<?php 
				$damage_costs=array('type'=>'number', 'min'=>'0', 'class'=>'span5','id'=>'damage_costs','name'=>'damage_costs', 'value'=>set_value('damage_costs'));
				echo form_input($damage_costs);?>
		</div>
		
		<div class = "row-fluid">
			<strong>Source</strong><br>
			<?php 
				$source=array('type'=>'text', 'class'=>'span8','id'=>'source','name'=>'source', 'value'=>set_value('source'), 'required'=>'required');
				echo form_input($source);?>
		</div>
