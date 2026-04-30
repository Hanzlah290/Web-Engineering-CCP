<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = mysqli_connect("localhost", "root", "", "cyber_incident_system");

if(!$conn){
    die(json_encode(["status" => "error", "message" => "Connection Failed"]));
}
?>