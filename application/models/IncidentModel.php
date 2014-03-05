<?php

class IncidentModel extends CI_Model
{
	 
        function confirmThisIncident($id, $userid){
			$sql = "UPDATE icdrris.incident_location SET flag_confirmed = 1, user_id = ? WHERE incident_location_id = ?";
			$query= $this->db->query($sql, array($userid, $id));
			//$query= $this->db->query($sql);
			if($query){
				return true;
			}
			else{
				return $query;
			}
		}
		
		
        function totalIncidents(){
            $query = "SELECT i.description, i.disasterType, i.dateHappened, i.deaths, i.injured, i.missing, i.affectedFamilies, i.homesDestroyed, i.damageCost, i.infoSource, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon
                        FROM incident i
                        LEFT OUTER JOIN incident_location l ON i.reportNo = l.reportNo
                        UNION 
                        SELECT i.description, i.disasterType, i.dateHappened, i.deaths, i.injured, i.missing, i.affectedFamilies, i.homesDestroyed, i.damageCost, i.infoSource, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon
                        FROM incident i
                        RIGHT OUTER JOIN incident_location l ON i.reportNo = l.reportNo
                        LIMIT 0 , 30";
            
            $results = $this->db->query($query);
            $totalIncidents= $results->num_rows();
            return $totalIncidents;
        }
        
          function getIncidentTitle($id){
            $sql= "SELECT i.incident_report_id, i.incident_description, i.disaster_type, DATE_FORMAT(i.incident_date,'%W, %M %e, %Y') as incident_date, l.death_toll, l.no_of_injuries, l.no_of_people_missing, l.no_of_families_affected, l.no_of_houses_destroyed, l.estimated_damage_cost, l.incident_info_source, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon
                    FROM incidents i
                    LEFT OUTER JOIN incident_location l 
                    ON i.incident_report_id = l.incident_report_id
                    WHERE l.incident_report_id= '$id';";
            
            $query= $this->db->query($sql);
            
			if($query){
				return $query;
			}
			else{
				return false;
			}
        }
		
        function getIncidentDetails($id){
            $sql= "SELECT i.incident_report_id, i.incident_description, i.disaster_type, DATE_FORMAT(i.incident_date,'%W, %M %e, %Y') as incident_date, l.flag_true_rating, l.flag_false_rating, l.death_toll, l.no_of_injuries, l.no_of_people_missing, l.no_of_families_affected, l.no_of_houses_destroyed, l.estimated_damage_cost, l.incident_info_source, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon
                    FROM incidents i
                    LEFT OUTER JOIN incident_location l 
                    ON i.incident_report_id = l.incident_report_id
                    WHERE l.incident_location_id= '$id';";
            
            $query= $this->db->query($sql);
            
			if($query){
				return $query;
			}
			else{
				return false;
			}
        }
        
        //Rate Victim
	function updateRate($incident_location_id, $upOrDown, $actionType){
            $sql= "";
            if($actionType == "on"){
                    if($upOrDown == "rateTrue"){
                            $sql = "update incident_location set flag_true_rating = flag_true_rating + 1 where incident_location_id= ?";
                    }
                    if($upOrDown == "rateFalse"){
                            $sql = "update incident_location set flag_false_rating = flag_false_rating + 1 where incident_location_id= ?";
                    }
            }
            if($actionType == "off"){
                    if($upOrDown =="rateTrue"){
                            $sql = "update incident_location set flag_true_rating = flag_true_rating - 1 where incident_location_id= ?";
                    }
                    if($upOrDown == "rateFalse"){
                            $sql = "update incident_location set flag_false_rating = flag_false_rating - 1 where incident_location_id= ?";
                    }
            }
            if($actionType == "onOff"){
                    if($upOrDown == "rateTrue"){
                            $sql = "update incident_location set flag_true_rating = flag_true_rating + 1,flag_false_rating = flag_false_rating -1 where incident_location_id= ?";
                    }
                    if($upOrDown == "rateFalse"){
                            $sql = "update incident_location set flag_false_rating = flag_false_rating + 1, flag_true_rating = flag_true_rating -1 where incident_location_id= ?";
                    }
            }
                    $this->db->query($sql, array($incident_location_id));
                    return $this->db->affected_rows();
	}
        
        
        function deleteIncident($id){
            $this->db->where('incident_report_id', $id);
            $query= $this->db->delete('incidents'); 
            
            if($query){
                return true;
            }
            else{
                return $query;
            }
        }
}
?>