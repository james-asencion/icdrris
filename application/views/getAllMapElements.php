<?php  
$dom = new DOMDocument("1.0");
$mapElements = $dom->createElement("mapElements");
$mapElementsNode = $dom->appendChild($mapElements);
$polygons = $dom->createElement("polygons");
$polygonsNode = $mapElementsNode->appendChild($polygons);
$markers = $dom->createElement("markers");
$markersNode = $mapElementsNode->appendChild($markers); 
$responseOrganizations = $dom->createElement("responseOrganizations");
$responseOrgNode = $mapElementsNode->appendChild($responseOrganizations);

header("Content-type: text/xml"); 


foreach ($elements as $element){
if($element->lat == null && $element->lng == null){    

    $polygon = $dom->createElement("polygon");
    $polygon->setAttribute("incident_location_id",$element->incident_location_id);
    $polygon->setAttribute("incident_report_id",$element->incident_report_id);
    $polygon->setAttribute("incident_description",$element->incident_description);
    $polygon->setAttribute("location_address",$element->location_address);
    $polygon->setAttribute("incident_intensity",$element->incident_intensity);
    $polygon->setAttribute("incident_date",$element->incident_date);
    $polygon->setAttribute("disaster_type",$element->disaster_type);
    $polygon->setAttribute("death_toll",$element->death_toll);
    $polygon->setAttribute("no_of_injuries",$element->no_of_injuries);
    $polygon->setAttribute("no_of_people_missing",$element->no_of_people_missing);
    $polygon->setAttribute("no_of_families_affected",$element->no_of_families_affected);
    $polygon->setAttribute("no_of_houses_destroyed",$element->no_of_houses_destroyed);
    $polygon->setAttribute("estimated_damage_cost",$element->estimated_damage_cost);
    $polygon->setAttribute("incident_info_source",$element->incident_info_source);
    $polygon->setAttribute("elementType","2");
    $polygon->setAttribute("flag_confirmed",$element->flag_confirmed);
    $polygon->setAttribute("flag_true_rating",$element->flag_true_rating);
    $polygon->setAttribute("flag_false_rating",$element->flag_false_rating);
    $newPolygon = $polygons->appendChild($polygon);
    

  //Retrieve all the coordinates of a Marker and a Polygon corresponding to an incident
    $patterns = array();
    $patterns[0] = '/\s/';
    $patterns[1] = '/\)\)/';
    $patterns[2] = '/POLYGON\(\(/';
    $replacements = array();
    $replacements[2] = ',';
    $replacements[1] = '';
    $replacements[0] = '';
    $coordinates = preg_replace($patterns,$replacements,$element->reportPolygon);
    //echo $coordinates;
    //echo "<br>";

    $points = explode(",",$coordinates);
    for($i=0; $i < count($points);)
    {   
      $point = $dom->createElement("point");  
      $newPoint = $polygon->appendChild($point);
      $newPoint->setAttribute("lat",$points[$i++]);
      $newPoint->setAttribute("lng",$points[$i++]);
    }

  }else{
      
    $marker = $dom->createElement("marker");
    $marker->setAttribute("incident_location_id",$element->incident_location_id);
    $marker->setAttribute("incident_report_id",$element->incident_report_id);
    $marker->setAttribute("disaster_type",$element->disaster_type);
    $marker->setAttribute("incident_intensity",$element->incident_intensity);
    $marker->setAttribute("incident_description",$element->incident_description);
    $marker->setAttribute("location_address",$element->location_address);
    $marker->setAttribute("incident_date",$element->incident_date);
    $marker->setAttribute("death_toll",$element->death_toll);
    $marker->setAttribute("no_of_injuries",$element->no_of_injuries);
    $marker->setAttribute("no_of_people_missing",$element->no_of_people_missing);
    $marker->setAttribute("no_of_families_affected",$element->no_of_families_affected);
    $marker->setAttribute("no_of_houses_destroyed",$element->no_of_houses_destroyed);
    $marker->setAttribute("estimated_damage_cost",$element->estimated_damage_cost);
    $marker->setAttribute("incident_info_source",$element->incident_info_source);
    $marker->setAttribute("lat",$element->lat);
    $marker->setAttribute("lng",$element->lng);
    $marker->setAttribute("elementType","1");
    $marker->setAttribute("flag_confirmed",$element->flag_confirmed);
    $marker->setAttribute("flag_true_rating",$element->flag_true_rating);
    $marker->setAttribute("flag_false_rating",$element->flag_false_rating);

    $newMarker = $markers->appendChild($marker);
    
  }

}
foreach($respondents as $org){
    $responseOrganization = $dom->createElement("responseOrganization");
    $responseOrganization->setAttribute("response_organization_location_id",$org->response_organization_location_id);
    $responseOrganization->setAttribute("response_organization_name",$org->response_organization_name);
    $responseOrganization->setAttribute("activity_start_date",$org->activity_start_date);
    $responseOrganization->setAttribute("activity_end_date",$org->activity_end_date);
    $responseOrganization->setAttribute("activity_status",$org->activity_status);
    $responseOrganization->setAttribute("deployment_lat",$org->deployment_lat);
    $responseOrganization->setAttribute("deployment_lng",$org->deployment_lng);
    $responseOrganization->setAttribute("activity_description",$org->activity_description);
    $responseOrganization->setAttribute("location_address",$org->location_address);
    $responseOrganization->setAttribute("elementType", "3");

    $newRespondentOrg = $responseOrganizations->appendChild($responseOrganization);
        
}
/**
while ($row = $result->fetch_assoc()) {
    
  //Retrieve all details of an incident
  if($row['lat'] == null && $row['lng'] == null){    

    $polygon = $dom->createElement("polygon");
    $polygon->setAttribute("incident_report_id",$row['incident_report_id']);
    $polygon->setAttribute("incident_description",$row['incident_description']);
    $polygon->setAttribute("location_address",$row['location_address']);
    $polygon->setAttribute("incident_intensity",$row['incident_intensity']);
    $polygon->setAttribute("incident_date",$row['incident_date']);
    $polygon->setAttribute("disaster_type",$row['disaster_type']);
    $polygon->setAttribute("death_toll",$row['death_toll']);
    $polygon->setAttribute("no_of_injuries",$row['no_of_injuries']);
    $polygon->setAttribute("no_of_people_missing",$row['no_of_people_missing']);
    $polygon->setAttribute("no_of_families_affected",$row['no_of_families_affected']);
    $polygon->setAttribute("no_of_houses_destroyed",$row['no_of_houses_destroyed']);
    $polygon->setAttribute("estimated_damage_cost",$row['estimated_damage_cost']);
    $polygon->setAttribute("incident_info_source",$row['incident_info_source']);
    $polygon->setAttribute("flag_confirmed",$row['flag_confirmed']);
    $polygon->setAttribute("flag_true_rating",$row['flag_true_rating']);
    $polygon->setAttribute("flag_false_rating",$row['flag_false_rating']);
    $newPolygon = $polygons->appendChild($polygon);
    

  //Retrieve all the coordinates of a Marker and a Polygon corresponding to an incident
    $patterns = array();
    $patterns[0] = '/\s/';
    $patterns[1] = '/\)\)/';
    $patterns[2] = '/POLYGON\(\(/';
    $replacements = array();
    $replacements[2] = ',';
    $replacements[1] = '';
    $replacements[0] = '';
    $coordinates = preg_replace($patterns,$replacements,$row['reportPolygon']);
    //echo $coordinates;
    //echo "<br>";

    $points = explode(",",$coordinates);
    for($i=0; $i < count($points);)
    {   
      $point = $dom->createElement("point");  
      $newPoint = $polygon->appendChild($point);
      $newPoint->setAttribute("lat",$points[$i++]);
      $newPoint->setAttribute("lng",$points[$i++]);
    }

  }else{
      
    $marker = $dom->createElement("marker");
    $marker->setAttribute("incident_report_id",$row['incident_report_id']);
    $marker->setAttribute("disaster_type",$row['disaster_type']);
    $marker->setAttribute("incident_intensity",$row['incident_intensity']);
    $marker->setAttribute("incident_description",$row['incident_description']);
    $marker->setAttribute("location_address",$row['location_address']);
    $marker->setAttribute("incident_date",$row['incident_date']);
    $marker->setAttribute("death_toll",$row['death_toll']);
    $marker->setAttribute("no_of_injuries",$row['no_of_injuries']);
    $marker->setAttribute("no_of_people_missing",$row['no_of_people_missing']);
    $marker->setAttribute("no_of_families_affected",$row['no_of_families_affected']);
    $marker->setAttribute("no_of_houses_destroyed",$row['no_of_houses_destroyed']);
    $marker->setAttribute("estimated_damage_cost",$row['estimated_damage_cost']);
    $marker->setAttribute("incident_info_source",$row['incident_info_source']);
    $marker->setAttribute("lat",$row['lat']);
    $marker->setAttribute("lng",$row['lng']);
    $marker->setAttribute("flag_confirmed",$row['flag_confirmed']);
    $marker->setAttribute("flag_true_rating",$row['flag_true_rating']);
    $marker->setAttribute("flag_false_rating",$row['flag_false_rating']);

    $newMarker = $markers->appendChild($marker);
    
  }

}
*/
echo $dom->saveXML();