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
		$resOrgId = $this->db->insert_id();
		$userId = $this->session->userdata('user_id');
		$this->db->insert('user_response_organizations',array('response_organization_id'=>$resOrgId, 'user_id'=>$userId));
		$data['org_id'] = $resOrgId;

		if($query){
			return $resOrgId;
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
		$resOrgId = $this->db->insert_id();
		$userId = $this->session->userdata('user_id');
		$this->db->insert('user_response_organizations',array('response_organization_id'=>$resOrgId, 'user_id'=>$userId));
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
			'skillset_skillset_id' => $skillset_id,
			'member_id' => $member_id
			);

		$this->db->insert('members_skillset', $data);
	}
	function addNewMemberSkillset($skillset_description){
		$this->db->insert('response_org_members_skills', array('skillset_description'=>$skillset_description));
	}

	function getAllResOrgs(){
		$query = $this->db->get('response_organization');
		return $query->result();
	} 

	function getOrgByName($name){
		$query = $this->db->get_where('livelihood_org',array('livelihoodOrgName'=>$name));
		return $query;
	}
	function getResOrg($org_id){
		//$query = $this->db->get_where('response_organization', array('response_organization_id'=>$id));
		//return $query->row();
		$user_id = $this->session->userdata('user_id');
		$query = $this->db->query("	SELECT r.response_organization_id, r.response_organization_name, r.response_organization_phone_num, r.response_organization_address, r.response_organization_email, r.response_organization_contact_person, r.response_organization_members_count, r.response_organization_members_available
									FROM user_response_organizations u
									LEFT JOIN response_organization r 
									ON r.response_organization_id = u.response_organization_id
									WHERE u.response_organization_id = '$org_id' AND 
									u.user_id='$user_id'");
		return $query->row();
	}
	function getUserResponseOrganizations(){
		$user_id = $this->session->userdata('user_id');

		$query = $this->db->query("	SELECT r.response_organization_id, r.response_organization_name, r.response_organization_phone_num, r.response_organization_address, r.response_organization_email, r.response_organization_contact_person, r.response_organization_members_count, r.response_organization_members_available
									FROM user_response_organizations u
									LEFT JOIN response_organization r 
									ON r.response_organization_id = u.response_organization_id
									WHERE u.user_id='$user_id'");
		return $query->result();
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
	function updateMemberStatus($member_id,$string){
		$data = array(
               'member_status' => $string
            );

		$this->db->where('member_id', $member_id);
		$this->db->update('members', $data); 
	}

	function getAllSkillset(){
		$query = $this->db->query("SELECT * FROM response_org_members_skills;");
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
	function undeployMember($member_id, $response_organization_location_id){
		$this->db->delete('member_deployments', array('member_id' => $member_id, 'response_organization_location_id'=> $response_organization_location_id)); 
	}
	function undeployResponseOrg($response_organization_location_id){
		$this->db->delete('response_organization_locations', array('response_organization_location_id'=>$response_organization_location_id));
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
	function getDeployedOrganization($id){
		$query = $this->db->query("	SELECT o.response_organization_location_id, r.response_organization_id, r.response_organization_name,DATE_FORMAT( o.activity_start_date,'%W, %M %e, %Y') as activity_start_date,DATE_FORMAT( o.activity_end_date,'%W, %M %e, %Y') as activity_end_date, o.activity_status, o.activity_description, l.location_address
									FROM response_organization r
									INNER JOIN response_organization_locations o 
									ON r.response_organization_id = o.response_organization_id
									INNER JOIN locations l
									ON l.location_id = o.location_id
									WHERE o.response_organization_location_id='$id';");
		return $query->row();
	}
	function isOrganizationOwnedByUser($id, $user_id){
		$query = $this->db->query("	SELECT l.response_organization_id
									FROM response_organization_locations l
									WHERE l.response_organization_id = '$id'
									AND l.response_organization_id 
									IN (SELECT response_organization_id FROM user_response_organizations WHERE user_id='$user_id');");
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	function getAllDeployedMembers($id){
		$query = $this->db->query("	SELECT m.member_id, m.member_first_name, m.member_last_name, m.member_status
									FROM member_deployments d
									LEFT JOIN members m
									ON d.member_id = m.member_id
									WHERE d.response_organization_location_id='$id';");
		return $query;
	}
	function getMemberSkills($id){
		$query = $this->db->query("	SELECT s.skillset_description
									FROM members_skillset m
									LEFT JOIN response_org_members_skills s
									ON s.skillset_id = m.skillset_skillset_id
									WHERE m.member_id='$id';");
		return $query->result();
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