<?php
	$checkpointlocation = '';
	try{
		//grab data from database of checkpoint_tbl
		$sql_checkpoint = "select * from checkpoint_tbl c1 Inner join location_tbl using(location_id) where route_id = $id";
		//execute query
		$result_checkpoint = mysqli_query($con,$sql_checkpoint);
		//check the no. of rows available in database
		$checkpoint = [];
		if(mysqli_num_rows($result_checkpoint)>0)
		{
			//Fetches one row of data from the result set and returns it as an associative array
			while($row_checkpoint = mysqli_fetch_assoc($result_checkpoint))
			{
				array_push($checkpoint,$row_checkpoint);
			}
		}
	}
	catch(Exception $e)
	{
		echo false;
	}
?>