<?php

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
				<h2>Vehicle</h2>
			</div>
			<div id="addvehicleform">
				<?php require_once 'function/add.php' ?>
				<br/>
				<input type="submit" value="Add" name="addvehicle"/>
			</div>
		</div>
	</body>
</html>