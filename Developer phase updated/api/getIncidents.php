<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM incidents");
$data = [];

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

echo json_encode([
    "status"    => "success",
    "incidents" => $data
]);
?>