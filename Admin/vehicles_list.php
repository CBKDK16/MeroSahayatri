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
		$select = "SELECT * FROM routes_tbl r right outer join vehicletype_tbl v on r.Vehicle_id = v.Vehicle_id order by Route_id desc";
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
<title>Route List</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/all.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="css/route_list.css?v=<?php echo time();?>">
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
				<h2>Routes List</h2>
		</div>
    	<div id="table">
    		<fieldset>
			<legend>Route List</legend>
    		<div class="scroll-bg">
			<div class="scroll-div">
			<div class="scroll-object">
    		
				<table>
					<tr>
						<th>Route id</th>
						<th>From</th>
						<th>To</th>
						<th>Type</th>
						<th>Time Interval</th>
						<th>Fare</th>
						<th>Available</th>
						<th>Action</th>
						<th>Checkpoint</th>
					</tr>
					<?php foreach($routes as $key => $route) {?>
					<tr>
						<td><?php echo $key+1?></td>
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
							<?php
								echo $route['Type'];
							?>
						</td>
						<td>
							<?php
								echo $route['Duration'];
							?>
						</td>
						<td>
							<?php
								echo "Rs. " .$route['Fare'];
							?>
						</td>
						<td>
							<?php
								echo $route['Available'];
							?>
						</td>
						<td>
							<a class = "action" href="update.php?id=<?php echo $route['Route_id']?>">Update</a>
							<a href="delete.php?id=<?php echo $route['Route_id']?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
						</td>
						<td>
							<a class = "action" href="checkpoint.php?id=<?php echo $route['Route_id']?>">Add</a>
						</td>
					</tr>
				<?php }?> 
				</table>
			
			</div>
			</div>
			</div>
		</fieldset>
		</div>
     </div>
</body>

</html>


