<?php $this->load->view('includes/header');?>
<?php $this->load->view('login_form'); ?>
</div>
</div>

<div class = "row-fluid">
	<div class = "span3"></div>
	<div class = "span6">
	
	<h1>Sign up.</h1>
	<br>
	  
		<div class="alert alert-error" >  
		<a class="close" data-dismiss="alert">x</a>  
		<strong>Error!</strong>	<br />
			<?php // found in system/libraries/Form_validation.php
				echo validation_errors();
			?>
                </div> 
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