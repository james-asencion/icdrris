<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

class VictimModel extends CI_Model{
    
    function viewAllVictims($incident_report_id){
       $sql= 'select iv.incident_report_id, v.victim_id, v.first_name, v.middle_name, v.last_name, v.address, iv.victim_status, iv.flag_confirmed, iv.report_rating_false, iv.report_rating_true from incident_victim iv right outer join victims v on v.victim_id = iv.victim_id where iv.incident_report_id="'.$incident_report_id.'" ORDER BY v.first_name ASC';
       $query= $this->db->query($sql);
       
       if($query){ 
            return $query; 
        }
       else{ 
            return false;
       }
    }
	
	
	// CHECK IF VICTIM NAME CHANGED
	function isVictimNameChanged($victim_id, $first_name, $middle_name, $last_name){
		$this->db->select('victim_id, first_name, middle_name, last_name');
		$this->db->from('victims');
		$this->db->where('victim_id', $victim_id);
		$this->db->where('first_name', $first_name);
		$this->db->where('middle_name', $middle_name);
		$this->db->where('last_name', $last_name);
		$query = $this->db->get();
		
		if($query->num_rows() == 0){
			return true;
		}else{
			return false;
		}
	}
    
    
    function validate($fname, $mname, $lname, $reportNo){
       /** AVOID NAME DUPLICATION */
       $sql= 'SELECT v.victim_id,v.first_name, v.last_name,v.middle_name, iv.incident_report_id FROM icdrris.incident_victim iv LEFT OUTER JOIN icdrris.victims v  on v.victim_id = iv.victim_id WHERE iv.incident_report_id = "'.$reportNo.'" and v.last_name = "'.$lname.'" and v.middle_name = "'.$mname.'" and v.first_name= "'.$fname.'"';
       $query= $this->db->query($sql);
       
       if($query->num_rows() <1){ 
            return true; 
       }
       else{ 
            return false;
       }
    }
	
	function validateOnUpdate($first_name, $middle_name, $last_name, $incident_report_id, $victim_id){
		//check if victim name changed: call isVictimNameChanged($victim_id, $first_name, $middle_name, $last_name)
		$ischanged_result = $this->isVictimNameChanged($victim_id, $first_name, $middle_name, $last_name);
		if($ischanged_result){	
			// if changed, check if there are duplicate victims in new name in a spec. incident.
			$hasNoDuplicates = $this->validate($first_name, $middle_name, $last_name, $incident_report_id);		//call a function to check.
					
			// use ifs for returns from the result	
			if($hasNoDuplicates){		
				//valid if there are no duplicate victims in a new name in a spec. incident.
				return true;
			}
			else{
				// invalid if there are duplicate victims in new name in a spec. incident.
				return false;
			}
			
		}
		else{	
			// if not changed, still valid to update
			return true;
			
		}
	}
    
    function reportVictim($fname, $mname, $lname, $address, $victim_status, $reportNo){
     
      $sql_isVictimUnique= 'SELECT v.victim_id,v.first_name, v.last_name,v.middle_name FROM icdrris.victims v WHERE v.first_name= "'.$fname.'" and v.last_name = "'.$lname.'" and v.middle_name = "'.$mname.'"';
      $isVictimUnique= $this->db->query($sql_isVictimUnique);
     
      if($isVictimUnique->num_rows() >0){
          
          foreach($isVictimUnique->result() as $row_victim){
          $id= $row_victim->victim_id;}
          
          $sql_insertIncidentVictim= 'INSERT INTO `icdrris`.`incident_victim` (`incident_report_id`, `victim_id`, `victim_status`, `flag_confirmed`, `report_rating_true`, `report_rating_false`) VALUES ("'.$reportNo.'", "'.$id.'", "'.$victim_status.'", 0, 0, 0)';
          $query_insertIncidentVictim= $this->db->query($sql_insertIncidentVictim);
          return true;
      }
      else{
        
            $sql_insertVictim= 'INSERT INTO `icdrris`.`victims` (`victim_id`, `first_name`, `last_name`,`middle_name`, `address`) VALUES (default,"'.$fname.'", "'.$lname.'",  "'.$mname.'", "'.$address.'")';
            $query_insertVictim= $this->db->query($sql_insertVictim);

            $id= $this->db->insert_id();

            $sql_insertIncidentVictim= 'INSERT INTO `icdrris`.`incident_victim` (`incident_report_id`, `victim_id`, `victim_status`, `flag_confirmed`, `report_rating_true`, `report_rating_false`) VALUES ("'.$reportNo.'", "'.$id.'", "'.$victim_status.'", 0, 0, 0)';
            $query_insertIncidentVictim= $this->db->query($sql_insertIncidentVictim);
            return true;
      }
    }
	
