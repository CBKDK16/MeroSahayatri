<?php
	require_once 'function/check_session.php';
	//to validate data in vehicle 
	include 'function/validate.php';
	require_once 'function/constant.php';
	$error = [];
	$name = $type = $fromlocation = $tolocation =  $fare = $timeinterval = $available = '';
	if(isset($_POST['addvehicle']))
	{
		if(requireValidation($_POST,'type'))
		{
			$type = $_POST['type'];
		}
		else
		{
			$error['type'] = 'Please Select type.';
		}


		//from 

		if(requireValidation($_POST,'fromlocation'))
		{
			$fromlocation = $_POST['fromlocation'];
		}
		else
		{
			$error['fromlocation'] = "Please select location.";
		}


		//to

		if(requireValidation($_POST,'tolocation'))
		{
			$tolocation = $_POST['tolocation'];
		}
		else
		{
			$error['tolocation'] = "Please select location.";
		}


		//Details
		if(requireValidation($_POST,'fare'))
		{
			$fare = $_POST['fare'];
		}
		else
		{
			$error['fare'] = 'Enter fare.';
		}
		if(requireValidation($_POST,'timeinterval'))
		{
			$timeinterval = $_POST['timeinterval'];
		}
		else
		{
			$error['timeinterval'] = 'Enter timeinterval';
		}
		if(requireValidation($_POST,'available'))
		{
			$available = $_POST['available'];
		}
		else
		{
			$error['available'] = 'Enter available time';
		}


		if(count($error) == 0)
		{
			//insert into database 
			try
			{
				$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
				$sql = "insert into routes_tbl(Vehicle_id,From_id,To_id,Fare,duration,Available)values('$type','$fromlocation','$tolocation','$fare','$timeinterval','$available')";
				if(mysqli_query($connection,$sql))
				{
					header('location:vehicle.php');
					$successmsg = 'Vehicle Added Sucessfully';
				}
			}
			catch(Exception $e)
			{
				die('Database error :- ' . $e->getMessage());
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<title>Dashboard</title>

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
				<h2>
					Vehicle
					<?php if(isset($successmsg))
					{
						echo "  -  " .$successmsg ;
					}
					?>
				</h2>
			</div>
			<div id="addvehicleform">
				<?php require_once 'function/add.php' ?>
				<br/>
				<input type="submit" value="Add" name="addvehicle"/>
				</form>
			</div>
     </div>
</body>

</html>