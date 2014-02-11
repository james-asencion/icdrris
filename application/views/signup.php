	<?php $this->load->view('includes/header');?>
	<?php $this->load->view('forms/login_form'); ?>
	</div>
</div>
<!-- A SIGNUP FORM PAGE (logged in)-->
	<?php if(!$this->session->userdata('is_logged_in')){ 
		 $this->load->view('forms/signup_form'); 
	}?>
	
<!-- A SIGNUP FORM PAGE (not logged in)-->
	<?php if($this->session->userdata('is_logged_in')){ ?>
	<div class = "row-fluid">
		<div class = "span1"></div>
		<div class = "span10">
			<div class="alert">
			  <h3><strong>Opps!</strong> You are currently logged in. </h3>
			  <div class="span1"></div>
			  Please click the button below to go back to the previous page or to log-out and create an account. 				
			  <br /><br />
			  <center>
				<a href="javascript:history.go(-1)"><button type="button" class="btn btn-info"><i class= "icon-white icon-arrow-left" ></i> Go back</button></a>					
			    <a href = "<?php echo base_url().'Home/logout' ?>"><button type="button" class="btn btn-inverse"><i class = "icon-white icon-off"></i> Log-out</button></a>
			  </center>
			  <br />
			</div>
			
		</div>
	</div>	
	<?php }?>	
	
	
<?php $this->load->view('includes/footer');?>