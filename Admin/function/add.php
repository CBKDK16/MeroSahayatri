<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
	<div>
		<div>
			<label>Vehicle</label>
		</div>
		<hr/>
		<div>
			<label for="name">Name</label>
			<input type="text" name="name"/>
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
			<input type="text" name="fromlocation"/>
		</div>
		<div>
			<label for="longitude">Longitude</label>
			<input type="number" name="fromlongitude"/>
		</div>
		<div>
			<label for="latitude">Latitude</label>
			<input type="number" name="fromlatitude"/>
		</div>
	</div>

	<div>
		<div>
			<label>To</label>
		</div>
		<hr/>
		<div>
			<label for="location">Location</label>
			<input type="text" name="tolocation"/>
		</div>
		<div>
			<label for="longitude">Longitude</label>
			<input type="number" name="tolongitude"/>
		</div>
		<div>
			<label for="latitude">Latitude</label>
			<input type="number" name="tolatitude"/>
		</div>
	</div>

	<div>
		<div>
			<label>Details</label>
		</div>
		<hr/>
		<div>
			<label for="fare">Fare</label>
			<input type="number" name="fare"/>
		</div>
		<div>
			<label for="timeinterval">Time Interval</label>
			<input type="text" name="timeinterval"/>
		</div>
		<div>
			<label for="available">Available</label>
			<input type="text" name="available"/>
		</div>
	</div>
	
</form>