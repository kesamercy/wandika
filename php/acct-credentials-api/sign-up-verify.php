<?php

if(isset($_POST['submit'])){

 include_once 'main-db-connection.php';
 //echo json_encode($_POST);

 $uid= mysqli_real_escape_string($conn, $_POST['username']);
 $email= mysqli_real_escape_string($conn, $_POST['email']);
 $pwd= mysqli_real_escape_string($conn, $_POST['user_pass']);
 $pwd_2= mysqli_real_escape_string($conn, $_POST['password']);
 $country= mysqli_real_escape_string($conn, $_POST['country']);

 //Error Handlers
 //Check for emty fields(Check for errors first. Always a good practice!)
 if(empty($uid) || empty($email) || empty($pwd) || empty($pwd_2) || empty($country)){
    header("Location: ../../html/create-account.html?signup=empty");
	exit();
 }
 else{
    //Check if input characters are valid.
    if(!preg_match("/^[a-zA-Z]*$/", $uid)){
        header("Location: ../../html/create-account.html?signup=invalid");
	    exit();
    } else{
         //Check if email is valid
    	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
           header("Location: ../../html/create-account.html?signup=email");
	       exit();
    	}else{
            //using prepared statements
    		//check if the username has been taken.
            $sql= "SELECT * FROM user WHERE username=?";
    		$stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL error!";
           }else{
            $data = Array();
            //using prepared statements
            mysqli_stmt_bind_param($stmt, "s", $uid);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            while($row=mysqli_fetch_assoc($result)){
                $data[] = $row;
              }
              if(0<count($data)){
                header("Location: ../../html/create-account.html?signup=usertaken");
                exit();
              }else{
                //Hashing Password
                $hashedPwd=password_hash($pwd, PASSWORD_DEFAULT);
                //Insert the user into the database
                $sql="INSERT INTO user (username, email, password, country) VALUES (?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL error!";
                }else{
                mysqli_stmt_bind_param($stmt, "ssss", $uid, $email, $hashedPwd, $country);
                mysqli_stmt_execute($stmt);
                header("Location: ../../html/new-user.html?signup=success");
                exit();
              }
          }
    	}
      }
    }
  }
}
else{
	header("Location: ../../html/create-account.html");
	exit();
}