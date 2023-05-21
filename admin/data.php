<?php
header('Content-Type: application/json');
//include("../connection/connect.php");
$conn = mysqli_connect("localhost","root","","online_rest");

$sqlQuery = "SELECT * FROM users_orders Where date(date) = current_date";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>