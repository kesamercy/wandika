<?php

if(isset($_POST['submit'])){

 include_once 'main-db-connection.php';

 $first= mysqli_real_escape_string($conn, $_POST['first_name']);
 $last= mysqli_real_escape_string($conn, $_POST['last_name']);
 $dob= mysqli_real_escape_string($conn, $_POST['dob']);
 $countryCode= mysqli_real_escape_string($conn, $_POST['country_code']);

 if(empty($first) || empty($last) || empty($dob) || empty($country) || empty($countryCode)){
    header("Location: ../../html/new-user.html?info=empty");
	exit();
 }
 else{
    if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
        header("Location: ../../html/new-user.html?signup=invalid");
	    exit();
    }
    else{
    	list($m, $d, $y) = explode('/', $dob);
    	if(!checkdate($m, $d, $y)){
    		header("Location: ../../html/new-user.html?signup=invalidDOB");
	        exit();
    	}else{
    		//using prepared statements
    		$sql= "INSERT into user (first_name, last_name, dob, country_code)
    		       VALUES (?, ?, ?, ?, ?);";
    		$stmt = mysqli_stmt_init($conn);
    		if(!mysqli_stmt_prepare($stmt, $sql)){
    			echo "SQL error!";
    		} else{
    			mysqli_stmt_bind_param($stmt, "ssss", $first, $last, $dob, $countryCode);
    			mysqli_stmt_execute($stmt);
    		}
    	}
    }
 }

}
else{
	header("Location: ../../html/new-user.html");
	exit();
}

