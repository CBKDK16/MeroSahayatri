<?php
echo "<pre>";
	require_once 'function/check_session.php';
	require 'function/constant.php';
	
	$routes = [];
	$route = [];
	$searchs = [];
	$str = "";
	require 'function/id_to_name.php';
	try
	{
		if(isset($_POST['enter']))
		{
			if(!$_POST['search'] == NULL)
			{
				$str = $_POST['search'];
				$search = "SELECT * from location_tbl where Name like '".$str."%' ";
				$execute = mysqli_query($con,$search);
				if(mysqli_num_rows($execute)>0)
				{
					while($row2 = mysqli_fetch_assoc($execute))
					{
						array_push($searchs,$row2);
					}
					// print_r($searchs);

					foreach($searchs as $key => $values)
					{
						$id = $values['Location_id'];
						$select = "SELECT * from checkpoint_tbl where location_id = $id";
						$checkpoint_query = mysqli_query($con,$select);
						if(mysqli_num_rows($checkpoint_query)>0)
						{
							while($rowa = mysqli_fetch_assoc($checkpoint_query))
							{
								array_push($route,$rowa);
								
							}
						}
					}
					// print_r($route);
					foreach($route as $key => $route)
					{
						$route_id = $route['route_id'];						 
						$select = "SELECT * FROM routes_tbl r right outer join vehicletype_tbl v on r.Vehicle_id = v.Vehicle_id where Route_id = $route_id";
						$result = mysqli_query($con,$select);
						if(mysqli_num_rows($result)>0)
						{
							$row = mysqli_fetch_assoc($result);
							array_push($routes,$row);
						}
					}
					sort($routes);
					// print_r($routes);
				}
				else
				{
					$error['search'] = "no data found";
				}
			}
			else
			{
				$error['search'] = "Please enter location you want.";
			}
		}
	}
	catch(Exception $e)
	{
		die('Database error:- '.$e->getMessage());
	}


	
echo "</pre>";
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
         <div id="nav" class="all">
         	<label>Mero Sahayatri - User</label>
			<div id="menu-bar">
					<?php require "function/menu-list.php"?>
			</div>
				
		</div>
		<div id="nav-menu">
	         <div class="side-menu">
		        <center> 
		        	<img src="img/<?=$_SESSION['image_user']?>">
		        </center>
		    </div>
		    <div class="side-menu">
		        <center> 
		            <h2>
		                <?php
		                    echo $_SESSION['user'];
		                ?>
		            </h2>
		        </center>
		    </div>
	        <ul>
	            <li>
	                <a href="logout.php" style="background-color: rgb(55, 34, 246);">Logout</a>
	            </li>
	        </ul>
	        <div class="side-menu">
		        <form method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
		        	<input type="text" name="search" id="search" value="<?php echo $str?>" placeholder="Search here....">
		        	<input type="submit" name="enter" value="Search">
		        </form>
		    </div>
	         <label for="menu" class="menu-bar"> 
	            <i class="fa fa-bars"></i> 
	        </label>
    	</div>
    </nav>
    
     <div id="container">
     			<?php
	        		if(isset($error['search']))
	        		{
	        			echo "<h2 align='center' id='error'>". $error['search']."</h2>";
	        		} 
	        	?>
			<div id="items">
				<?php foreach($routes as $key => $route) {?>
				<div id="" class="item">
					<div class="front">
						<div class="front-img">
							<table border="0px" cellpadding="200px">
								<tr align="left">
									<th class="padding_top">
										From:
									</th>
									<th class="padding_top">
										To:	
									</th>
								</tr>
								<tr align="center">	
									<td class="padding_bottom">
										<?php 
											$ro = id_to_name($route,'From_id');
											echo $ro['Name'];
										?>
									</td>
									<td class="padding_bottom">
										<?php
										 $ro = id_to_name($route,'To_id');
											echo $ro['Name'];
										?>
									</td>
								</tr>
								<tr>
									<th align="left" class="padding_details">Vehicle: </th>
									<td class="padding_details">
										<?php
											echo $route['Type'];
										?>
									</td>
								</tr>
								<tr>
									<th align="left" class="padding_details">Time Interval: </th>
									<td class="padding_details">
										<?php
											echo $route['Duration'];
										?>
									</td>
								</tr>
								<tr>
									<th align="left" class="padding_details">Fare: </th>
									<td class="padding_details">
										<?php
											echo "Rs. " .$route['Fare'];
										?>
									</td>
								</tr>
								<tr>
									<th align="left" class="padding_details">Available: </th>
									<td class="padding_details">
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
						<h3>Route - Checkpoints</h3>
						<div id="table_list">
						<table border="1px" cellspacing="0" cellpadding="10px" id="table_checkpoint">
							<tr bgcolor="#131e48" id="checkpoint_header">
								<!-- <td>S.N</td> -->
								<td class="padding_checkpoint">Name</td>
								<td class="padding_checkpoint">Longitude </td>
								<td class="padding_checkpoint">Latitude</td>
							</tr>
							<?php 
							require "function/checkpoint.php";
							foreach ($checkpoint as $key => $cp) {?>
							<tr>
								<td class="padding_checkpoint">
									<?php echo $cp['Name']?>
								</td>
								<td class="padding_checkpoint">
									<?php echo $cp['Longitute']?>
								</td>
								<td class="padding_checkpoint">
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


