<?php

class Membership_model extends CI_Model
{
	function getUserDetails($user_name){
                
		$query = $this->db->query('SELECT u.user_id, u.user_name, u.user_first_name, u.user_last_name, u.user_type, u.user_email FROM users u WHERE u.user_name= "'.$user_name.'"');
                
                if($query){
                   return $query; 
                }
                else{
                    echo 'Problem with the query.';
                }
                
        }	
	
	function passwordMatches($user_id, $old_password){
		$this->db->select('user_name', 'password', 'user_first_name', 'user_last_name', 'user_type');
		$this->db->from('users');
		$this->db->where('user_id', $user_id);
		$this->db->where('password', $old_password);
		
		$query = $this->db->get();
		
                if($query-> num_rows() == 1){
                   return TRUE; 
                }
                else{
                    echo FALSE;
                }
	}
		
	function getUserDetailsByID($user_id){
                
		$query = $this->db->query('SELECT u.user_id, u.user_name, u.user_first_name, u.user_last_name, u.user_type, u.user_email FROM users u WHERE u.user_id= "'.$user_id.'"');
                
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
	//	$this->db->where('confirmed_user', 1);
	
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
	
	function changeAccountSettings($userid, $user_username,$user_firstname, $user_lastname, $user_email){
		$sql = "UPDATE users SET user_name = ?, user_first_name = ?, user_last_name= ?, user_email=? WHERE user_id = ?";
		$query= $this->db->query($sql, array($user_username, $user_firstname, $user_lastname, $user_email, $userid));
		if($query){
			return true;
		}
		else{ 
			return $query;
		}
	}
	
	function changeAccountSettingswPass($userid, $user_username,$user_firstname, $user_lastname, $user_email, $pass){
		$sql = "UPDATE users SET user_name = ?, user_first_name = ?, user_last_name= ?, user_email=?, password=? WHERE user_id = ?";
		$query= $this->db->query($sql, array($user_username, $user_firstname, $user_lastname, $user_email, $pass, $userid));
		if($query){
			return true;
		}
		else{ 
			return $query;
		}
	}
}
?>