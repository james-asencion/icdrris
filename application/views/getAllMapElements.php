<?php  

require("dbinfo.php");
// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$mapElements = $dom->createElement("mapElements");
$mapElementsNode = $dom->appendChild($mapElements);
$polygons = $dom->createElement("polygons");
$polygonsNode = $mapElementsNode->appendChild($polygons);
$markers = $dom->createElement("markers");
$markersNode = $mapElementsNode->appendChild($markers); 


// Opens a connection to a MySQL server
$mysqli = new mysqli("localhost",$username, $password, $database);
if(mysqli_connect_error()){
  die('Not Connected : '.mysqli_connect_error());
}
// Select all the rows in the markers table

$query = "SELECT i.incident_report_id, i.incident_description,b.location_address, l.incident_intensity, DATE_FORMAT(i.incident_date,'%W, %M %e, %Y') as incident_date, i.disaster_type, i.death_toll, i.no_of_injuries, i.no_of_people_missing, i.no_of_families_affected, i.no_of_houses_destroyed, i.estimated_damage_cost, i.incident_info_source, l.location_id, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon,l.flag_confirmed, l.flag_true_rating, l.flag_false_rating
          FROM incidents i
          INNER JOIN incident_location l 
          ON i.incident_report_id = l.incident_report_id
          INNER JOIN locations b
          ON b.location_id = l.location_id ORDER BY i.incident_date desc";

$result = $mysqli->query($query);
if (!$result) {
  echo "An error occurred.\n";
  exit;
}

header("Content-type: text/xml"); 

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

echo $dom->saveXML();