<?php  

//require("dbinfo.php");
// Start XML file, create parent node
class polyXML extends CI_Model{

function index(){
$dom = new DOMDocument("1.0");
$polygons = $dom->createElement("polygons");
$markersNode = $dom->appendChild($polygons); 


// Opens a connection to a MySQL server
//$mysqli = new mysqli("localhost",$username, $password, $database);
$mysqli = new mysqli("localhost","root", "", "icdrris");

if(mysqli_connect_error()){
  die('Not Connected : '.mysqli_connect_error());
}
// Select all the rows in the markers table

$query = "SELECT i.description, i.disasterType, i.dateHappened, i.deaths, i.injured, i.missing, i.affectedFamilies, i.homesDestroyed, i.damageCost, i.infoSource, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon
          FROM incident i
          LEFT OUTER JOIN incident_location l ON i.reportNo = l.reportNo
          UNION 
          SELECT i.description, i.disasterType, i.dateHappened, i.deaths, i.injured, i.missing, i.affectedFamilies, i.homesDestroyed, i.damageCost, i.infoSource, l.lat, l.lng, ASTEXT( l.polygon ) as reportPolygon
          FROM incident i
          RIGHT OUTER JOIN incident_location l ON i.reportNo = l.reportNo
          LIMIT 0 , 30";
$result = $this->db->query($query);
$totalRows= $result->num_rows();

if (!$result) {
  echo "An error occurred.\n";
  exit;
}
header("Content-type: text/xml"); 

while ($row = $result->fetch_assoc()) {
    
  //Retrieve all details of an incident
    $polygon = $dom->createElement("polygon");
    $polygon->setAttribute("disasterType",$row['disasterType']);
    $polygon->setAttribute("description",$row['description']);
    $polygon->setAttribute("date",$row['dateHappened']);
    $polygon->setAttribute("deaths",$row['deaths']);
    $polygon->setAttribute("injured",$row['injured']);
    $polygon->setAttribute("missing",$row['missing']);
    $polygon->setAttribute("affectedFamilies",$row['affectedFamilies']);
    $polygon->setAttribute("homesDestroyed",$row['homesDestroyed']);
    $polygon->setAttribute("damageCost",$row['damageCost']);
    $polygon->setAttribute("infoSource",$row['infoSource']);
    $polygon->setAttribute("markerLat",$row['lat']); 
    $polygon->setAttribute("markerLng",$row['lng']); 
    $newPolygon = $polygons->appendChild($polygon);
    

  //Retrieve all the coordinates of a Marker and a Polygon corresponding to an incident
    if($row['reportPolygon'] != null){
    $patterns = array();
    $patterns[0] = '/\s/';
    $patterns[1] = '/\)\)/';
    $patterns[2] = '/POLYGON\(\(/';
    $replacements = array();
    $replacements[2] = ',';
    $replacements[1] = '';
    $replacements[0] = '';
    $coordinates = preg_replace($patterns,$replacements,$row['reportPolygon']);
   // echo $coordinates;
    //echo "<br>";

    $points = explode(",",$coordinates);
    for($i=0; $i < count($points);)
    {   
      $point = $dom->createElement("point");  
      $newPoint = $polygon->appendChild($point);
      $newPoint->setAttribute("lat",$points[$i++]);
      $newPoint->setAttribute("lng",$points[$i++]);
    }
    }
}

echo $dom->saveXML();
echo $totalRows;


// Iterate through the rows, adding XML nodes for each
/**
while ($row = pg_fetch_assoc($result)){ 

  $polygon = $dom->createElement("polygon");
  $polygon->setAttribute("disasterType",$row['disasterType']);
  $polygon->setAttribute("desciption",$row['desciption']);
  $polygon->setAttribute("date",$row['dateHappened']);
  $polygon->setAttribute("deaths",$row['deaths']);
  $polygon->setAttribute("injured",$row['injured']);
  $polygon->setAttribute("missing",$row['missing']);
  $polygon->setAttribute("affectedFamilies",$row['affectedFamilies']);
  $polygon->setAttribute("homesDestroyed",$row['homesDestroyed']);
  $polygon->setAttribute("damageCost",$row['damageCost']);
  $polygon->setAttribute("infoSource",$row['infoSource']);  
  $newPolygon = $polygons->appendChild($polygon);

  $coordinates = explode(";",$row['poly_points']);
  foreach($coordinates as $pt)
  {
    list($lat, $lng) = explode(",", $pt);
    
    $point = $dom->createElement("point");  
    $newPoint = $polygon->appendChild($point);
    $newPoint->setAttribute("lat",$lat);
    $newPoint->setAttribute("lng",$lng);
  }
  

  

  //$newPoint->setAttribute("coordinates", $row['poly_points']);
  //list($lat, $lng) = explode(",", $coordinates);
  //$newPoint->setAttribute("lat", $lat);
  //$newPoint->setAttribute("lng", $lng);
  /**
  
  foreach($points as $coordinates)
  {
      $point = $dom->createElement("point");  
      $newPoint = $points->appendChild($point);

      list($lat, $lng) = explode(",", $coordinates);
      $newPoint->setAttribute("lat", $lat);
      $newPoint->setAttribute("lng", $lng);
    */
  //  $point = $dom->createElement("point",$row['points']);
  //  $newPoint = $polygon->appendChild($point);
  //  $newPoint->setAttribute("latitude", $points1[$i++]);
  //  $newPoint->setAttribute("longitude", $points1[$i]);
  //} 
  // ADD TO XML DOCUMENT NODE  
  //--------process 2: marker---------------
  //$marker = $dom->createElement("marker");  
  //$newMarker = $markers->appendChild($marker);
  //$parNode2 = $dom->appendChild($node);  
  //----------------------------------------
  
  
  //------------process 1:points----------------------
  //$pointsNode = $dom->createElement("Polypoints");
  //$parNodePoints = $parNode2->appendChild($pointsNode);
  //--------------------------------------------------
  /**
  $newMarker->setAttribute("name",$row['barangay']);
  $newMarker->setAttribute("address", $row['address']);
  $newMarker->setAttribute("type",$row['disaster_type']);
  $newMarker->setAttribute("disaster_description",$row['disaster_description']);
  $newMarker->setAttribute("casualties",$row['casualties']);
  $newMarker->setAttribute("families_affected",$row['families_affected']);
  $newMarker->setAttribute("estimated_cost",$row['estimated_cost']);
  
  
  
  //------------process 2:points ---------------------
   
  
  //$newPolygon->setAttribute("lat", $row['lat']);  
  //$newPolygon->setAttribute("lng", $row['lng']); 

  //$point = $dom->createElement("point");
  //$newPoint = $polygon->appendChild($point); 
  //$newMarker->setAttribute("lat", $row['lat']);
  //$newMarker->setAttribute("lng", $row['lng']);
  //$newPolygon->setAttribute("type", $row['type']);
  //---------------------------------------------------
  
  //$points = $dom->createElement("points");
  //$newPoints = $polygon->appendChild($points);
  
  
  //$point=$dom->createElement("point");
  //$newPoint=$polygon->appendChild($point);
  //$newPoint->setAttribute("lat", $row['lat']); 
  //$newPoint->setAttribute("lng", $row['lng']);
  
  
  
} 
*/
    }
}
?>