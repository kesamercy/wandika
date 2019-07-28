<?php

$conn= mysqli_connect("localhost", "root", "", "practice");

$result= mysqli_query($conn, "SELECT * from user");

$data= array();
while ($row=mysqli_fetch_assoc($result)) {
	# code...
	$data[]=$row;
}

echo json_encode($data);


?>