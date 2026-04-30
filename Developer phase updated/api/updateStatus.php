<?php
include 'db.php';

$incident_id = $_POST['incident_id'];
$status      = $_POST['status'];

$stmt = mysqli_prepare($conn,
    "UPDATE incidents SET status = ? WHERE id = ?");

mysqli_stmt_bind_param($stmt, "si", $status, $incident_id);

if(mysqli_stmt_execute($stmt)){
    echo json_encode([
        "status"  => "success",
        "message" => "Status Updated Successfully"
    ]);
} else {
    echo json_encode([
        "status"  => "error",
        "message" => "Failed to Update Status"
    ]);
}
?>