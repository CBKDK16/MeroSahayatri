<?php

	require_once'function/check_session.php';
	require_once'function/constant.php';
	$types = [];
	$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

	//grab data from database
		try
		{
			$select = "SELECT * FROM vehicletype_tbl ORDER BY vehicle_id DESC";
			$result = mysqli_query($connection,$select);
						
			if(mysqli_num_rows($result)>0)
			{
				while($row = mysqli_fetch_assoc($result))
				{
					array_push($types,$row);
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
		foreach($types as $key => $type)
		{
			if($type['Type'] == $vname)
			{
				$err['vname'] = 'Duplicate Type';
			}
		}
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
					print_r($_POST);
				// query execution
				if($result1)
				{
					$successmsg="Vehicle add successfully";
					header("location:VehicleType.php");
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
<title>Vehicle Type</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/all.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="css/vehicletype.css?v=<?php echo time();?>">
    
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
    <div class="data" >
    		<div id="form">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					<div class="vehicle">
						<label>
							Vehicle Type
							<?php
								if(isset($successmsg))
								{
									echo " - ". $successmsg;
								}
							?>
						</label>
						<br>
						<input type="text" name="vname">
						
					</div>
					<br>
					<div>
						<button type="submit" name="add">Add</button>
						<?php if(isset($err['vname']))
						{
							echo $err['vname'];
						}
						?>
					</div>
				</form>
			</div>

			<div  id="table">
				<fieldset>
				<legend>Vehicle Type List</legend>
					<table>
						<tr>
							<th>id</th>
							<th>type</th>
							<th>Action</th>
						</tr>
						<?php foreach($types as $key => $type) {?>

						<tr>
							<td><?php echo $key+1?></td>
							<td><?php echo $type['Type']?></td>
							<td>
								<a href="delete_vehicleType.php?id=<?php echo $type['Vehicle_id']?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
							</td>
						</tr>
					<?php } ?>
					</table>
				</fieldset>
			</div>
			
     </div>
</body>

</html>



