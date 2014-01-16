<?php

class Login extends CI_Controller{

	function index()
	{   //first initialization of login form
            $this->load->view('includes/template');
	}   
        
        public function home(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('polyHome');
		} else{
			redirect('Login');
		}
	}
        
	function validate_credentials()
	{   //validate login form data
                $this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("password", "Password", "required|callback_verifyUser");
		
               if($this->form_validation-> run() == false){
                        $data['err_login']='';
			$this->load->view('login', $data);
			//redirect('Main/login');
		}else{
                        $username = $this->input->post("username");
                        $this->load->model('membership_model');
                        $query=$this->membership_model->getUserDetails($username);
                        foreach($query->result() as $row_user){
                             $fname= $row_user->fname;
                             $lname= $row_user->lname;
                             $utype= $row_user->utype;
                        }
			$data= array(
                                    'username' => $username,
                                    'is_logged_in' => 1,
                                    'firstname' => $fname,
                                    'lastname' => $lname,
                                    'utype' => $utype
                                );
			$this->session->set_userdata($data);
			redirect('Login/home');
		}
           }
           
       public function verifyUser(){
                $username = $this->input->post("username");
		$password = md5($this->input->post("password"));
		
		 $this->load->model('membership_model');
		$query=$this->membership_model->validate($username, $password);
                
		if($query){
			return true;
		}else{
			$this->form_validation->set_message("verifyUser","Incorrect Username or Password. <br /> Please try again.");
			return false;
		}
	}
        
	function signup()
	{
		$this->load->view('signup');
	}
        
        function success(){ //for signup success.
            $data['succ_message']= 'Successfully added an account. Please come back after being verified.';
            $this->load->view('signup', $data); 
        }
        
        
	function create_account()
	{
		//$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name','First Name','trim|required');
		$this->form_validation->set_rules('last_name','Last Name','trim|required');
		$this->form_validation->set_rules("utype", "User Type", "required");
		$this->form_validation->set_rules('user_name','Username','trim|required|min_length[4]|is_unique[users.adminId]|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]');

                $username = $this->input->post("user_name");
		$password = md5($this->input->post("password"));
		$fname = $this->input->post("first_name");
		$lname = $this->input->post("last_name");
//		$email = $this->input->post("email");
		$utype = $this->input->post("utype");
                
		if(($this->form_validation->run()) == FALSE){   //validation errors occur
			//$this->signup();
                        //echo 'daghang mali doy.';
                        $data['err_message'] = '<br />Please try again.';
                        $this->load->view('signup',$data);
		}
		else{   //all data is valid: process data
                    
			$this->load->model('membership_model');   
                        $query=$this->membership_model->create_account($username, $password, $fname, $lname, $utype);
 
			if($query){ //successfully created an acct
                            // redirect('//Login', 'refresh');
                            //$data['succ_message']= 'New acct has been created.';
                            redirect('Login/success');
                        }
			else{
                            //$this->load->view('signup');
                            $data['err_message']= 'No acct is created. Problem with signup model query.';
                            $this->load->view('signup', $data);
                            
                        }
		}
                    
	}
        
        public function logout(){
			$this->session->sess_destroy();
			redirect('Login');
	}

}

?>