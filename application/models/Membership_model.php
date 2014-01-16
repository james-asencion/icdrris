<?php

class Membership_model extends CI_Model
{
        function getUserDetails($adminId){
                
		$query = $this->db->query('SELECT u.adminId, u.fname, u.lname, u.utype FROM icdrris.users u WHERE u.adminId= "'.$adminId.'"');
                
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

                $this->db->select('adminId', 'password', 'fname', 'lname', 'utype');
		$this->db->from('users');
		$this->db->where('adminId', $username);
		$this->db->where('password', $password);
	
		$query = $this->db->get();

		if($query-> num_rows() == 1)
		{
			return true;
		}
	}
	function create_account($username, $password, $fname, $lname, $utype)
	{

		$data= array(
                            'adminId' => $username, 
                            'password' => $password,
                            'fname' => $fname,
                            'lname' => $lname,
                            'utype' => $utype);
		
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