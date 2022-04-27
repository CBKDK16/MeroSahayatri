<?php
	require_once'function/constant.php';
	$locations = [];
	$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		try
		{
			$select = "SELECT * FROM vehicletype_tbl ORDER BY vehicle_id DESC";
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



	if(isset($_POST['add']))
	{
	$err=[];

	if(isset($_POST['vname']) && !empty($_POST['vname']) && trim($_POST['vname']))
	{
		$vname = trim($_POST['vname']);
	}
	else
	{
		$err['vname']='Enter vehicle type';

	}
	//Database Connection
	if(count($err) == 0)
		{
			try
			{
				$connection = mysqli_connect('localhost','root','','merosahayatri_db');
				
					$sql = "INSERT INTO vehicletype_tbl(Type)
					values('$vname')";
					$result1 = mysqli_query($connection,$sql);
				// query execution
				if($result1)
				{
					$successmsg="location add successfully";
				}
			}
			catch(Exception $e)
			{
				die('Database error:- '.$e->getMessage());
			}
		}
	}
?>


<!doctype html>
<html>
	<head>
		<title>Dashboard</title>
		<style>
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
				<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					<div class="vehicle">
						<label>Vehicle Type</label>
						<br>
						<input type="text" name="vname">
						<?php if(isset($err['vname']))
						{
							echo $err['vname'];
						}
						?>
					</div>
						<br>
					<div>
						<button type="submit" name="add">Add</button>
					</div>
				</form>
			</div>
			<div>
					<table>
						<tr>
							<th>id</th>
							<th>type</th>
						</tr>
						<?php foreach($locations as $key => $location) {?>

						<tr>
							<td><?php echo $location['Vehicle_id']?></td>
							<td><?php echo $location['Type']?></td>
						</tr>
					<?php } ?>
					</table>
			</div>
		</div>
	</body>
</html>