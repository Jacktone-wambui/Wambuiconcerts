<?php
	session_start();
	header('location:settings.html');

 $con = mysqli_connect('localhost','root','');
	
 mysqli_select_db($con, 'warrenconcerts');

if(isset($_POST['change_password'])){
	$currentPassword = $_POST['Old Password'];
	$password = $_POST['NewPassword'];
	$passwordConfirm = $_POST['rtnp'];

	$sql="SELECT Password from signup where Email='$email'";
	$res = mysqli_query($con,$sql);

	$row = mysqli_fetch_assoc($res);
	if(password_verify($currentPassword,$row['Password'])){
if($passwordConfirm ==''){
		 $error[] = 'Please confirm the password.';
	 }
	 if($password != $passwordConfirm){
		 $error[] = 'Passwords do not match.';
	 }
	   if(strlen($password)<5){ // min 
		 $error[] = 'The password is 6 characters long.';
	 }
	 
	  if(strlen($password)>20){ // Max 
		 $error[] = 'Password: Max length 20 Characters Not allowed';
	 }
if(!isset($error))
{
   $options = array("cost"=>4);
 $password = password_hash($password,PASSWORD_BCRYPT,$options);

  $result = mysqli_query($con,"UPDATE signup SET password='$password' WHERE Email='$email'");
		if($result)
		{
	header("location:product.html?password_updated=1");
		}
		else 
		{
		 $error[]='Something went wrong';
		}
}

	 } 
	 else 
	 {
		 $error[]='Current password does not match.'; 
	 }   
 }
	 if(isset($error)){ 

foreach($error as $error){ 
echo '<p class="errmsg">'.$error.'</p>'; 
}
}
	 ?> 
