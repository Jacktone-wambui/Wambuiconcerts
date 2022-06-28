<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
	session_start();
	header('location:login.html');
	
	$con = mysqli_connect('localhost','root','');
	
	mysqli_select_db($con, 'warrenconcerts');
	
	$name = $_POST['Name'];
	$email = $_POST['Email'];
	$password = $_POST['password'];
	$contact = $_POST['Contact'];
	$city = $_POST['City'];
	$address = $_POST['Address'];
	
	$s = "select * from signup where Name = '$name'";
	
	$result = mysqli_query($con, $s);
	
	$num = mysqli_num_rows($result);
	
	if($num == 1){
	echo" Username Already Taken";
	}else{
	    $reg= "insert into usertable(Name,Email,Password,Contact,City,Address) values('$name','$email','$password','$contact','$city','$address')";
	    mysqli_query($con, $reg);
	    echo" Registration Successful";
	}
	?>
</body>
</html>