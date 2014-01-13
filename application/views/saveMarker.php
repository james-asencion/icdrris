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
$lat = $_GET['lat'];
$lng = $_GET['lng'];

$mysqli = new mysqli("localhost",$username,$password, $database);
if(mysqli_connect_errno()){
    die('Not connected : '.mysqli_connect_error());
}

//$db_selected = mysql_select_db($database, $connection);
//if(!$db_selected){
//    die('Can\'t use db : '.mysql_error());
//}

$query1 = sprintf("INSERT INTO incident ".
                " (description, disasterType, dateHappened, deaths, injured, missing, affectedFamilies, homesDestroyed, damageCost, infoSource)".
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
$query2 = "SELECT MAX(reportNo) as rNum FROM incident;";
$result2 = $mysqli->query($query2);
$row = $result2->fetch_array(MYSQLI_NUM);

$query3 = "INSERT INTO incident_location ".
                " (reportNo, locationId, intensity, lat, lng, polygon)".
                "VALUES ('$row[0]',2,3,'$lat','$lng',
                 null);";

$result3 = $mysqli->query($query3);



if((!$result3)){
    die('Invalid query: '.mysql_error());
}
