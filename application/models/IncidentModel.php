<?php

class IncidentModel extends CI_Model
{
	function validate()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');

		$q=$this->db->query("SELECT * FROM user_profile WHERE user_name='$username' AND pass='$password'");
		$res=$q->result();

		if($q->num_rows()==1)
		{
			return true;
		}
	}
	function create_account()
	{
		$fName=$this->input->post('first_name');
		$lName=$this->input->post('last_name');
		$user_name=$this->input->post('user_name');
		$email=$this->input->post('email');
		$password=md5($this->input->post('password'));

		$q=$this->db->query("INSERT INTO user_profile (first_name,last_name,user_name,pass) VALUES('$fName','$lName','$user_name','$password')");
		return $q;
	}
}
?>