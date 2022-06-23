<?php
	$id = $_GET['id'];
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
		$sql_checkpoint = "select * from checkpoint_tbl c1 Inner join location_tbl using(location_id) where route_id = $id";
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
				$sql = "insert into checkpoint_tbl(route_id,location_id)values($id,'$checkpointlocation')";
				//query execution
				$result = mysqli_query($connect,$sql);
				
			}catch(Exception $e){

			}
		}
	}
?>
<!doctype html>
<html>
	<head>
		<title>Vehicles</title>
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
			div{
				margin: 5px 0px 0px 10px;
			}
			
			#addvehicleform{
				margin: 30px;
				background-color:#fff ;
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
				<h2>Vehicle - Checkpoint</h2>
			</div>
			<div id="addvehicleform">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $id?>">
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
					<input type="submit" value="Delete" name="deletecheckpoint"/>
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
									<a href="delete_checkpoint.php?id=<?php echo $cp['CHECKPOINT_id']?>">Delete</a>
								</td>
							</tr>
							<?php }?>
						</table>
					</div>
				</form>	
			
			
		</div>
	</body>
</html>