<?php

class LivelihoodModel extends CI_Model{
	
	function createLivelihoodOrg($name, $address, $members, $initialIncome, $status, $dateFormed, $businessType, $locationId){

		$data = array(
					'livelihoodOrgName' => $name,
					'address' => $address,
					'members' => $members,
					'initIncome' => $initialIncome,
					'status' => $status,
					'dateFormed' => $dateFormed,
					'busiActType' => $businessType,
					'locationId' => $locationId
					);
		$query = $this->db->insert('livelihood_org',$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	function addMember($firstName, $middleName, $lastName, $sex, $birthday, $age, $monthlyIncome, $sourceOfIncome, $maritalStatus, $children){
		$data = array(
					'firstName' => $firstName,
					'middleName' => $middleName,
					'lastName' => $lastName,
					'sex' => $sex, 
					'birthday' => $birthday,
					'age' => $age,
					'monthlyIncome' => $monthlyIncome,
					'sourceOfIncome' => $sourceOfIncome,
					'maritalStatus' => $maritalStatus,
					'children' => $maritalStatus
					);
		$query = $this->db->insert('org_members',$data);
		$query2 = $this->db->query("SELECT memberId as maxID from org_members where memberId = LAST_INSERT_ID()");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	function getAllOrgs(){
		$query = $this->db->get('livelihood_org');
		return $query;
	} 

	function getOrgByName($name){
		$query = $this->db->get_where('livelihood_org',array('livelihoodOrgName'=>$name));
	}

	function getAllMembers($id){

	}
}
?>