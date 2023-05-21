<?php
header('Content-Type: application/json');
//include("../connection/connect.php");
$conn = mysqli_connect("localhost","root","","online_rest");

$sqlQuery = "SELECT sum(price) as sales, date(date) as date from users_orders GROUP BY date(date)";

$result = mysqli_query($conn,$sqlQuery);

$data1 = array();
foreach ($result as $row) {
	$data1[] = $row;
}

mysqli_close($conn);

echo json_encode($data1);
?>