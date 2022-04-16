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
						<th>Username</th>
						<th>Email</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<tr>
						<td>ram</td>
						<td>ram@gmail.com</td>
						<td>1</td>
						<td>
							<a href="action.php">Activated</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>