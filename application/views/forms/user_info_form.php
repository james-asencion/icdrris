	<div id="modalAccountSettings" class="modal hide fade" data-userid="<?php echo $this->session->userdata('user_id');?>" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<h3><img src="<?php echo base_url();?>img/glyphicons/png/glyphicons_150_edit.png"  alt="bin" style="margin-top:-10px"> Edit User Info</h3>
		</div>
			<div class="modal-body">
				<div id="message">
				</div>
				 <form action="" method="POST" name="accountSettingsForm" id="accountSettingsForm">			
				<div class = "row-fluid">
					<strong>First Name</strong><br>
					<?php 
						$fNameProperties=array('type'=>'text','class'=>'span8', 'id'=> 'ufirst_name', 'name'=>'first_name', 'value'=>$this->session->userdata('firstname'), 'required'=>'required');
						echo form_input($fNameProperties);?>
				</div>

				<div class = "row-fluid">
					<strong>Last Name</strong><br>
					<?php 
						$lNameProperties=array('type'=>'text','class'=>'span8', 'id'=>'ulast_name', 'name'=>'last_name','value'=>$this->session->userdata('lastname'), 'required'=>'required');
						echo form_input($lNameProperties);?>
				</div>
					
				<div class = "row-fluid">
					<strong>Email</strong><br>
					<?php 
						$emailProperties=array('type'=>'text','class'=>'span8', 'id'=>'uemail', 'name'=>'email','value'=>$this->session->userdata('email'), 'required'=>'required');
						echo form_input($emailProperties);?>
				</div>

				<div class = "row-fluid">
					<strong>Username</strong><br>
					<?php 
						$uNameProperties=array('type'=>'text','class'=>'span8','id'=>'uuser_name', 'name'=>'user_name','value'=>$this->session->userdata('username'), 'required'=>'required');
						echo form_input($uNameProperties);?>
				</div>
				
				<div class= "row-fluid">
					<a href="#" id="change_password_btn" class="btn btn-link" onclick="changepassword();"><strong>Change Password</strong><br></a>
				</div>
				
				<div id= "oldpass-div" class = "row-fluid" style="display:none">
					<strong>Old Password</strong><br>
					<?php 
						$oldPassword=array('type'=>'password','class'=>'span8','id'=>'oldpass', 'name'=>'oldpass');
						echo form_input($oldPassword);?>
				</div>
				
				<div id= "newpass-div" class = "row-fluid" style="display:none">
					<strong>New Password</strong><br>
					<?php 
						$newPassword=array('type'=>'password','class'=>'span8','id'=>'newpass', 'name'=>'newpass');
						echo form_input($newPassword);?>
				</div>
				
				<div id= "confirmpass-div" class = "row-fluid" style="display:none">
					<strong>Confirm Password</strong><br>
					<?php 
						$confirmPassword=array('type'=>'password','class'=>'span8','id'=>'confirmpass', 'name'=>'confirmpass');
						echo form_input($confirmPassword);?>
				</div>
				
					
			</div>
		<div class="modal-footer">
			<?php 
					$buttonProperties=array('type'=>'submit', 'id'=>'btnYesAccountSettings', 'class'=>'btn btn-primary','name'=>'accountSettings','value'=>'Save Changes');
					echo form_submit($buttonProperties);
					?>
					</form>
                    <a href="#" onclick="window.location.reload()" data-dismiss="modal"  class="btn">Cancel</a>
		</div>
	</div> 