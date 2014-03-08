<?php

class Login extends CI_Controller{
	
	public function __construct() {
		parent:: __construct();
		$this->load->model("membership_model");
	}

	function index()
	{   //first initialization of login form
            //$this->load->view('includes/templ ate');
			redirect('Home');
	}   
        
        function get_session(){
            $user_type= $this->session->userdata('user_type');
            echo $user_type;
        }
        
        public function home(){
		if($this->session->userdata('is_logged_in')){
			redirect('Home');
		} else{
			redirect('Login');
		}
	}
        
	function validate_credentials()
	{   //validate login form data
		$this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("password", "Password", "required|callback_verifyUser");
		
	    if($this->form_validation-> run() == false){
			//$this->load->view('login');
			echo '<div class= "alert alert-error">
					   <strong> <span> <i class= "icon icon-exclamation-sign"> </i> Error </span></strong>
					   <br />
					   <center><font size= "2">
						  <!-- found in system/libraries/Form_validation.php-->'.
							   validation_errors().'
									  
					   </font></center>
				   </div>';
		}else{
			$username = $this->input->post("username");
			$password = md5($this->input->post("password"));
			//$this->load->model('membership_model');
			$query=$this->membership_model->getUserDetails($username, $password);
			
			foreach($query->result() as $row_user){
				 $user_id= $row_user->user_id;
				 $fname= $row_user->user_first_name;
				 $lname= $row_user->user_last_name;
				 $utype= $row_user->user_type;
			}
			
			$data= array(
						'user_id' => $user_id,
						'username' => $username,
						'is_logged_in' => 1,
						'firstname' => $fname,
						'lastname' => $lname,
						'user_type' => $utype
					);
			
			$this->session->set_userdata($data);
			//redirect('Login/home');
			echo "success";
		}
    }
           
    public function verifyUser(){
		$username = $this->input->post("username");
		$password = md5($this->input->post("password"));
		
		//$this->load->model('membership_model');
		$query=$this->membership_model->validate($username, $password);
                
		if($query){
			return true;
		}else{
			$this->form_validation->set_message("verifyUser","Incorrect Username or Password. <br />Please try again.");
			return false;
		}
	}
}
