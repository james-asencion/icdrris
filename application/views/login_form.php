  
<?php if(!$this->session->userdata('is_logged_in')){ ?>
	<ul class="nav pull-right">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				Log-in
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
				

    <?php  if((function_exists('validation_errors') && validation_errors() != '') && isset($err_login)){?>
             <div class="error alert-error" style= "margin: .5em .5em .5em .5em">
                    <a class="close" data-dismiss="alert">&times;</a>  
                    <div style= "padding:.5em"><strong>Error!</strong>	<br />
                    <font size= "2">
                        <?php // found in system/libraries/Form_validation.php
                            echo validation_errors();
                        ?>
                    </font>
                    </div>
                </div> 
    <?php } ?>

    <?php  if(isset($succ_login)){ ?>
                <div class="alert alert-success" style= "margin: .5em .5em .5em .5em" >  
                    <a class="close" data-dismiss="alert">&times;</a>  
                   <div style= "padding:.5em"> <strong>Success!</strong>	<br />
                     <font size= "2">  
                         <?php 
                            echo $succ_message;  
                        ?>
                    </font>
                   </div>
                </div> 
    <?php } ?>
				
									
				<form method = "post" action = "<?php echo base_url();?>Login/validate_credentials" style = "margin:10px">
					<?php 
					$username_property = array( 'type' => 'text', 'name' => 'username', 'placeholder' => 'Username','value'=>set_value('username'));
						echo form_input($username_property); 
					$password_property = array( 'type' => 'password', 'name' => 'password', 'placeholder' => 'Password');
						echo form_input($password_property); 
					$submit_property = array( 'type' => 'submit', 'class' => 'btn btn-primary', 'style' => 'width:100%', 'name' => 'login', 'value' =>'Login');
						echo form_submit($submit_property);
					?>
								
				</form>
				<li class = "divider"></li>
				<p style = "margin:10px">Not a member? <a href = "<?php echo base_url();?>Login/signup">Signup now!</a></p>
			</ul>
		</li>
	</ul>
<?php } ?>	

 <!-- SEARCH BAR FROM HEADER
		<form class = "navbar-search pull-right">
			<input type = "text" class = "search-query" placeholder = "Search">
		</form>	
	</div>
</div>
-->

<!--	CALL VIEW 'SIGNUP' INSTEAD	
<div class = "row-fluid">
	<div class = "span3"></div>
	<div class = "span6">
		<h1>Sign up.</h1>
		<br>

		<fieldset>
			<?php //echo form_open('Login/create_account');?>
			<div class = "row-fluid">
				<strong>First Name</strong><br>
				<input type = "text" class = "span8"/>
			</div>
			<div class = "row-fluid">
				<strong>Last Name</strong><br>
				<input type = "text" class = "span8"/>
			</div>
			<div class = "row-fluid">
				<strong>Username</strong><br>
				<input type = "text" class = "span8"/>
			</div>
			<div class = "row-fluid">
				<strong>Password</strong><br>
				<input type = "password" class = "span8">
			</div>
			<div class = "row-fluid">
				<input type = "submit" class = "btn btn-primary" name = "login" value = "Sign up"/>
			</div>
		</fieldset>
	
	</div>
	<div class = "span3"></div>
</div> 
-->
