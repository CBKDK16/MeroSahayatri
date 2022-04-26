<?php 
require_once 'function/constant.php';
$locations = [];

try
			{
				$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
				$select = "SELECT * FROM location_tbl ORDER BY location_id DESC";
				$result = mysqli_query($connection,$select);
				
				if(mysqli_num_rows($result)>0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						array_push($locations,$row);
					}
				}
			}
			catch(Exception $e)
			{
				die('Database error:- '.$e->getMessage());
			}

			echo json_encode($locations);

 ?>