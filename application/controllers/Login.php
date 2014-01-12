<?php

class Login extends CI_Controller{

	function index()
	{
		$data['mainContent']='login_form';
		$this->load->view('includes/template',$data);
	}   

	function validate_credentials()
	{
                $this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("password", "Password", "required");
		
                $username = $this->input->post("username");
		$password = md5($this->input->post("password"));
                
                if($this->form_validation-> run() == true){
                    
                    $this->load->model('membership_model');
                    $query=$this->membership_model->validate($username, $password);

                    if($query)
                    {
                            $data = array(
                                    'username' => $username,
                                    'is_logged_in' => true);
                            $this->session->set_userdata($data);
                            redirect(base_url());
                    }
                    /**else
                    {

                          //  redirect('//Login', 'refresh');
                        redirect('//Login');
                    }*/
                    else{
                            $this->form_validation->set_message("verifyUser","Incorrect Username or Password. <br /> Please try again.");
                            redirect('Login'); // validation_errors won't work
                         // validation_errors() works
                         //   $this->load->view('polyHome');
                    }
                }
                else{
                    redirect('//Login'); // validation_errors won't work
                   // validation_errors() works
                   //   $this->load->view('polyHome');
                }        
        }
	function signup()
	{
		$data['mainContent']='signup';
		$this->load->view('signup');
	}
	function create_account()
	{
		//$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name','First Name','trim|required');
		$this->form_validation->set_rules('last_name','Last Name','trim|required');
		$this->form_validation->set_rules('user_name','Username','trim|required|min_length[4]|is_unique[users.adminId]|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]');

                $username = $this->input->post("user_name");
		$password = md5($this->input->post("password"));
		$fname = $this->input->post("first_name");
		$lname = $this->input->post("last_name");
//		$email = $this->input->post("email");
//		$utype = $this->input->post("utype");
                
		if(($this->form_validation->run()) == FALSE)
		{
			$this->signup();
		}
		else
		{
                    
			$this->load->model('membership_model');   
                        $query=$this->membership_model->create_account($username, $password, $fname, $lname);
 
			if($query)
			{
				 redirect('//Login', 'refresh');
			}
			else
			{
				$this->load->view('signup');
			}
		}
	}
        
        public function logout(){
			$this->session->sess_destroy();
			redirect('Login');
	}

}

?>