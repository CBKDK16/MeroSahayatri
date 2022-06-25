<?php
	require ('constant.php');
	$lid = $_POST['Location_id'];
	try
	{
		$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$sql = "select * from location_tbl where Location_id = lid";
		$res = mysqli_query($connection,$sql);
		$opt = "<option value=''>Select City </option>";
		if(mysqli_num_rows($res)>0)
		{
			while($d = mysqli_fetch_assoc($res))
			{
				$opt .="<option value = '$d[Location_id]'>$d[longitute]</option>";
			}
		}
	}
	catch(Exception $e)
	{
		echo false;
	}
?>