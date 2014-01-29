<?php

require("dbinfo.php");

$description = $_GET['description'];
$disasterType = $_GET['disasterType'];
$date = $_GET['date'];
$deaths = $_GET['deaths'];
$injured = $_GET['injured'];
$missing = $_GET['missing'];
$familiesAffected = $_GET['familiesAffected'];
$housesDestroyed = $_GET['housesDestroyed'];
$damageCost = $_GET['damageCost'];
$source = $_GET['source'];
$polygon = $_GET['polygon'];

$mysqli = new mysqli("localhost",$username,$password, $database);
if(mysqli_connect_errno()){
    die('Not connected : '.mysqli_connect_error());
}

//$db_selected = mysql_select_db($database, $connection);
//if(!$db_selected){
//    die('Can\'t use db : '.mysql_error());
//}

$query1 = sprintf("INSERT INTO incidents ".
                " (incident_description, disaster_type, incident_date, death_toll, no_of_injuries, no_of_people_missing, no_of_families_affected, no_of_houses_destroyed, estimated_damage_cost, incident_info_source)".
                "VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s');",
                 $mysqli->real_escape_string($description),
                 $mysqli->real_escape_string($disasterType),
                 $mysqli->real_escape_string($date),
                 $mysqli->real_escape_string($deaths),
                 $mysqli->real_escape_string($injured),
                 $mysqli->real_escape_string($missing),
                 $mysqli->real_escape_string($familiesAffected),
                 $mysqli->real_escape_string($housesDestroyed),
                 $mysqli->real_escape_string($damageCost),
                 $mysqli->real_escape_string($source));

$result1 = $mysqli->query($query1);
$reportNum = $mysqli->insert_id;

console.log($query1);

$query3 = "INSERT INTO incident_location ".
                " (incident_report_id, incident_location_id, incident_intensity, lat, lng, polygon)".
                "VALUES ('$reportNum',2,3,8.228021,124.245242,
                 PolygonFromText('$polygon'));";

$result3 = $mysqli->query($query3);



if((!$result3)){
    die('Invalid query: '.mysql_error());
}
