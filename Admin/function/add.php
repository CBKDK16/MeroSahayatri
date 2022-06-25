<?php 
	//to validate data in vehicle 
	require_once 'function/constant.php';
	
	try
	{
		$connect = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

		//Grab data from database of location_tbl
		$sql = "select * from location_tbl";
		$res = mysqli_query($connect,$sql);
		$locations = [];
		if(mysqli_num_rows($res)>0)
		{
			while($result = mysqli_fetch_assoc($res))
			{
				array_push($locations,$result);
			}
		}

		//Grab data from database of vehicleType_tbl
		$sql1 = "select * from vehicletype_tbl";
		$res1 = mysqli_query($connect,$sql1);
		$types = [];
		if(mysqli_num_rows($res1)>0)
		{
			while($result1 = mysqli_fetch_assoc($res1))
			{
				array_push($types,$result1);
			}
		}

	}
	catch(Exception $e)
	{
		echo false;
	}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
	<div>
		<div>
			<label>Vehicle</label>
		</div>
		<hr/>
		
		<div>
			<label for="type">Type</label>
			<select name="type" id="type">
				<option value="">Select type</option>
				<?php
				foreach($types as $type){?>
				<option value="<?php echo $type['Vehicle_id']; ?>"><?php echo $type['Type']; ?></option>
				<?php } ?>
			</select>
			<?php echo displayError($error,'type');?>
		</div>
	</div>

	<div>
		<div>
			<label>From</label>
		</div>
		<hr/>
		<div>
			<label for="location">Location</label>
			<select name="fromlocation" id="location">
				<option value="">Select location</option>
				<?php
				foreach($locations as $location){?>
				<option value="<?php echo $location['Location_id']; ?>"><?php echo $location['Name']; ?></option>
				<?php } ?>
			</select>
			<?php echo displayError($error,'fromlocation');?>
		</div>
	</div>

	<div>
		<div>
			<label>To</label>
		</div>
		<hr/>
		<div>
			<label for="location">Location</label>
			<select name="tolocation" id="tolocation">
				<option value="">Select location</option>
				<?php
				foreach($locations as $location){?>
				<option value="<?php echo $location['Location_id']; ?>"><?php echo $location['Name']; ?></option>
				<?php } ?>
			</select>
			<?php echo displayError($error,'tolocation');?>
		</div>
	</div>

	<div>
		<div>
			<label>Details</label>
		</div>
		<hr/>
		<div>
			<label for="fare">Fare</label>
			<input type="number" name="fare" placeholder="eg.50" value="<?php echo isset($fare)?$fare:''; ?>"/>
			<?php echo displayError($error,'fare');?>
		</div>
		<div>
			<label for="timeinterval">Time Interval</label>
			<input type="text" name="timeinterval" placeholder="eg.Every 10min" value="<?php echo $timeinterval ?>"/>
			<?php 
				if(isset($error['timeinterval']))
					echo displayError($error,'timeinterval');
			?>
		</div>
		<div>
			<label for="available">Available</label>
			<input type="text" name="available"
			placeholder="eg.6am to 7pm" value="<?php echo $available?>" />
			<?php echo displayError($error,'available');?> 
		</div>
	</div>
	
	
