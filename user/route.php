<?php
	require_once 'function/check_session.php';
	require 'function/constant.php';
	
	$routes = [];
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
<title>Route</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/all.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="css/route.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body> 
    <nav>
         <label>Mero Sahayatri - User</label>
         <div class="side-menu">
	        <center> 
	        	<img src="img/<?=$_SESSION['image']?>">
	        </center>
	    </div>
	    <div class="side-menu">
	        <center> 
	            <h2>
	                <?php
	                    echo $_SESSION['username'];
	                ?>
	            </h2>
	        </center>
	    </div>
        <ul>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>
         <label for="menu" class="menu-bar"> 
            <i class="fa fa-bars"></i> 
        </label>
    </nav>
    <!-- <div class="side-menu">
        <center> 
        	<img src="img/<?=$_SESSION['image']?>">
            <h2>
                <?php
                    echo $_SESSION['username'];
                ?>
            </h2>
        </center>
    </div> -->
    <!-- <div class="data">
    	<div>
				<h2>Routes</h2>
		</div>
    	<div>
				<table border="1px" align="center">
					<tr align="center">
						<th>Name</th>
						<th>From</th>
						<th>To</th>
						<th>Time Interval</th>
						<th>Fare</th>
						<th>Available</th>
						<th>Checkpoint</th>
					</tr>
					<?php foreach($routes as $key => $route) {?>
					<tr align="center">
						<td>
							<?php echo $key+1?>
								
						</td>
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
								echo $route['Duration'];
							?>
						</td>
						<td>
							<?php
								echo $route['Fare'];
							?>
						</td>
						<td>
							<?php
								echo $route['Available'];
							?>
						</td>
						<td>
							<a href="checkpoint.php?id=<?php echo $route['Route_id']?>">View</a>
						</td>
					</tr>
				<?php }?> 
				</table>
			</div>
     </div> -->
     <div id="container">
			<div id="items">
				<?php foreach($routes as $key => $route) {?>
				<div id="" class="item">
					<div class="front">
						<div class="front-img">
							<table border="1px" align="center">
					<tr>
						<th>
							S.no.:
						</th>
						<td>
							<?php echo $key+1?>	
						</td>
					</tr>
					<tr>
						<th>From</th>	
						<td>
							<?php 
								$ro = id_to_name($route,'From_id');
								echo $ro['Name'];
							?>
						</td>
					</tr>
					<tr>
						<th>To</th>
						<td>
							<?php
							 $ro = id_to_name($route,'To_id');
								echo $ro['Name'];
							?>
						</td>
					</tr>
					<tr>
						<th>Time Interval</th>
						<td>
							<?php
								echo $route['Duration'];
							?>
						</td>
					</tr>
					<tr>
						<th>Fare</th>
						<td>
							<?php
								echo $route['Fare'];
							?>
						</td>
					</tr>
					<tr>
						<th>Available</th>
						<td>
							<?php
								echo $route['Available'];
								$id = $route['Route_id'];
							?>
						</td>
					</tr>
				 
				</table>
						</div>
						<div>
							<h3>Route <?php echo $key+1?></h3>
						</div>
					</div>
					<div class="back">
						<h3>Route - Checkpoint</h3>
						<div id="table_list">
						<table border="1px">
							<tr>
								<td>S.N</td>
								<td>Name</td>
								<td>Longitude </td>
								<td>Latitude</td>
							</tr>
							<?php 
							require "function/checkpoint.php";
							foreach ($checkpoint as $key => $cp) {?>
							<tr>
								<td>
									<?php echo $key+1?>
								</td>
								<td>
									<?php echo $cp['Name']?>
								</td>
								<td>
									<?php echo $cp['Longitute']?>
								</td>
								<td>
									<?php echo $cp['Latitude']?>
								</td>
							</tr>
							<?php }?>
						</table>
					</div>
					</div>
				</div>
				<?php }?>
			</div>
</body>

</html>


