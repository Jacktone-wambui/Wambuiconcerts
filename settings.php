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
