<?php

class Membership_model extends CI_Model
{
	function validate($username, $password)
	{
       //       $username=$this->input->post('username');
       //	$password=$this->input->post('password');

                $this->db->select('adminId', 'password', 'fname', 'lname');
		$this->db->from('users');
		$this->db->where('adminId', $username);
		$this->db->where('password', $password);
	
		$query = $this->db->get();

		if($query-> num_rows() == 1)
		{
			return true;
		}
	}
	function create_account($username, $password, $fname, $lname)
	{

		$data= array(
					'adminId' => $username, 
					'password' => $password,
					'fname' => $fname,
					'lname' => $lname);
		
		$query= $this->db->insert('users', $data);
                return true;
	}
}
?>