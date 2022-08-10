<?php
	function id_to_name($data,$index)
	{
		//grab data from location from location_tbl
		$fid = $data[$index];
		$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$sql = "select * from location_tbl where Location_id = $fid";
		$res = mysqli_query($connection,$sql);
		if(mysqli_num_rows($res)>0)
		{
			$rows = mysqli_fetch_assoc($res);
		}
	return $rows;
	}


	function id_to_names($data,$index)
	{
		//grab data from location from location_tbl
		$fid = $data[$index];
		$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		$sql = "select * from vehicletype_tbl where Vehicle_id = $fid";
		$res = mysqli_query($connection,$sql);
		if(mysqli_num_rows($res)>0)
		{
			$rows = mysqli_fetch_assoc($res);
		}
	return $rows;
	}
?>