	function updateVictim($incident_report_id, $victim_id, $first_name, $middle_name, $last_name, $address, $victim_status){
		$sql_update_vTable = 'UPDATE icdrris.victims SET first_name = "'.$first_name.'", last_name = "'.$last_name.'", middle_name = "'.$middle_name.'", address = "'.$address.'" WHERE victim_id = '.$victim_id.'';
		$sql_update_ivTable = 'UPDATE icdrris.incident_victim SET victim_status = "'.$victim_status.'" WHERE incident_report_id = '.$incident_report_id.' and victim_id = '.$victim_id.'';
		
		$this->db->trans_strict(TRUE);
		$this->db->trans_start();
		$query_vTable= $this->db->query($sql_update_vTable);
		$query_ivTable= $this->db->query($sql_update_ivTable);
		$this->db->trans_complete();
		
		if($this->db->trans_status()){
			return true;
		}else{
			return log_message();
		}
		
	}
    
    function deleteVictim($incident_report_id, $victim_id){
        $this->db->where('incident_report_id', $incident_report_id);
		$this->db->where('victim_id', $victim_id);
		$query= $this->db->delete('incident_victim');
        
        if($query){
          
            return true;
        }else{
           
            echo $this->db->_error_message();
        }


    }
	
	function confirmThisVictim($incident_report_id, $victim_id, $userid){
		$sql = "UPDATE icdrris.incident_victim SET flag_confirmed = 1, user_id = ? WHERE incident_report_id = ? and victim_id= ?";
		$query= $this->db->query($sql, array($userid, $incident_report_id, $victim_id));
		if($query){
			return true;
		}
		else{ 
			return $query;
		}
	}
		
	//Rate Victim
	function updateRate($incident_report_id, $victim_id, $upOrDown, $actionType){
		$sql= "";
	if($actionType == "on"){
		if($upOrDown == "rateTrue"){
			$sql = "update incident_victim set report_rating_true = report_rating_true + 1 where incident_report_id= ? and victim_id = ?";
		}
		if($upOrDown == "rateFalse"){
			$sql = "update incident_victim set report_rating_false = report_rating_false + 1 where incident_report_id= ? and victim_id = ?";
		}
	}
	if($actionType == "off"){
		if($upOrDown =="rateTrue"){
			$sql = "update incident_victim set report_rating_true = report_rating_true - 1 where incident_report_id= ? and victim_id = ?";
		}
		if($upOrDown == "rateFalse"){
			$sql = "update incident_victim set report_rating_false = report_rating_false - 1 where incident_report_id= ? and victim_id = ?";
		}
	}
	if($actionType == "onOff"){
		if($upOrDown == "rateTrue"){
			$sql = "update incident_victim set report_rating_true = report_rating_true + 1,report_rating_false = report_rating_false -1 where incident_report_id= ? and victim_id = ?";
		}
		if($upOrDown == "rateFalse"){
			$sql = "update incident_victim set report_rating_false = report_rating_false + 1, report_rating_true = report_rating_true -1 where incident_report_id= ? and victim_id = ?";
		}
	}
		$this->db->query($sql, array($incident_report_id, $victim_id));
		return $this->db->affected_rows();
	}
}	
	