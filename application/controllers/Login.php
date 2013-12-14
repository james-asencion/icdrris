<?php

class Login extends CI_Controller{

	function index()
	{
		$data['mainContent']='login_form';
		$this->load->view('includes/template',$data);
	} 

	function validate_credentials()
	{
		$this->load->model('membership_model');
		$query=$this->membership_model->validate();

		if($query)
		{
			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => true);
			$this->session->set_userdata($data);
			redirect('Site/home');
		}
		else
		{
			redirect('//Login', 'refresh');
		}
	}
	function signup()
	{
		$data['mainContent']='signup';
		$this->load->view('signup');
	}
	function create_account()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name','Name','trim|required');
		$this->form_validation->set_rules('last_name','Last Name','trim|required');
		$this->form_validation->set_rules('user_name','Username','trim|required|min_length[4]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2','Password2','trim|required|matches[password]');

		if(($this->form_validation->run()) == FALSE)
		{
			$this->signup();
		}
		else
		{
			$this->load->model('membership_model');
			if($query=$this->membership_model->create_account())
			{
				$data['mainContent']='welcome';
				$this->load->view('includes/template',$data);
			}
			else
			{
				$this->load->view('signup');
			}
		}
	}

}

?>