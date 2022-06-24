<?php
	include('function/constant.php');

	$id = $_GET['id'];
	$con = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$status = $_GET['status'];
	
	$sql = "update users_tbl set status = $status where id = $id";
	if(mysqli_query($con,$sql) == 0)
		echo "Connection failed";
	header('location:users.php');
?>