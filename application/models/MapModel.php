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

		$query = $this->db->query("	SELECT l.incident_location_id, i.incident_report_id, i.incident_description,b.location_address, l.incident_intensity, DATE_FORMAT(i.incident_date,'%W, %M %e, %Y') as incident_date, i.disaster_type, l.death_toll, l.no_of_injuries, l.no_of_people_missing, l.no_of_families_affected, l.no_of_houses_destroyed, l.estimated_damage_cost, l.incident_info_source, l.location_id, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon,l.flag_confirmed, l.flag_true_rating, l.flag_false_rating
							        FROM incidents i
							        INNER JOIN incident_location l 
							        ON i.incident_report_id = l.incident_report_id
							        INNER JOIN locations b
							        ON b.location_id = l.location_id WHERE(incident_date BETWEEN '$dateFrom' AND '$dateTo') ORDER BY i.incident_date desc ");

         return $query->result();
	}	
	function getAllDeployedResponseOrganizations($dateFrom, $dateTo){
		$query = $this->db->query("	SELECT o.response_organization_location_id, r.response_organization_name,DATE_FORMAT( o.activity_start_date,'%W, %M %e, %Y') as activity_start_date,DATE_FORMAT( o.activity_end_date,'%W, %M %e, %Y') as activity_end_date, o.activity_status,o.deployment_lat, o.deployment_lng, o.activity_description, l.location_address
									FROM response_organization r
									INNER JOIN response_organization_locations o 
									ON r.response_organization_id = o.response_organization_id
									INNER JOIN locations l
									ON l.location_id = o.location_id
									WHERE(activity_start_date BETWEEN '$dateFrom' AND '$dateTo')
									ORDER BY activity_start_date desc");
		return $query->result();
	}
	function getAllBarangays(){
		$query = $this->db->query("	SELECT location_id, location_address, location_type, ASTEXT(location_polygon) as barangayPolygon
									FROM locations");
		return $query->result();
	}
	
	function getAllRequests($dateFrom, $dateTo){
		$query = $this->db->query("SELECT request_id, location_id, tweet_id, request_date, DATE_FORMAT(request_date, '%W, %M %e, %Y') as formatted_request_date, request_status, request_comments, flag_request_granted, tweet_user_id, request_info_source, request_url, geo_lat, geo_lng, geo_place_name from item_requests WHERE(request_date BETWEEN '$dateFrom' AND '$dateTo') ORDER BY request_date desc");
		return $query->result();
	}
	
	function getAllMembersDeployed($id){
		$query = $this->db->get_where('member_deployments',array('response_organization_location_id'=>$id));
		return $query->result();
	}
	function getAllLivelihoodOrganizations(){
		$query = $this->db->get('livelihood_organizations');
		return $query->result();
	}
	function getAllEvacuationSites(){
		$query = $this->db->query("	SELECT e.evacuation_site_id, e.evacuation_site_name, e.site_maximum_capacity, e.current_evacues_count, e.evacuation_site_status, e.evacuation_site_lat, e.evacuation_site_lng, l.location_address
									FROM evacuation_sites e
									LEFT JOIN locations l
									ON l.location_id = e.location_id");
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