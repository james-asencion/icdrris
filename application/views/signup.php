<?php $this->load->view('includes/header');?>
<?php $this->load->view('login_form'); ?>
</div>
</div>

<div class = "row-fluid">
	<div class = "span3"></div>
	<div class = "span6">
	
	<h1>Sign up.</h1>
	<br>
	  
	 <?php  if((function_exists('validation_errors') && validation_errors() != '') && isset($err_message)){?>
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
	<fieldset>
		<?php echo form_open('Login/create_account');?>
		<div class = "row-fluid">
		<strong>First Name</strong><br>
		<?php 
			$fNameProperties=array('type'=>'text','class'=>'span8','name'=>'first_name', 'value'=>set_value('first_name'));
			echo form_input($fNameProperties);?>
		</div>

		<div class = "row-fluid">
		<strong>Last Name</strong><br>
		<?php 
			$lNameProperties=array('type'=>'text','class'=>'span8','name'=>'last_name','value'=>set_value('last_name'));
			echo form_input($lNameProperties);?>
		</div>

		<div class = "row-fluid">
		<strong>Username</strong><br>
		<?php 
			$uNameProperties=array('type'=>'text','class'=>'span8','name'=>'user_name','value'=>set_value('user_name'));
			echo form_input($uNameProperties);?>
		</div>
                <div class = "row-fluid">
		<strong>User Type</strong><br>
		<?php 
                    $usertype= array(
                            ' '     => '-Select-',
                            'icdrrmo'  => 'ICDRRMO',
                            'cswd'    => 'CSWD',
                            'cdlo'   => 'CDLO'
                          );
			$userTypeProperties=array(set_value('utype'));
			echo form_dropdown('utype', $usertype, $userTypeProperties);?>
		</div>
		<div class = "row-fluid">
		<strong>Password</strong><br>
		<?php 
			$passwordProperties=array('type'=>'password','class'=>'span8','name'=>'password');
			echo form_input($passwordProperties);?>
		</div>
		<div class = "row-fluid">
		<strong>Confirm Password</strong><br>
		<?php 
			$passwordProperties2=array('type'=>'password','class'=>'span8','name'=>'password2');
			echo form_input($passwordProperties2);?>
		</div>
		<div class = "row-fluid">
		<?php
			$buttonProperties=array('type'=>'submit','class'=>'btn btn-primary','name'=>'signup','value'=>'Sign up');
			echo form_submit($buttonProperties);
		?>
		</div>
		
		</fieldset>
		
	</div>
        
        <div class = "span3"></div>
	</div>

<?php $this->load->view('includes/footer');?>