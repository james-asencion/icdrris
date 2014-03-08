<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

//VICTIM REPORT FORM

?>

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
                    <strong>First Name</strong><br>
                    <?php 
                            $fNameProperties=array('type'=>'text','class'=>'span8','id'=>'first_name','name'=>'first_name', 'value'=>set_value('first_name'));
                            echo form_input($fNameProperties);?>
		</div>

                <div class = "row-fluid">
		<strong>Middle Name</strong><br>
		<?php 
			$mNameProperties=array('type'=>'text','class'=>'span8','id'=>'middle_name' ,'name'=>'middle_name', 'value'=>set_value('middle_name'));
			echo form_input($mNameProperties);?>
		</div>

		<div class = "row-fluid">
		<strong>Last Name</strong><br>
		<?php 
			$lNameProperties=array('type'=>'text','class'=>'span8', 'id'=>'last_name', 'name'=>'last_name','value'=>set_value('last_name'));
			echo form_input($lNameProperties);?>
		</div>

		<div class = "row-fluid">
		<strong>Address</strong><br>
		<?php 
			$addressProperties=array('type'=>'text','class'=>'span8','id'=>'addressvictim', 'name'=>'addressvictim', 'value'=>set_value('addressvictim'));
			echo form_input($addressProperties);?>
		</div>
                <div class = "row-fluid">
		<strong>Victim Status</strong><br>
		<?php 
                    $vstat_options = array(
                            ' '     => '-Select-',
                            'dead'  => 'Dead',
                            'alive'    => 'Alive',
                            'missing'   => 'Missing',
                            'injured' => 'Injured',
                          );
			$vstatProperties=array('id'=>'victim_status');
			echo form_dropdown('victim_status', $vstat_options, $vstatProperties);?>
		</div>
		<!--<div class = "row-fluid">
		<?php /**
			$buttonProperties=array('type'=>'submit','class'=>'btn btn-primary','name'=>'victim_report','value'=>'Submit Report');
			echo form_submit($buttonProperties);
			*/
		?>
		</div> -->