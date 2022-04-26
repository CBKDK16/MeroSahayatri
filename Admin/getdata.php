<?php
	require_once'function/constant.php';
	$users = [];
	try
	{
		$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$select = "SELECT * FROM users";
		$result = mysqli_query($connection,$select);
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				array_push($users,$row);
			}
		}
	}
	catch(Exception $e)
	{
		die('Database error :- '.$e->getMessage());
	}
	echo json_encode($users);
	$connection->close();
?>