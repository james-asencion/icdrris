<!-- page is called at includes/header.php -->

<div id="modalLogin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true" >
     <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
          <h3> <img src="<?php echo base_url(); ?>img/glyphicons/png/glyphicons_386_log_in.png" alt="login"/> Login</h3>
     </div>
    <div class="modal-body">
        <fieldset>
			<div class="span5" style="">
			   <div id="login-msg">    
					<?php //error message inside here ?>
				</div>
				<center>
				<form method = "post" action = "<?php echo base_url();?>Login/validate_credentials" id= "loginForm" class="loginForm" style = "margin:10px">
				   <?php 
				   $username_property = array( 'type' => 'text', 'name' => 'username', 'id' => 'username', 'placeholder' => 'Username','value'=>set_value('username'));
						   echo form_input($username_property); 
					?>
					<br/>       
				   <?php
				   $password_property = array( 'type' => 'password', 'name' => 'password', 'id' => 'password', 'placeholder' => 'Password');
						   echo form_input($password_property); 
					?> 
					<br />
				   <?php $submit_property = array( 'type' => 'submit', 'class' => 'btn btn-primary', 'style' => 'width:50%', 'name' => 'login', 'value' =>'Login', 'onclick' => 'loginUser()');
						   echo form_submit($submit_property);
				   ?>
				</form>
				
				</center>
             
        </div>
        </fieldset>
    </div>
    <div class="modal-footer" style="text-align: center">
        <p style = "margin:10px">Not a member? <a href = "<?php echo base_url();?>Signup">Signup now!</a></p>
    </div>
   
</div>
