<?php
include 'db.php';

$user_id       = $_POST['user_id'];
$incident_type = $_POST['incident_type'];
$description   = $_POST['description'];

// Using Prepared Statements to prevent SQL Injection
$stmt = mysqli_prepare($conn, 
    "INSERT INTO incidents (user_id, incident_type, description) 
     VALUES (?, ?, ?)");

mysqli_stmt_bind_param($stmt, "iss", $user_id, $incident_type, $description);

if(mysqli_stmt_execute($stmt)){
    echo json_encode([
        "status"  => "success",
        "message" => "Incident Reported Successfully"
    ]);
} else {
    echo json_encode([
        "status"  => "error",
        "message" => "Failed to Report Incident"
    ]);
}
?>