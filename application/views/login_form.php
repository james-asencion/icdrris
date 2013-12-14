    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet" media="screen">
    <div class = "navbar navbar-inverse">
		<div class = "navbar-inner">
			<a class = "brand" href = "D:/bootstrap/reg1.html">ICDRRIS</a>
			<ul class = "nav">
				<li class = "active"><a href = "D:/bootstrap/reg1.html">Home</a></li>
			</ul>
		
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Log-in
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<form method = "post" action = "Login/validate_credentials" style = "margin:10px">
						<?php 
						$username_property = array( 'type' => 'text', 'name' => 'username', 'placeholder' => 'Username');
						echo form_input($username_property); 
						$password_property = array( 'type' => 'password', 'name' => 'password', 'placeholder' => 'Password');
						echo form_input($password_property); 
						$submit_property = array( 'type' => 'submit', 'class' => 'btn btn-primary', 'style' => 'width:100%', 'name' => 'login', 'value' =>'Login');
						echo form_submit($submit_property);
						?>
										
						</form>
						<li class = "divider"></li>
						<p style = "margin:10px">Not a member? <a href = "/icdrris/Login/signup">Signup now!</a></p>
					</ul>
				</li>
			</ul>
			
			<form class = "navbar-search pull-right">
				<input type = "text" class = "search-query" placeholder = "Search">
			</form>
			
			
			
		</div>
	</div>

	
	<div class = "row-fluid">
	<div class = "span3"></div>
	<div class = "span6">
	
	<h1>Sign up.</h1>
	<br>
	  
	
	<fieldset>
		<?php echo form_open('Login/create_account');?>
		<div class = "row-fluid">
		<strong>First Name</strong><br>
		<input type = "text" class = "span8"/></div>
		<div class = "row-fluid">
		<strong>Last Name</strong><br>
		<input type = "text" class = "span8"/></div>
		<div class = "row-fluid">
		<strong>Username</strong><br>
		<input type = "text" class = "span8"/></div>
		<div class = "row-fluid">
		<strong>Password</strong><br>
		<input type = "password" class = "span8"></div>
		<div class = "row-fluid">
		<input type = "submit" class = "btn btn-primary" name = "login" value = "Sign up"/>
		</div>
		</fieldset>
		
	</div>
	<div class = "span3"></div>
	</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>