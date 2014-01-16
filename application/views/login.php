<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

?>


<?php $this->load->view('includes/header'); ?>

</div>
</div>

<div class = "row-fluid">
	<div class = "span3"></div>
	<div class = "span5">
	
	<h1>Login</h1>
	<br>
	  
	  <?php  if((function_exists('validation_errors') && validation_errors() != '') && isset($err_login)){?>
             <div class="error alert-error">
                <a class="close" data-dismiss="alert">&times;</a>  
                <div style= "padding:.5em"><strong>Error!</strong>	<br />
                    <?php // found in system/libraries/Form_validation.php
                        echo validation_errors();
                    ?>
                </div>
            </div> 
        <?php } ?>

        <?php  if(isset($succ_login)){ ?>
            <div class="alert alert-success" >  
                <a class="close" data-dismiss="alert">&times;</a>  
               <div style= "padding:.5em"> <strong>Success!</strong>	<br />
                     <?php echo $succ_message;  ?>
               </div>
            </div> 
        <?php } ?>
        
	<fieldset>
            <br />
            <form method = "post" action = "<?php echo base_url();?>Login/validate_credentials">
                <?php 
                $username_property = array( 'type' => 'text', 'name' => 'username', 'placeholder' => 'Username','value'=>set_value('username'));
                        echo form_input($username_property).'<br />';
                $password_property = array( 'type' => 'password', 'name' => 'password', 'placeholder' => 'Password');
                        echo form_input($password_property).'<br /><br />';
                $submit_property = array( 'type' => 'submit', 'class' => 'btn btn-primary', 'style' => 'width:50%', 'name' => 'login', 'value' =>'Login');
                        echo form_submit($submit_property).'<br /><br />';
                ?>						
            </form>
            <p class = "divider"></li>
            <p>Not a member? <a href = "<?php echo base_url();?>Login/signup">Signup now!</a></p>
			
		
		</fieldset>
		
	</div>
        
        <div class = "span3"></div>
	</div>


<?php $this->load->view('includes/footer'); ?>


