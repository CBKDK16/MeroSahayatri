<?php
	require_once'function/check_session.php';
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



//purano
<!-- <!doctype html>
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
</html> -->