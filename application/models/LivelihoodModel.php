<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

class LivelihoodModel extends CI_Model{
	
	function createLivelihoodOrg(){

		$data = array(
					'livelihood_organization_name' => $this->input->post('name'),
					'livelihood_organization_address' => $this->input->post('address'),
					'no_of_members' => $this->input->post('members'),
					'initial_income' => $this->input->post('initial_income'),
					'livelihood_organization_status' => $this->input->post('status'),
					'date_established' => $this->input->post('date_formed'),
					'business_activity_type' => $this->input->post('business_type'),
					'location_id' => 1
					);
		
		$query = $this->db->insert('livelihood_organizations',$data);
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
                    'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'last_name' => $data['last_name'],
                    'sex' => $data['sex'], 
                    'birthday' => $data['birthday'],
                    'age' => $data['age'],
                    'monthly_income' => $data['monthly_income'],
                    'source_of_income' => $data['source_of_income'],
                    'civil_status' => $data['civil_status'],
                    'no_of_children' => $data['no_of_children']
                    );


		
		$query1 = $this->db->insert('livelihood_organization_members',$val);
		
		//id to be used in the connecting table
		$member_id = $this->db->insert_id();
		$organization_id = $data['org_id'];

		$query2 = $this->db->query("INSERT INTO recipient_org_members(livelihood_organization_id, member_id) VALUES ('$organization_id', '$member_id')");
		
		$query3 = $this->db->query("SELECT s1.member_id, s2.first_name, s2.last_name, s2.middle_name, s2.sex, s2.birthday,s2.age, s2.monthly_income, s2.source_of_income, s2.civil_status, s2.no_of_children
									FROM    
									(SELECT member_id
									          FROM recipient_org_members 
									          WHERE livelihood_organization_id='$organization_id') s1

									LEFT JOIN 

									(SELECT *
									          FROM livelihood_organization_members) s2
									ON s1.member_id = s2.member_id");
        
		if($query1 && $query2){
			return $query3;
		}else{
			return $this->db->_error_message();
		}
		
	}

	function getAllLivelihoodOrgs(){
		$query = $this->db->get('livelihood_organizations');
		return $query->result();
	} 

	function getOrgByName($name){
		$query = $this->db->get_where('livelihood_org',array('livelihoodOrgName'=>$name));
		return $query;
	}
	function getLivelihoodOrg($id){
		$query = $this->db->get_where('livelihood_organizations', array('livelihood_organization_id'=>$id));
		return $query->result();
	}

	function getAllMembers($id){
		$query = $this->db->query("	SELECT m.member_id, m.first_name, m.last_name, m.middle_name, m.sex, m.birthday, m.age, m.monthly_income, m.source_of_income, m.civil_status, m.no_of_children 
									FROM livelihood_organization_members m 
									LEFT JOIN recipient_org_members r
									ON r.member_id = m.member_id 
									WHERE r.livelihood_organization_id = '$id';");
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
		$this->db->where("livelihood_organization_id",$id);
		$query = $this->db->delete("livelihood_organizations");

		return $query->result();

	}
	function updateMemberEditable($id, $name, $value){
		$data = array(
               $name => $value,
            );

		$this->db->where('member_id', $id);
		$query = $this->db->update('livelihood_organization_members', $data); 
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
}
?>