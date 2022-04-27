<?php
print_r($route);
	require 'function/constant.php';
	$error = [];
	$routes = [];
	$name = $longitude = $latitude ='';
	$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	try
	{
		$select = "SELECT * FROM routes_tbl ORDER BY Route_id DESC";
		$result = mysqli_query($connection,$select);
					
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				array_push($routes,$row);
			}
		}	
		
	}
	catch(Exception $e)
	{
		die('Database error:- '.$e->getMessage());
	}

?>
<!doctype html>
<html>
	<head>
		<title>Vehicles List</title>
		<style>
			*{
				color: white;
			}
			#back{
				background-image: url('img/background.jpg');
				height: 750px;
			}
			a{
				color: #fff;
			}
			h1{
				color: #fff;
			}
			div{
				color: #fff;
			}
		</style>
	</head>
	<body>
		<div id="back">
			<div>
				<img src="img/logo.jpg"/>
			</div>
			<div>
				<?php require_once 'function/menu.php' ?>
			</div>
			<div>
				<h1>Hey Admin Name</h1>
			</div>
			<div>
				<h2>Vechicles List</h2>
			</div>
			<div>
				<table border="1px">
					<tr>
						<th>Name</th>
						<th>From</th>
						<th>To</th>
						<th>Action</th>
						<th>Checkpoint</th>
					</tr>
					<?php foreach($routes as $key => $route) {?>
					<tr>
						<td><?php echo $route['Route_id']?></td>
						<td><?php echo $route['From_id']?></td>
						<td><?php echo $route['To_id']?></td>
						<td>
							<a href="update.php">Update</a>
							<a href="delete.php">Delete</a>
						</td>
						<td>
							<a href="checkpoint.php">Add</a>
						</td>
					</tr>
				<?php }?>
				</table>
			</div>
		</div>
	</body>
</html>