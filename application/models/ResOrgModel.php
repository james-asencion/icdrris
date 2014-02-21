<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

class ResOrgModel extends CI_Model{
	
	function createResOrg(){

		$data = array(
					'response_organization_name' => $this->input->post('name'),
					'response_organization_phone_num' => $this->input->post('phone_num'),
					'response_organization_email' => $this->input->post('email'),
					'response_organization_address' => $this->input->post('address'),
					'response_organization_contact_person' => $this->input->post('contact_person'),
					'response_organization_members_count' => $this->input->post('members_count'),
					'response_organization_members_available' => $this->input->post('members_available')
					);
		
		$query = $this->db->insert('response_organization',$data);
		$orgId = $this->db->insert_id();
		$data['org_id'] = $orgId;

		if($query){
			return $data;
		}else{
			return $this->db->_error_message();
		}
	}
	
	function addMember($data){

		        $val = array(
		        	'response_organization_id' => $data['org_id'],
                    'response_organization_member_first_name' => $data['first_name'],
                    'response_organization_members_last_name' => $data['last_name'],
                    'response_organization_members_sex' => $data['sex'], 
                    'response_organization_members_birthday' => $data['birthday'],
                    'response_organization_members_civil_status' => $data['civil_status']
                    );


		
		$query1 = $this->db->insert('response_organization_members',$val);
		
		//id to be used in the connecting table
		$member_id = $this->db->insert_id();

		$organization_id = $data['org_id'];
//		$query2 = $this->getAllResOrgMembers('org_id');

		$this->db->where("response_organization_id", $organization_id);
		$query = $this->db->get("response_organization_members");


//		return $query;

//		$query2 = $this->db->query("INSERT INTO recipient_org_org_members(livelihood_organization_id, member_id) VALUES ('$organization_id', '$member_id')");
		
//		$query3 = $this->db->query("SELECT s1.member_id, s2.first_name, s2.last_name, s2.middle_name, s2.sex, s2.birthday,s2.age, s2.monthly_income, s2.source_of_income, s2.civil_status, s2.no_of_children
//									FROM    
//									(SELECT member_id
//									          FROM recipient_org_org_members 
//									          WHERE livelihood_organization_id='$organization_id') s1

//									LEFT JOIN 

//									(SELECT *
//									          FROM livelihood_organization_members) s2
//									ON s1.member_id = s2.member_id");
        
//		if($query1 && $query2){
//			return $query3;
//		}else{
//			return $this->db->_error_message();
//		}

		if($query) {
			return $query;
		}
		else {
			return $this->db->_error_message();
		}
		
	}

	function getAllResOrgs(){
		$query = $this->db->get('response_organization');
		return $query->result();
	} 

	function getOrgByName($name){
		$query = $this->db->get_where('livelihood_org',array('livelihoodOrgName'=>$name));
		return $query;
	}
	function getResOrg($id){
		$query = $this->db->get_where('response_organization', array('response_organization_id'=>$id));
		return $query->result();
	}

	function getAllMembers($id){
		$query = $this->db->query("	SELECT m.member_id, m.first_name, m.last_name, m.middle_name, m.sex, m.birthday, m.age, m.monthly_income, m.source_of_income, m.civil_status, m.no_of_children 
									FROM livelihood_organization_members m 
									LEFT JOIN recipient_org_org_members r
									ON r.member_id = m.member_id 
									WHERE r.livelihood_organization_id = '$id';");
		return $query->result();
	}

	function getAllResOrgMembers($id){
		$query = $this->db->get('response_organization_members');
		return $query->result();
	}

	function updateMember(){
		$data = array(
				''
			);
	}

	function checkOrgExist($orgName){

		$this->db->where("livelihood_organization_name",$orgName);
		$query = $this->db->get("livelihood_organizations");
		if($query->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function deleteOrganization($id){
		$this->db->where("response_organization_id",$id);
		$query = $this->db->delete("response_organization");

		return $query->result();

	}

	function updateMemberEditable($id, $name, $value){
		$data = array(
               $name => $value,
            );

		$this->db->where('response_organization_member_id', $id);
		$query = $this->db->update('response_organization_members', $data); 
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
}
?>