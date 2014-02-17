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
       
       if($query){ //victim in a specific incident is unique
            return $query; 
        }
       else{ //victim in the specific incident already exists
            return false;
       }
    }
	
	// GET VICTIM DETAILS | SELECT VICTIM
	function selectVictim($victim_id){
		/**$sql = '';
		$query= 
		
		if($query){
		   return $query; 
		}
		else{
			echo 'Problem with the query.';
		}
       */
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
       
       if($query->num_rows() <1){ //victim in a specific incident is unique
            return true; 
       }
       else{ //victim in the specific incident already exists
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
          //naa sa victim table
          //get victimNo and insert victim to incident_victim table
          foreach($isVictimUnique->result() as $row_victim){
          $id= $row_victim->victim_id;}
          
          $sql_insertIncidentVictim= 'INSERT INTO `icdrris`.`incident_victim` (`incident_report_id`, `victim_id`, `victim_status`, `flag_confirmed`, `report_rating_true`, `report_rating_false`) VALUES ("'.$reportNo.'", "'.$id.'", "'.$victim_status.'", 0, 0, 0)';
          $query_insertIncidentVictim= $this->db->query($sql_insertIncidentVictim);
          return true;
      }
      else{
          //wala sa victim table
          //insert victim to victim table then get the id to insert to incident_victim table with the reportNo
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
		// FOR VICTIMS TABLE
		/**$data_victims = array(
               'first_name' => $first_name,
               'middle_name' => $middle_name,
               'last_name' => $last_name,
               'address' => $address
            );
		$this->db->where('victim_id', $victim_id);
		$this->db->update('victims', $data_victims); 
		*/
		// FOR INCIDENT_VICTIM TABLE
		/**$data_iv = array(
               'victim_status' => $victim_status
            );
		$this->db->where('victim_id', $victim_id);
		$this->db->where('incident_report_id', $incident_report_id);
		$this->db->update('incident_victim', $data_iv); 
		*/
	}
    
    function deleteVictim($incident_report_id, $victim_id){
        $this->db->where('incident_report_id', $incident_report_id);
		$this->db->where('victim_id', $victim_id);
		$query= $this->db->delete('incident_victim');
        
        if($query){
           // echo 'success frm victimmodel';
            return true;
        }else{
            //echo 'db query error';
            echo $this->db->_error_message();
        }


    }
    
    /** NOTE!
     * ADDRESS issue...
     * 1. Address of the victim? or Location address of the victim?
     * 2. Changeable? or Not?
     * SOLUTION:
     * 1. If changeable && Location address, how about the past incident records? it will also change.
     *       Remedy: transfer address in incident_location
     * 2. If changeable && Address of the victim, not needed in REPORT VICTIM form
     *       Remedy: remove the Address field from the form.
     * 
     * NOTICE: $address var is not used if the victim already exists in victim table.
     */
    
}