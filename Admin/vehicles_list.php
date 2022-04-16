<!doctype html>
<html>
	<head>
		<title>Vehicles List</title>
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
				color: #fff;
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
				<h2>Vechicles List</h2>
			</div>
			<div>
				<table border="1px">
					<tr>
						<th>Name</th>
						<th>From</th>
						<th>To</th>
						<th>Action</th>
						<th>Checkpoint</th>
					</tr>
					<tr>
						<td>Micro</td>
						<td>Lagankhel</td>
						<td>Godawari</td>
						<td>
							<a href="update.php">Update</a>
							<a href="delete.php">Delete</a>
						</td>
						<td>
							<a href="checkpoint.php">Add</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>