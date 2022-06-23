<?php 
	$error = [];

	$name = $type = $fromlocation = $tolocation =  $fare = $timeinterval = $available = '';
	//to validate data in vehicle 
	$id = $_GET['id'];
	require_once 'function/constant.php';
	require 'function/validate.php';
	try
	{
		$connect = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

		//Grab data from database of location_tbl
		$sql = "select * from location_tbl";
		$res = mysqli_query($connect,$sql);
		$locations = [];
		if(mysqli_num_rows($res)>0)
		{
			while($result = mysqli_fetch_assoc($res))
			{
				array_push($locations,$result);
			}
		}

		//Grab data from database of vehicleType_tbl
		$sql1 = "select * from vehicletype_tbl";
		$res1 = mysqli_query($connect,$sql1);
		$types = [];
		if(mysqli_num_rows($res1)>0)
		{
			while($result1 = mysqli_fetch_assoc($res1))
			{
				array_push($types,$result1);
			}
		}


		//grab data from database of Route_tbl
		$sql2 = "select * from routes_tbl where Route_id=$id";
		$res2 = mysqli_query($connect,$sql2);
		if(mysqli_num_rows($res2) == 0)
		{
			header('location:vehicles_list.php');
		}
		//The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array.
		$row = mysqli_fetch_assoc($res2);
		print_r($row);
		extract($row);
		print_r($_POST);
		echo $timeinterval;
	}
	catch(Exception $e)
	{
		echo false;
	}
$name = $type = $fromlocation = $tolocation =  $fare = $timeinterval = $available = '';
	if(requireValidation($_POST,'type'))
	{
		$type = $_POST['type'];
	}
	else{
		$error['type'] = 'Please Select type';
	}

	if(requireValidation($_POST,'fromlocation'))
	{
		$fromlocation = $_POST['fromlocation'];
	}
	else{
		$error['fromlocation'] = 'Please Select location';
	}

	if(requireValidation($_POST,'tolocation'))
	{
		$tolocation = $_POST['tolocation'];
	}
	else{
		$error['tolocation'] = 'Please Select tolocation';
	}

	if(requireValidation($_POST,'fare'))
	{
		$fare = $_POST['fare'];
	}
	else{
		$error['fare'] = 'Please Select fare';
	}

	if(requireValidation($_POST,'timeinterval'))
	{
		$timeinterval = $_POST['timeinterval'];
	}
	else{
		$error['timeinterval'] = 'Please Select timeinterval';
	}

	if(requireValidation($_POST,'available'))
	{
		$available = $_POST['available'];
	}
	else{
		$error['available'] = 'Please Select available';
	}

	if(count($error) == 0)
	{
		
	}	
	
?>
<!doctype html>
<html>
	<head>
		<title>Vehicles</title>
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
			div{
				margin: 5px 0px 0px 10px;
			}
			
			#addvehicleform{
				margin: 30px;
				background-color:#fff ;
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
				<h2>Vehicle - Update</h2>
			</div>
			<div id="addvehicleform">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
	<div>
		<div>
			<label>Vehicle</label>
		</div>
		<hr/>
		
		<div>
			<label for="type">Type</label>
			<select name="type" id="type">
				<option value="">Select type</option>
				<?php
				foreach($types as $type){?>

				<?php
					if($type['Vehicle_id'] == $row['Vehicle_id']) {
						?>
						<option value="<?php echo $type['Vehicle_id']; ?>" selected><?php echo $type['Type']; ?></option>
						<?php
					}
					else{
						?>
						<option value="<?php echo $type['Vehicle_id']; ?>"><?php echo $type['Type']; ?></option>
						<?php
					}

				?>
				<?php } ?>
					}
			</select>
		</div>
	</div>

	<div>
		<div>
			<label>From</label>
		</div>
		<hr/>
		<div>
			<label for="location">Location</label>
			<select name="fromlocation" id="location">
				<option value="">Select location</option>
				<?php
				foreach($locations as $location){?>
				<option value="<?php echo $location['Location_id']; ?>"><?php echo $location['Name']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div>
		<div>
			<label>To</label>
		</div>
		<hr/>
		<div>
			<label for="location">Location</label>
			<select name="tolocation" id="tolocation">
				<option value="">Select location</option>
				<?php
				foreach($locations as $location){?>
				<option value="<?php echo $location['Location_id']; ?>"><?php echo $location['Name']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div>
		<div>
			<label>Details</label>
		</div>
		<hr/>
		<div>
			<label for="fare">Fare</label>
			<input type="number" name="fare" value="<?php echo $fare?>"/>
			<?php echo displayError($error,'fare');?>
		</div>
		<div>
			<label for="timeinterval">Time Interval</label>
			<input type="text" name="timeinterval" value="<?php echo $timeinterval ?>"/>
			<?php echo displayError($error,'timeinterval');?>
		</div>
		<div>
			<label for="available">Available</label>
			<input type="text" name="available"
			value="<?php echo $available?>" />
			<?php echo displayError($error,'available');?>
		</div>
	</div>
	
	

				<br/>
				<input type="submit" value="Update" name="updatevehicle"/>
			</form>
			</div>
		</div>
	</body>
</html>