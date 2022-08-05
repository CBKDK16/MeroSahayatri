<?php

	require_once 'function/constant.php';

	$id = $_GET['id'];
	try{
		$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$sql = "delete from location_tbl where Location_id = $id";
		mysqli_query($connection,$sql);
		header('location:location.php');

	}
	catch(Exception $e)
	{
		die('Database errr:- '. $e->getMessage());
	}

?>