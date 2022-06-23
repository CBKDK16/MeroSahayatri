<?php
	require "function/constant.php";
	$id = $_GET['id'];
	try{
		$connect = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$sql = "delete from checkpoint_tbl where CHECKPOINT_id = $id ";
		mysqli_query($connect,$sql);
		header('location:checkpoint.php');

	}
	catch(Exception $e)
	{
		die('Database error :- ' . $e->getMessage());
	}
?>