<?php

session_start();

if(isset($_POST['submit'])){

	include 'dbh.inc.php';
	$uid= mysqli_real_escape_string($conn, $_POST['uid']); //mysqli_real_escape_string() makes sure that people do not type in any malicious code inside.
	$pwd= mysqli_real_escape_string($conn, $_POST['pwd']);

	//Error handlers
	//Check if inputs are empty
	if(empty($uid) || empty($pwd)){
         header("Location: ../index.php?login=empty");
	     exit();
	}else{
		$sql= "SELECT * FROM user WHERE username='$uid' OR email='$uid'";
		$result=mysqli_query($conn, $sql);
		$resultCheck= mysqli_num_rows($result);
		if($resultCheck<1){
			header("Location: ../index.php?login=error");
	        exit();
		}else{
			if($row = mysqli_fetch_assoc($result))
			//De-hashing the password
			$hashedPwdCheck= password_verify($pwd, $row['password']); //matching the database password with the password entered by the user using inbuilt password_verify().
		    if($hashedPwdCheck == false){
		    	header("Location: ../index.php?login=error");
	            exit();
		    } elseif($hashedPwdCheck == true){
		    	//Log in the user here
		    	$_SESSION['u_id'] = $row['user_id'];
		    	$_SESSION['u_uid'] = $row['username'];
		    	$_SESSION['u_email'] = $row['email'];
		    	$_SESSION['u_pwd'] = $row['password'];
		    	$_SESSION['u_cntry'] = $row['country'];
		    	header("Location: ../index.php?login=success");
	            exit();
		    }
		}
	}
}else{
	header("Location: ../index.php?login=error");
	exit();
}