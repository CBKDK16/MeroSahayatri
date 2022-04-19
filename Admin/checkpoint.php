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
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
					<div>
						<div>
							<label for="checkpoint">Checkpoint</label>
						</div>
						<hr/>
						<div>
							<label for="location">Location</label>
							<input type="text" name="checkpointlocation"/>
						</div>
						<div>
							<label for="longitude">Longitude</label>
							<input type="number" name="checkpointlongitude"/>
						</div>
						<div>
							<label for="latitude">Latitude</label>
							<input type="number" name="checkpointlatitude"/>
						</div>
					</div>
				
					<br/>
					<input type="submit" value="Add" name="addcheckpoint"/>
					<input type="submit" value="Delete" name="deletecheckpoint"/>
				
			</div>
		</div>
	</body>
</html>