<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

class Signup extends CI_Controller{

	public function __construct() {
		parent:: __construct();
		$this->load->model("membership_model");
	}
	function index()
	{   //initialize signup page
		$this->load->view('includes/header');
		$this->load->view('signup');
		$this->load->view('includes/footer');
	}   
	
	function success(){
		$data['succ_message']= 'New account has been created. ';
		$this->load->view('signup', $data);
		
	}
	
	function create_account()
	{
		//$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name','First Name','trim|required');
		$this->form_validation->set_rules('last_name','Last Name','trim|required');
		$this->form_validation->set_rules("utype", "User Type", "required");
		$this->form_validation->set_rules('user_name','Username','trim|required|min_length[4]|is_unique[users.user_name]|xss_clean');
		$this->form_validation->set_rules("email", "Email", "required");
                $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]');

		$username = $this->input->post("user_name");
		$password = md5($this->input->post("password"));
		$fname = $this->input->post("first_name");
		$lname = $this->input->post("last_name");
		$email = $this->input->post("email");
		$utype = $this->input->post("utype");
                
		if(($this->form_validation->run()) == FALSE){   //validation errors occur
			$data['err_message'] = 'Please try again.';
			$this->load->view('signup',$data);
		}
		else{   
			//all data is valid: process data    
			//$this->load->model('membership_model');   
			$query=$this->membership_model->create_account($username, $password, $fname, $lname, $utype, $email);
 
			if($query){ 
				//successfully created an acct
				// redirect('//Login', 'refresh');
				redirect('Signup/success');
			}
			else{
				//$this->load->view('signup');
				$data['err_message']= 'No acct is created. Problem with signup model query.';
				$this->load->view('signup', $data);    
			}
		}
                    
	}

}
