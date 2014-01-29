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


		$organization_id = $data['org_id'];
		$query1 = $this->db->insert('livelihood_organization_members',$val);
		$member_id = $this->db->insert_id();
		$query2 = $this->db->query("INSERT INTO recipient_org_org_members(livelihood_organization_id, member_id) VALUES ('$organization_id', '$member_id')");
		$query3 = $this->db->query("SELECT s1.member_id, s2.first_name, s2.last_name, s2.middle_name, s2.sex, s2.birthday,s2.age, s2.monthly_income, s2.source_of_income, s2.civil_status, s2.no_of_children
									FROM    
									(SELECT DISTINCT r.member_id
									          FROM recipient_org_org_members r
									          LEFT JOIN livelihood_organizations l ON r.livelihood_organization_id = r.livelihood_organization_id WHERE r.livelihood_organization_id='$organization_id') s1
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

	function getAllOrgs(){
		$query = $this->db->get('livelihood_org');
		return $query;
	} 

	function getOrgByName($name){
		$query = $this->db->get_where('livelihood_org',array('livelihoodOrgName'=>$name));
		return $query;
	}

	function getAllMembers($id){

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
}
?>