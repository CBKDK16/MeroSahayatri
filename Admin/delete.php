<?php 
	require_once 'function/constant.php';

	$id = $_GET['id'];
	try{
		$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$sql = "delete from routes_tbl where Route_id= $id";
		mysqli_query($connection,$sql);
		header('location:vehicles_list.php');
	}
	catch(Exception $e)
	{
		die('Database error:- '. $e->getMessage());
	}
?>