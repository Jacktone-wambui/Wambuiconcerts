<?php 
session_start();

if (isset($_SESSION['Name']) && isset($_SESSION['Password'])) {

	include "db_conn.php";

if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    
    if(empty($op)){
      header("Location: settings.html?error=Old Password is required");
	  exit();
    }else if(empty($np)){
      header("Location: settings.html?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location: settings.html?error=The confirmation password  does not match");
	  exit();
    }else {
    	// hashing the password
    	$op = md5($op);
    	$np = md5($np);
        $email = $_SESSION['Email'];

        $sql = "SELECT Password
                FROM signup WHERE 
                Email='$email' AND Password='$op'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE signup
        	          SET Password='$np'
        	          WHERE Email='$email'";
        	mysqli_query($conn, $sql_2);
        	header("Location: settings.html?success=Your password has been changed successfully");
	        exit();

        }else {
        	header("Location: settings.html?error=Incorrect password");
	        exit();
        }

    }

    
}else{
	header("Location: change-password.php");
	exit();
}

}else{
     header("Location: index.php");
     exit();
}