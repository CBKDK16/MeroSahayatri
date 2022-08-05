<?php
	$cid = $_GET['id'];
	require_once 'function/check_session.php';
	require 'function/constant.php';
	require 'function/validate.php';
	$error = [];
	$checkpointlocation = '';
	try{
		//create connection
		$connect = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

		//grab data from database of location_tbl and select table query
		$sql = "select * from location_tbl";
		//execute query
		$res = mysqli_query($connect,$sql);
		//initlize empty array to store data
		$locations = [];
	
		//check if result object contains record
		if(mysqli_num_rows($res)>0){
			//fetch single row from res object as an associtive array
			while($result = mysqli_fetch_assoc($res)){
				//assign row to data array
				array_push($locations,$result);
			}
		}


		//grab data from database of checkpoint_tbl
		$sql_checkpoint = "select * from checkpoint_tbl c1 Inner join location_tbl using(location_id) where route_id = $cid";
		//execute query
		$result_checkpoint = mysqli_query($connect,$sql_checkpoint);
		//check the no. of rows available in database
		$checkpoint = [];
		if(mysqli_num_rows($result_checkpoint)>0)
		{
			//Fetches one row of data from the result set and returns it as an associative array
			while($row_checkpoint = mysqli_fetch_assoc($result_checkpoint))
			{
				array_push($checkpoint,$row_checkpoint);
			}
		}
		print_r($checkpoint);
	}
	catch(Exception $e)
	{
		echo false;
	}
	

	if(isset($_POST['addcheckpoint']))
	{
		if(requireValidation($_POST,'checkpointlocation')){
			$checkpointlocation = $_POST['checkpointlocation'];
		}
		else{
			$error['checkpointlocation'] = 'Please Select location';
		}

		if(count($error) == 0){
			//insert into database
			try{
				//insert into table query
				$sql = "insert into checkpoint_tbl(route_id,location_id)values($cid,'$checkpointlocation')";
				//query execution
				$result = mysqli_query($connect,$sql);
				header('location:checkpoint.php?id='.$cid);
				
			}catch(Exception $e){

			}
		}
	}
?>

<!DOCTYPE html>
<html>
<title>Checkpoint</title>

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
         <?php require "function/menu.php";?>
    </div>
    <div class="data">
    	<div>
				<h2>Vehicle - Checkpoint</h2>
			</div>
			<div id="addvehicleform">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $cid?>">
					<div>
						<div>
							<label for="checkpoint">Checkpoint</label>
						</div>
						<hr/>
						<div>
							<label for="location">Location</label>
							<select name= "checkpointlocation" id="checkpointlocation">
								<option value="">Select location</option>
								<?php 
									foreach($locations as $location){?>
										<option value = "<?php echo $location['Location_id'];?>"><?php echo $location['Name'];?>
								</option>
							<?php } ?>
							</select>
							<?php echo displayError($error,'checkpointlocation');?>
						</div>
					</div>
				
					<br/>
					<input type="submit" value="Add" name="addcheckpoint"/>
					</div>
					<div id="table_list">
						<table border="1px">
							<tr>
								<td>S.N</td>
								<td>Name</td>
								<td>Longitude </td>
								<td>Latitude</td>
								<td>Action</td>
							</tr>
							<?php foreach ($checkpoint as $key => $cp) {?>
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
								<td>
									<a href="delete_checkpoint.php?id=<?php echo $cp['CHECKPOINT_id']?>&cid=<?php echo $cid?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
								</td>
							</tr>
							<?php }?>
						</table>
					</div>
				</form>	
     </div>
</body>

</html>