<?php

class IncidentModel extends CI_Model
{
	
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
        
        
        function getIncidentDetails($id){
            $sql= 'SELECT i.incident_report_id, i.incident_description, i.disaster_type, i.incident_date, i.death_toll, i.no_of_injuries, i.no_of_people_missing, i.no_of_families_affected, i.no_of_houses_destroyed, i.estimated_damage_cost, i.incident_info_source, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon
                            FROM incidents i
                    LEFT OUTER JOIN incident_location l ON i.incident_report_id = l.incident_report_id
                    where i.incident_report_id= "'.$id.'"
                    ';
            
            $query= $this->db->query($sql);
            
			if($query){
				return $query;
			}
			else{
				return false;
			}
        }
}
?>