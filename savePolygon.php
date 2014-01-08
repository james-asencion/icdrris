<?php

require("application/dbinfo.php");

$lat = $_GET['lat'];
$lng = $_GET['lng'];
$intensity = $_GET['intensity'];

$connection = mysql_connect("localhost",$username,$password);
if(!$connection){
    die('Not connected : '.mysql_error());
}

$db_selected = mysql_select_db($database, $connection);
if(!$db_selected){
    die('Can\'t use db : '.mysql_error());
}

$query = sprintf("INSERT INTO incident_location ".
                " (incidentLocationNo, reportNo, locationId, intensity, lat, lng)".
                "VALUES (1,'%s','%s','%s','%s','%s');",
                 1, 
                 1,
                 mysql_real_escape_string($intensity),
                 $lat, 
                 $lng);

$result = mysql_query($query);

if(!$result){
    die('Invalid query: '.mysql_error());
}
