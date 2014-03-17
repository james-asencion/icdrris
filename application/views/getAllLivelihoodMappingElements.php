<?php  
$dom = new DOMDocument("1.0");
$mapElements = $dom->createElement("mapElements");
$mapElementsNode = $dom->appendChild($mapElements);
$polygons = $dom->createElement("polygons");
$polygonsNode = $mapElementsNode->appendChild($polygons);
$markers = $dom->createElement("markers");
$markersNode = $mapElementsNode->appendChild($markers); 
$livelihoodOrganizations = $dom->createElement("livelihoodOrganizations");
$livelihoodOrgNode = $mapElementsNode->appendChild($livelihoodOrganizations);
$barangays = $dom->createElement("barangays");
$barangayNode = $mapElementsNode->appendChild($barangays);

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
foreach($organizations as $org){
    $livelihoodOrganization = $dom->createElement("livelihoodOrganization");
    $livelihoodOrganization->setAttribute("livelihood_organization_id",$org->livelihood_organization_id);
    $livelihoodOrganization->setAttribute("livelihood_organization_name",$org->livelihood_organization_name);
    $livelihoodOrganization->setAttribute("livelihood_organization_address",$org->livelihood_organization_address);
    $livelihoodOrganization->setAttribute("no_of_members",$org->no_of_members);
    $livelihoodOrganization->setAttribute("initial_income",$org->initial_income);
    $livelihoodOrganization->setAttribute("livelihood_organization_status",$org->livelihood_organization_status);
    $livelihoodOrganization->setAttribute("date_established",$org->date_established);
    $livelihoodOrganization->setAttribute("business_activity_type",$org->business_activity_type);
    $livelihoodOrganization->setAttribute("lat",$org->livelihood_org_lat);
    $livelihoodOrganization->setAttribute("lng",$org->livelihood_org_lng);
    $livelihoodOrganization->setAttribute("elementType", "3");



    $newLivelihoodOrg = $livelihoodOrganizations->appendChild($livelihoodOrganization);
        
}
foreach($barangayListItem as $b){
    $barangay = $dom->createElement("barangay");
    $barangay->setAttribute("location_id",$b->location_id);
    $barangay->setAttribute("location_address",$b->location_address);
    $barangay->setAttribute("location_type",$b->location_type);
    $barangay->setAttribute("elementType",'6');

    $newLivelihoodOrg = $barangays->appendChild($barangay);

    //Retrieve all the coordinates of a Marker and a Polygon corresponding to an incident
    $patterns = array();
    $patterns[0] = '/\s/';
    $patterns[1] = '/\)\)/';
    $patterns[2] = '/POLYGON\(\(/';
    $replacements = array();
    $replacements[2] = ',';
    $replacements[1] = '';
    $replacements[0] = '';
    $coordinates = preg_replace($patterns,$replacements,$b->barangayPolygon);
    //echo $coordinates;
    //echo "<br>";

    $points = explode(",",$coordinates);
    for($i=0; $i < count($points);)
    {   
      $point = $dom->createElement("point");  
      $newPoint = $barangay->appendChild($point);
      $newPoint->setAttribute("lat",$points[$i++]);
      $newPoint->setAttribute("lng",$points[$i++]);
    }

        
}

echo $dom->saveXML();