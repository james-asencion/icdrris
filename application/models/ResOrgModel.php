<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

class ResOrgModel extends CI_Model{
	
	function createResOrg(){

		$data = array(
					'response_organization_name' => $this->input->post('ro_name'),
					'response_organization_phone_num' => $this->input->post('ro_phone_num'),
					'response_organization_email' => $this->input->post('ro_email'),
					'response_organization_address' => $this->input->post('ro_address'),
					'response_organization_contact_person' => $this->input->post('ro_contact_person'),
					'response_organization_members_count' => $this->input->post('ro_members_count'),
					'response_organization_members_available' => $this->input->post('ro_members_available')
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
	function createResOrgModal(){

		$data = array(
					'response_organization_name' => $this->input->post('ro_name'),
					'response_organization_phone_num' => $this->input->post('ro_phone_num'),
					'response_organization_email' => $this->input->post('ro_email'),
					'response_organization_address' => $this->input->post('ro_address'),
					'response_organization_contact_person' => $this->input->post('ro_contact_person'),
					'response_organization_members_count' => $this->input->post('ro_members_count'),
					'response_organization_members_available' => $this->input->post('ro_members_available')
					);
		
		$query = $this->db->insert('response_organization',$data);
	}
	
	function addMemberModal($data, $org_id){
	
		 $this->db->insert('members', $data);
		 $member_id = $this->db->insert_id();
		 $val2 = array(
					'response_organization_id' => $org_id, 
					'member_id' => $member_id
				);
		 $this->db->insert('response_organization_members', $val2);
		 return $member_id;

		 //return $this->getAllResOrgMembers($organization_id);
	}
	function addMember($data){

		    $val1 = array(
                 	'member_first_name' => $data['first_name'],
                    'member_last_name' => $data['last_name'],
                    'member_sex' => $data['sex'], 
                    'member_birthday' => $data['birthday'],
                    'member_civil_status' => $data['civil_status']
                   );


		
		$query1 = $this->db->insert('members',$val1);
		$member_id = $this->db->insert_id();
		$organization_id = $data['org_id'];

			$val2 = array(
					'response_organization_id' => $organization_id, 
					'member_id' => $member_id
					);
		$this->db->insert('members', $val2);


		return $this->getAllResOrgMembers($organization_id);
		
	}
	function deployResponseOrganization($data){
		$this->db->insert('response_organization_locations',$data);
		return $this->db->insert_id();
	}

	function addMemberSkills($member_id, $skillset_id) {
		$data = array(
			'skillset_id' => $skillset_id,
			'member_id' => $member_id
			);

		$this->db->insert('members_skillset', $data);
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
		return $query->row();
	}

	// function getAllMembers($id){
	// 	$query = $this->db->query("	SELECT m.member_id, m.first_name, m.last_name, m.middle_name, m.sex, m.birthday, m.age, m.monthly_income, m.source_of_income, m.civil_status, m.no_of_children 
	// 								FROM livelihood_organization_members m 
	// 								LEFT JOIN recipient_org_org_members r
	// 								ON r.member_id = m.member_id 
	// 								WHERE r.livelihood_organization_id = '$id';");
	// 	return $query->result();
	// }

	function getSkillsByMember($id){
		$query = $this->db->query("	SELECT m.skillset_description
									FROM members_skillset s
									LEFT JOIN response_org_members_skills m
									ON s.skillset_skillset_id=m.skillset_id
									WHERE s.member_id='$id';");
		return $query->result();
	}
	
	function getAllResOrgMembers($id){

		$query = $this->db->query("	SELECT m.member_id, m.member_first_name, m.member_last_name, m.member_birthday, m.member_sex, m.member_civil_status, m.member_status, r.response_organization_id
									FROM response_organization_members r
									LEFT JOIN members m 
									ON m.member_id=r.member_id
									WHERE r.response_organization_id='$id';");
		return $query->result();
	}

	function getAllDeployableResOrgMembers($id){

		$query = $this->db->query("	SELECT m.member_id, m.member_first_name,m.member_status, m.member_last_name, m.member_birthday, m.member_sex, m.member_civil_status, m.member_status, r.response_organization_id
									FROM response_organization_members r
									LEFT JOIN members m 
									ON m.member_id=r.member_id
									WHERE r.response_organization_id='$id' AND m.member_status='available';");
		return $query->result();
	}
	function updateMemberStatus($member_id){
		$data = array(
               'member_status' => 'deployed'
            );

		$this->db->where('member_id', $member_id);
		$this->db->update('members', $data); 
	}
	function getAllSkills(){
		$query = $this->db->get('response_org_members_skills');
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
	function deployResponseOrgMember($values){
		$this->db->insert('member_deployments',$values);
	}
	function deleteOrganization($id){
		$this->db->where("response_organization_id",$id);
		$query = $this->db->delete("response_organization");

		return $query->result();

	}

	function deleteResOrgMember($id){
		$this->db->where("response_organization_member_id", $id);
		$query = $this->db->delete("response_organization_members");
	//	return $query->result();
	}

	function updateResOrgEditable($id, $name, $value) {
		$data = array(
               $name => $value,
            );

		$this->db->where('response_organization_id', $id);
		$query = $this->db->update('response_organization', $data); 
		if($query){
			return true;
		}
		else{
			return false;
		}
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