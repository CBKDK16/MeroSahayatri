<?php 
	$users =[];
	require_once 'function/constant.php';
	$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$select = "SELECT * from users";
	$result = mysqli_query($connection,$select);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			array_push($users,$row);
		}

		print_r($users);
	}

?>
<!doctype html>
<html>
	<head>
		<title>Users</title>
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
				<h2>Users</h2>
			</div>
			<div>
				<table border="1px">
					<tr>
						<th>Id</th>
						<th>Username</th>
						<th>Email</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<?php foreach($users as $key => $user) {?>
					<tr>
						<td><?php echo $key+1?></td>
						<td><?php echo $user['username']?></td>
						<td><?php echo $user['email']?></td>
						<td>1</td>
						<td>
							<a href="action.php">Activated</a>
						</td>
					</tr>
				<?php }?>
				</table>
			</div>
		</div>
	</body>
</html>