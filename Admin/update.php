<?php 
	require_once 'function/check_session.php';
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
		$route = mysqli_fetch_assoc($res2);
		print_r($route);
		$fare = $route['Fare'];
		$timeinterval = $route['Duration'];
		$available = $route['Available'];
		print_r($_POST);
	}
	catch(Exception $e)
	{
		echo false;
	}

	if(isset($_POST['updatevehicle']))
	{
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
			$error['fare'] = 'Please enter fare';
		}

		if(requireValidation($_POST,'timeinterval'))
		{
			$timeinterval = $_POST['timeinterval'];
		}
		else{
			$error['timeinterval'] = 'Please enter timeinterval';
		}

		if(requireValidation($_POST,'available'))
		{
			$available = $_POST['available'];
		}
		else{
			$error['available'] = 'Please enter available';
		}
		if(count($error) == 0)
		{
			$sql_update = "update routes_tbl set Vehicle_id = '$type',From_id = '$fromlocation' , To_id = '$tolocation' , Fare = '$fare' , Duration = '$timeinterval' , Available = '$available' where Route_id = $id";
			mysqli_query($connect,$sql_update);
			header('location:vehicles_list.php');
		}
	}	
	
?>

<!DOCTYPE html>
<html>
<title>Update</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/all.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body> 
    <input type="checkbox" id="menu">
    <nav>
         <label>Mero Sahayatri</label>
        <ul>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>
         <label for="menu" class="menu-bar"> 
            <i class="fa fa-bars"></i> 
        </label>
    </nav>
    <div class="side-menu">
        <center> 
        	<img src="img/<?=$_SESSION['image']?>">
        <!-- <br><br>-->
            <h2>
                <?php
                    echo $_SESSION['username'];
                ?>
            </h2>
        </center>
        <!-- <br>-->
         <?php require "function/menu.php";?>
    </div>
    <div class="data">
    	<div>
				<h2>Vehicle - Update
					<?php
						if(isset($hello)){
							echo " - ".$hello;
						}
					?>
				</h2>
			</div>
			<div id="addvehicleform">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $id ?>">
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
									if($type['Vehicle_id'] == $route['Vehicle_id']) {
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
								foreach($locations as $location){
									if($location['Location_id'] == $route['From_id'])
									{?>
										<option value="<?php echo $location['Location_id']; ?>" selected><?php echo $location['Name']; ?></option>
									<?php }
									else
									{?>
										<option value="<?php echo $location['Location_id']; ?>"><?php echo $location['Name']; ?></option>
								<?php }} ?>
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
								foreach($locations as $location){
									if($location['Location_id'] == $route['To_id'])
									{?>
										<option value="<?php echo $location['Location_id']; ?>" selected><?php echo $location['Name']; ?></option>
									<?php }
									else
									{?>
										<option value="<?php echo $location['Location_id']; ?>"><?php echo $location['Name']; ?></option>
								<?php }} ?>
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
							value="<?php echo $available ?>" />
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