<?php

class MapModel extends CI_Model
{

	public function extractData()
	{



		// Select all the rows in the markers table
		$query = $this->db->get('barangays');
		return $query;

	}
	function getMapElements1($dateFrom, $dateTo){

		$query = $this->db->query("SELECT i.incident_report_id, i.incident_description,b.location_address, l.incident_intensity, DATE_FORMAT(i.incident_date,'%W, %M %e, %Y') as incident_date, i.disaster_type, i.death_toll, i.no_of_injuries, i.no_of_people_missing, i.no_of_families_affected, i.no_of_houses_destroyed, i.estimated_damage_cost, i.incident_info_source, l.location_id, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon,l.flag_confirmed, l.flag_true_rating, l.flag_false_rating
          FROM incidents i
          INNER JOIN incident_location l 
          ON i.incident_report_id = l.incident_report_id
          INNER JOIN locations b
          ON b.location_id = l.location_id WHERE(incident_date BETWEEN '$dateFrom' AND '$dateTo') ORDER BY i.incident_date desc ");

         return $query->result();
	}	
	function getMapElements2(){

		$query = $this->db->query("SELECT i.incident_report_id, i.incident_description,b.location_address, l.incident_intensity, DATE_FORMAT(i.incident_date,'%W, %M %e, %Y') as incident_date, i.disaster_type, i.death_toll, i.no_of_injuries, i.no_of_people_missing, i.no_of_families_affected, i.no_of_houses_destroyed, i.estimated_damage_cost, i.incident_info_source, l.location_id, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon,l.flag_confirmed, l.flag_true_rating, l.flag_false_rating
          FROM incidents i
          INNER JOIN incident_location l 
          ON i.incident_report_id = l.incident_report_id
          INNER JOIN locations b
          ON b.location_id = l.location_id ORDER BY i.incident_date desc ");

         return $query->result();
	}
	
}

?>