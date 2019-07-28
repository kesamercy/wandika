<?php

$conn= mysqli_connect("localhost", "root", "", "practice");

header("Content-Type: application/json", true);
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            echo 'Hello!!';
        }
//if($action=='blog-post'){
$result= mysqli_query($conn, "SELECT * from user");

$data= array();
while ($row=mysqli_fetch_assoc($result)) {
	# code...
	$data[]=$row;
}
//}


echo json_encode($data);


?>