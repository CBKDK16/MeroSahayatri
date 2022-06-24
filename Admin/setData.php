<?php
	print_r($_POST);
	require_once 'function/constant.php';
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	try
	{
		$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$query = "INSERT INTO users values ('$username','$email','$password',1)";
		$result = mysqli_query($connection,$query);
		if($result>0)
		{
			echo "Register sucessfully";
		}
	}
	catch(Exception $e)
	{
		die('Database error:- '.$e->getMessage());
	}
?>