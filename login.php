<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
	session_start();
	
	$con = mysqli_connect('localhost','root','');
	
	mysqli_select_db($con, 'warrenconcerts');
	
	$name = $_POST['Name'];
	$email = $_POST['Email'];
	$password = $_POST['Password'];
	$contact = $_POST['Contact'];
	$city = $_POST['City'];
	$address = $_POST['Address'];
	
	$s = "select * from signup where Email = '$email' && Password = '$password'";
	
	$result = mysqli_query($con, $s);
	
	$num = mysqli_num_rows($result);
	
	if($num == 1){
		  $_SESSION['Email'] = $email;
	      header('location:product.html');
	}else{
	    header('location:index.html');
	}
	?>
</body>
</html>
