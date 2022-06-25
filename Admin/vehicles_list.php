<?php
	require_once 'function/check_session.php';
	require 'function/constant.php';
	
	$error = [];
	$routes = [];
	$name = $longitude = $latitude ='';
	$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	require 'function/id_to_name.php';
	try
	{
		$select = "SELECT * FROM routes_tbl";
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
						<td>
							<?php 
								$ro = id_to_name($route,'From_id');
								echo $ro['Name'];
							?>
						</td>
						<td>
							<?php
							 $ro = id_to_name($route,'To_id');
								echo $ro['Name'];
							?>
						</td>
						<td>
							<a href="update.php?id=<?php echo $route['Route_id']?>">Update</a>
							<a href="delete.php?id=<?php echo $route['Route_id']?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
						</td>
						<td>
							<a href="checkpoint.php?id=<?php echo $route['Route_id']?>">Add</a>
						</td>
					</tr>
				<?php }?> 
				</table>
			</div>
     </div>
</body>

</html>


<!-- //purano -->
<!-- <!doctype html>
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
						<td>
							<?php 
								$ro = id_to_name($route,'From_id');
								echo $ro['Name'];
							?>
						</td>
						<td>
							<?php
							 $ro = id_to_name($route,'To_id');
								echo $ro['Name'];
							?>
						</td>
						<td>
							<a href="update.php?id=<?php echo $route['Route_id']?>">Update</a>
							<a href="delete.php?id=<?php echo $route['Route_id']?>">Delete</a>
						</td>
						<td>
							<a href="checkpoint.php?id=<?php echo $route['Route_id']?>">Add</a>
						</td>
					</tr>
				<?php }?> 
				</table>
			</div>
		</div>
	</body>
</html> -->