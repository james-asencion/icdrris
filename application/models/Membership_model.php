<?php

class Membership_model extends CI_Model
{
        function getUserDetails($user_name){
                
		$query = $this->db->query('SELECT u.user_id, u.user_name, u.user_first_name, u.user_last_name, u.user_type FROM icdrris.users u WHERE u.user_name= "'.$user_name.'"');
                
                if($query){
                   return $query; 
                }
                else{
                    echo 'Problem with the query.';
                }
                
        }
	function validate($username, $password)
	{
       //       $username=$this->input->post('username');
       //	$password=$this->input->post('password');

		$this->db->select('user_name', 'password', 'user_first_name', 'user_last_name', 'user_type');
		$this->db->from('users');
		$this->db->where('user_name', $username);
		$this->db->where('password', $password);
	
		$query = $this->db->get();

		if($query-> num_rows() == 1)
		{
			return true;
		}
	}
	function create_account($username, $password, $fname, $lname, $utype, $user_email)
	{

		$data= array(
                            'user_name' => $username, 
                            'password' => $password,
                            'user_first_name' => $fname,
                            'user_last_name' => $lname,
                            'user_type' => $utype,
                            'user_email' => $user_email);
		
		$query= $this->db->insert('users', $data);
                if($query){
                    return true;
                }
                else{
                    return false;
                }
	}
}
?>