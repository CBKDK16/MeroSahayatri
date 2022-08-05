<?php
	require_once 'function/check_session.php';
	require 'function/validate.php';
	require 'function/constant.php';
	$error = [];
	$locations = [];
	$name = $longitude = $latitude ='';
	$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	try
	{
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
	if(isset($_POST['addLocation']))
	{
		if(requireValidation($_POST,'name'))
		{
			$name = $_POST['name'];
		}
		else
		{
			$error['name'] = 'Enter location';
		}
		if(requireValidation($_POST,'longitude'))
		{
			$longitude = $_POST['longitude'];
			
			foreach($locations as $key => $location)
			{
				if($location['Longitute'] == $longitude)
					$error['longitude'] = 'longitude already exist';
			}
		}
		else
		{
			$error['longitude'] = 'Enter longitude';
		}

		if(requireValidation($_POST,'latitude'))
		{
			$latitude = $_POST['latitude'];

			foreach($locations as $key => $location)
			{
				if($location['Latitude'] == $latitude)
					$error['latitude'] = 'latitude already exist';
			}
		}
		else
		{
			$error['latitude'] = 'Enter latitude';
		}
			


		//database connection
		if(count($error) == 0)
		{
			try
			{
					$sql = "INSERT INTO location_tbl(name,longitute,latitude)
					values('$name','$longitude','$latitude')";
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
<!DOCTYPE html>
<html>
<title>Location</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/all.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body> 
    <input type="checkbox" id="menu">
    <nav>
         <label id="header">Mero Sahayatri - Admin</label>
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
				<div>
					<h2>
						Location
							<?php if(isset($successmsg)){?>
								<?php echo " - " .$successmsg ?>
							<?php }?>
					</h2>
				</div>
				<hr/>
				<div style="background:grey;">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="locationfrom">
						<div class="clonelocation">
							
							<div>
								<label for="location">Location</label>
								<input type="text" name="name" placeholder="eg. Lagankhel"value="<?php echo $name ?>" class="required" />
								<?php echo displayError($error,'name');?>
								
							</div>
							<div>
								<label for="longitude">Longitude</label>
								<input type="text" name="longitude" placeholder="eg. 82.98577" value="<?php echo $longitude ?>" class="required" />
								<?php echo displayError($error,'longitude');?>
								
							</div>
							<div>
								<label for="latitude">Latitude</label>
								<input type="text" name="latitude" placeholder="eg. 82.98577" value="<?php echo $latitude ?>"/>
								<?php echo displayError($error,'latitude');?>
								
							</div>
						</div>
						<div>
							<input type="submit" value="ADD" name="addLocation"/>
						</div>
					</form>
				</div>
				<div>
					<table>
						<tr>
							<th>id</th>
							<th>Name</th>
							<th>Longitude</th>
							<th>latitude</th>
							<th>Action</th>
						</tr>
						<?php foreach($locations as $key => $location) {?>

						<tr>
							<td><?php echo $location['Location_id']?></td>
							<td><?php echo $location['Name']?></td>
							<td><?php echo $location['Longitute']?></td>
							<td><?php echo $location['Latitude']?></td>
							<td><a href="delete_location.php?id=<?php echo $location['Location_id'] ?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>
						</tr>
					<?php } ?>
					</table>
				</div>
			</div>
     </div>
</body>

</html>

