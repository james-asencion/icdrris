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

	function createLivelihoodProgram($data){
		$val = array(
                    'livelihood_type' => $data['livelihood_type'],
                    'livelihood_description' => $data['livelihood_description'],
                    'livelihood_program_cost' => $data['livelihood_program_cost'],
                    'target_recipients' => $data['target_recipients'],
                    'livelihood_program_status' => $data['liveliood_program_status'], 
                );
		$query = $this->db->insert('livelihood_programs',$val);
		$data['id'] = $this->db->insert_id();
		if($query){
			return $data;
		}else{
			return false;
		}
	}
	function getAllLivelihoodOrgs(){
		$query = $this->db->get('livelihood_organizations');
		return $query->result();
	} 
	function getAllLivelihoodOrgsNotRequested($programId){
		$query = $this->db->query("	SELECT *
									FROM livelihood_organizations
									WHERE livelihood_organization_id 
									NOT IN 
									(SELECT livelihood_organization_id FROM livelihood_organization_program_requests WHERE livelihood_program_id='$programId');");
		return $query->result();
	}
	function getAllRecipients($id){
		$query = $this->db->query("	SELECT l.livelihood_organization_id, l.livelihood_organization_name, l.livelihood_organization_status, l.business_activity_type, r.date_granted
									FROM livelihood_organization_program_requests r
									LEFT JOIN livelihood_organizations l
									ON l.livelihood_organization_id = r.livelihood_organization_id
									WHERE r.livelihood_program_id='$id'
									UNION
									SELECT l.livelihood_organization_id,l.livelihood_organization_name, l.livelihood_organization_status, l.business_activity_type, g.date_granted
									FROM livelihood_organization_program_grants g
									LEFT JOIN livelihood_organizations l
									ON l.livelihood_organization_id = g.livelihood_organization_id
									WHERE g.livelihood_program_id='$id';");
		return $query->result();
	}

//---------------------------------LIVELIHOOD PROGRAM------------------------------------------------------------------------------
	function getAllLivelihoodPrograms(){
		$query = $this->db->get('livelihood_programs');
		return $query->result();
	}

	function getAllAvailableLivelihoodPrograms(){
		$this->db->where('livelihood_program_status', 'available');
		$query = $this->db->get('livelihood_programs');
		return $query->result();
	}
	function getLivelihoodProgram($id){
		$this->db->where('livelihood_program_id', $id);
		$query = $this->db->get('livelihood_programs');
		return $query->row();
	}
	function addLivelihoodProgramResource($dataArray){
		
		$this->db->insert('livelihood_program_resource', $dataArray);
		$resultId = $this->db->insert_id();
		
		return $resultId; 
	}
	function getAllLivelihoodResources(){
		$query = $this->db->get('livelihood_resources');
		return $query->result();
	}
	function getLivelihoodProgramResources($id){
		$query = $this->db->query("	SELECT l.livelihood_resource_description, l.livelihood_resource_id, r.quantity_available, r.livelihood_program_resource_id
									FROM livelihood_program_resource r
									LEFT JOIN livelihood_resources l 
									ON l.livelihood_resource_id=r.livelihood_resource_id
									WHERE livelihood_program_id='$id';");
		return $query->result();
	}
	function getDeployableLivelihoodProgramResources($id){
		$query = $this->db->query("	SELECT l.livelihood_resource_description, l.livelihood_resource_id, r.quantity_available, r.livelihood_program_resource_id
									FROM livelihood_program_resource r
									LEFT JOIN livelihood_resources l 
									ON l.livelihood_resource_id=r.livelihood_resource_id
									WHERE livelihood_program_id='$id' AND quantity_available>0;");
		return $query->result();

	}
	function deployToLivelihoodOrg($grant_id,$resource_id,$quantity,$program_resource_id){
		$values = 	array(
						'livelihood_organization_program_grant_id' => $grant_id,
						'livelihood_resource_id' => $resource_id,
						'quantity' => $quantity
					);

		$this->db->insert('program_grants_resources',$values);
		$this->updateLivelihoodResourceCount($quantity,$program_resource_id);
		//return $this->db->insert_id();
	}
	function approveLivelihoodOrgRequest($request_id,$resource_id,$quantity,$program_resource_id){
		$values = 	array(
						'livelihood_organization_program_request_id' => $request_id,
						'livelihood_resource_id' => $resource_id,
						'quantity' => $quantity
					);

		$this->db->insert('program_requests_resources',$values);
		$this->updateLivelihoodResourceCount($quantity,$program_resource_id);
		//return $this->db->insert_id();
	}
	function updateLivelihoodResourceCount($quantity,$program_resource_id){
		$this->db->set('quantity_available', 'quantity_available-'.$quantity, FALSE);
	    $this->db->where('livelihood_program_resource_id',$program_resource_id);
	    $this->db->update('livelihood_program_resource'); 
	}
	function getExternalOrganizations($id){
		$query = $this->db->query("	SELECT  e.agency_name, e.agency_address, e.contact_number 
									FROM external_organizations e 
									LEFT JOIN external_org_livelihood_program l
									ON e.external_organization_id = l.external_organization_id 
									WHERE l.livelihood_program_id = '$id';");
		return $query->result();

	}
	function sendLivelihoodRequest($values){
		$this->db->insert('livelihood_organization_program_requests',$values);
		return $this->db->insert_id();
	}
	function getLivelihoodRequests($id){
		$query = $this->db->query(" SELECT l.livelihood_organization_id, l.livelihood_organization_name, l.livelihood_organization_address, l.no_of_members, l.livelihood_organization_status, l.business_activity_type, r.request_status, r.request_description, r.date_requested
									FROM livelihood_organization_program_requests r
									LEFT JOIN livelihood_organizations l
									ON l.livelihood_organization_id = r.livelihood_organization_id
									WHERE r.livelihood_program_id = '$id';");
		return $query->result();
	}
	function grantLivelihoodProgram($livelihood_program_id, $livelihood_organization_id){
		$this->load->helper('date');
		$values = array(
                    'livelihood_organization_id' => $livelihood_organization_id,
                    'livelihood_program_id' => $livelihood_program_id, 
                    'date_granted' => date('Y-m-d H:i:s',now())
                );
		$query = $this->db->insert('livelihood_organization_program_grants',$values);
		return $this->db->insert_id();
	}
	function approveLivelihoodOrgProgramRequest($programRequestId){
		$this->load->helper('date');
		$values = array(
					'request_status'=>'approved',
					'date_granted'=>now());
		$query = $this->db->where('livelihood_organization_program_request_id', $programRequestId);
		return $query->result();
	}
	function getAllPendingRequests($programId){
		$query = $this->db->query(" SELECT l.livelihood_organization_id, l.livelihood_organization_name, l.livelihood_organization_address, l.no_of_members, l.livelihood_organization_status, l.business_activity_type, r.livelihood_organization_program_request_id, r.request_status, r.request_description, r.date_requested
									FROM livelihood_organizations l
									LEFT JOIN livelihood_organization_program_requests r
									ON l.livelihood_organization_id = r.livelihood_organization_id
									WHERE r.livelihood_program_id = '$programId' AND r.request_status = 'pending';");
		return $query->result();
	}
	function getAllApprovedRequests($programId){
		$query = $this->db->query(" SELECT l.livelihood_organization_id, l.livelihood_organization_name, l.livelihood_organization_address, l.no_of_members, l.livelihood_organization_status, l.business_activity_type, r.livelihood_organization_program_request_id, r.request_status, r.request_description, r.date_requested, r.date_granted
									FROM livelihood_organizations l
									LEFT JOIN livelihood_organization_program_requests r
									ON l.livelihood_organization_id = r.livelihood_organization_id
									WHERE r.livelihood_program_id = '$programId' AND r.request_status = 'approved';");
		return $query->result();
	}
	

//-------------------------------------------------------------------------------------------------------------------------------

//------------------------------EXTERNAL ORGANIZATIONS---------------------------------------------------------------------------
	function createExternalOrganization($data){
		$query = $this->db->insert('external_organizations', $data);
		if($query){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	function getAllExternalOrganizations(){
		$query = $this->db->get('external_organizations');
		return $query->result();
	}
	function tagExternalOrganization($livelihood_program_id, $external_organization_id){
		$this->db->insert('external_org_livelihood_program', array('livelihood_program_id'=>$livelihood_program_id, 'external_organization_id'=>$external_organization_id));
		return $this->db->insert_id();
	}
	function getTaggedExternalOrganizations($livelihood_program_id){
		$query = $this->db->query("	SELECT e.agency_name, e.agency_address, e.contact_number 
										FROM external_organizations e
										LEFT JOIN external_org_livelihood_program p
										ON e.external_organization_id = p.external_organization_id
										WHERE p.livelihood_program_id = '$livelihood_program_id';");
		
		return $query->result();

	}
//-------------------------------------------------------------------------------------------------------------------------------
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