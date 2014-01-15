<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

class Victim extends CI_Model{
    
    function validate($fname, $mname, $lname, $reportNo){
       /** AVOID NAME DUPLICATION */
       $sql= 'SELECT v.victimNo,v.firstName, v.lastName,v.middleName,iv.reportNo FROM icdrris.victim v, icdrris.incident_victim iv WHERE iv.victimNo= v.victimNo and v.firstName= "'.$fname.'" and v.lastName = "'.$lname.'" and v.middleName = "'.$mname.'" and iv.reportNo = "'.$reportNo.'"';

       $query= $this->db->query($sql);
       if($query->num_rows() <1){ //victim in a specific incident is unique
            return true; 
        }
        else{ //victim in the specific incident already exists
            return false;
        }
    }
    
    function reportVictim($fname, $mname, $lname, $address, $victim_status, $reportNo){
     
      $sql_isVictimUnique= 'SELECT v.victimNo,v.firstName, v.lastName,v.middleName FROM icdrris.victim v WHERE v.firstName= "'.$fname.'" and v.lastName = "'.$lname.'" and v.middleName = "'.$mname.'"';
      $isVictimUnique= $this->db->query($sql_isVictimUnique);
     
      if($isVictimUnique->num_rows() >0){
          //naa sa victim table
          //get victimNo and insert victim to incident_victim table
          foreach($isVictimUnique->result() as $row_victim){
          $id= $row_victim->victimNo;}
          
          $sql_insertIncidentVictim= 'INSERT INTO `icdrris`.`incident_victim` (`reportNo`, `victimNo`, `status`, `confirmed`, `rateTrue`, `rateFalse`) VALUES ("'.$reportNo.'", "'.$id.'", "'.$victim_status.'", "unconfirmed", 0, 0)';
          $query_insertIncidentVictim= $this->db->query($sql_insertIncidentVictim);
          return true;
      }
      else{
          //wala sa victim table
          //insert victim to victim table then get the id to insert to incident_victim table with the reportNo
            $sql_insertVictim= 'INSERT INTO `icdrris`.`victim` (`victimNo`, `firstName`, `lastName`,`middleName`, `address`) VALUES (default,"'.$fname.'", "'.$lname.'",  "'.$mname.'", "'.$address.'")';
            $query_insertVictim= $this->db->query($sql_insertVictim);

            $id= $this->db->insert_id();

            $sql_insertIncidentVictim= 'INSERT INTO `icdrris`.`incident_victim` (`reportNo`, `victimNo`, `status`, `confirmed`, `rateTrue`, `rateFalse`) VALUES ("'.$reportNo.'", "'.$id.'", "'.$victim_status.'", "unconfirmed", 0, 0)';
            $query_insertIncidentVictim= $this->db->query($sql_insertIncidentVictim);
            return true;
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