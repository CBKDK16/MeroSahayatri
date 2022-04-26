<?php 
	require_once 'function/constant.php';
	try
	{
		$connect = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
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
	}
	catch(Exception $e)
	{
		echo false;
	}
	print_r($result);
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
	<div>
		<div>
			<label>Vehicle</label>
		</div>
		<hr/>
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo $name ?>"/>
			<?php echo displayError($error,'name');?>
		</div>
		<div>
			<label for="type">Type</label>
			<select name="type">
				<option>Select type</option>
				<option>Micro</option>
				<option>Bus</option>
			</select>
		</div>
	</div>

	<div>
		<div>
			<label>From</label>
		</div>
		<hr/>
		<div>
			<label for="location">Location</label>
			<select name="location" id="location">
				<option value="">Select location</option>
				<?php
				foreach($locations as $location){?>
				<option value="<?php $id = $location['Location_id']; ?>"><?php echo $location['Name']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div>
		<div>
			<label>To</label>
		</div>
		<hr/>
		<div>
			<label for="location">Location</label>
			<input type="text" name="tolocation" value="<?php echo $tolocation ?>" />
			<?php echo displayError($error,'tolocation');?>
		</div>
		<div>
			<label for="longitude">Longitude</label>
			<input type="number" name="tolongitude" value="<?php echo $tolongitude?>"/>
			<?php echo displayError($error,'tolongitude');?>
		</div>
		<div>
			<label for="latitude">Latitude</label>
			<input type="number" name="tolatitude" value="<?php echo $tolatitude?>"/>
			<?php echo displayError($error,'tolatitude');?>
		</div>
	</div>

	<div>
		<div>
			<label>Details</label>
		</div>
		<hr/>
		<div>
			<label for="fare">Fare</label>
			<input type="number" name="fare" value="<?php echo $fare?>"/>
			<?php echo displayError($error,'fare');?>
		</div>
		<div>
			<label for="timeinterval">Time Interval</label>
			<input type="text" name="timeinterval" value="<?php echo $timeinterval ?>"/>
			<?php echo displayError($error,'timeinterval');?>
		</div>
		<div>
			<label for="available">Available</label>
			<input type="text" name="available"
			value="<?php echo $available?>" />
			<?php echo displayError($error,'available');?>
		</div>
	</div>
	<div>
		<div>
			<label for="checkpoint">Checkpoint</label>
		</div>
		<hr/>
		<div class="add">
			<div>
				<input type="checkbox" name=""/>
			</div>
			<div>
				<label for="location">Location</label>		
				<input type="text" name="checkpointlocation"/>
			</div>
			<div>
				<label for="longitude">Longitude</label>	<input type="number" name="checkpointlongitude"/>
			</div>
			<div>
				<label for="latitude">Latitude</label>
				<input type="number" name="checkpointlatitude"/>
			</div>
		</div>
		<br/>
		<input type="button" value="Add" name="addcheckpoint" onclick="addMore();"/>
		<input type="submit" value="Delete" name="deletecheckpoint" onclick="deleteRow();"/>
	</div>
	
