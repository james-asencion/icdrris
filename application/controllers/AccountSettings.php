<?php

class AccountSettings extends CI_Controller{
	
	public function __construct() {
		parent:: __construct();
		$this->load->model("membership_model");
	}
	
	public function password_matches($password)
	{
		$old_password= md5($password);
		$id= $this->session->userdata("user_id");
		if (!$this->membership_model->passwordMatches($id, $old_password)) {
			$this->form_validation->set_message('password_matches', 'The Old password does not match your previous password.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function modifyAccount(){   
		$user_id = $this->input->post("user_id");
		$username = $this->input->post("user_name");
		$old_password = $this->input->post("old_password");
		$new_password = $this->input->post("new_password");
		$confirm_password = $this->input->post("confirm_password");
		
		
				$this->form_validation->set_rules('user_first_name','First Name','trim|required');
				$this->form_validation->set_rules('user_last_name','Last Name','trim|required');
			if($this->session->userdata("username") != $username){
				$this->form_validation->set_rules('user_name','Username','trim|required|min_length[4]|is_unique[users.user_name]|xss_clean');
			}
			if($this->session->userdata("username") == $username){
				$this->form_validation->set_rules('user_name','Username','trim|required|min_length[4]|xss_clean');
			}
				$this->form_validation->set_rules("user_email", "Email", "required");
			if(!empty($old_password) || !empty($new_password) || !empty($confirm_password)){
				$this->form_validation->set_rules('old_password','Old Password','trim|required|min_length[4]|max_length[32]|callback_password_matches['.$old_password.']');
				$this->form_validation->set_rules('new_password','New Password','trim|required|min_length[4]|max_length[32]');
				$this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[new_password]');
			}
			
		if(($this->form_validation->run()) == FALSE){   //validation errors occur
				echo '<div class= "alert alert-error">
					   <strong> <span> <i class= "icon icon-exclamation-sign"> </i> Error </span></strong>
					   <br />
					   <center><font size= "2">
						  <!-- found in system/libraries/Form_validation.php-->'.
							   validation_errors().'
									  
					   </font></center>
				   </div>';
		}
		else{
			$user_lastname = $this->input->post("user_last_name");
			$user_first_name = $this->input->post("user_first_name");
			$user_email = $this->input->post("user_email");
			$newpass= md5($new_password);
			if($new_password != NULL && $new_password != ""){
				$query= $this->membership_model->changeAccountSettingswPass($user_id, $username,$user_first_name, $user_lastname, $user_email, $newpass);
			}
			if($new_password == NULL && $new_password != ""){
				$query= $this->membership_model->changeAccountSettings($user_id, $username,$user_first_name, $user_lastname, $user_email);
			}
			if($query){
				$query_getUser=$this->membership_model->getUserDetailsByID($user_id);
				
				foreach($query_getUser->result() as $row_user){
					 $user_id= $row_user->user_id;
					 $fname= $row_user->user_first_name;
					 $lname= $row_user->user_last_name;
					 $utype= $row_user->user_type;
					 $email= $row_user->user_email;
				}
				
				$data= array(
							'user_id' => $user_id,
							'username' => $username,
							'is_logged_in' => 1,
							'firstname' => $fname,
							'lastname' => $lname,
							'user_type' => $utype,
							'email' => $email
						);
				
				$this->session->set_userdata($data);
				echo "success";
			}
			else{
				echo $query;
			}
		}
	}   
	
}
?>