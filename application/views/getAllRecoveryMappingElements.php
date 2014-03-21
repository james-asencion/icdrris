<?php  
$dom = new DOMDocument("1.0");
$mapElements = $dom->createElement("mapElements");
$mapElementsNode = $dom->appendChild($mapElements);
$barangays = $dom->createElement("barangays");
$barangayNode = $mapElementsNode->appendChild($barangays);

header("Content-type: text/xml"); 

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