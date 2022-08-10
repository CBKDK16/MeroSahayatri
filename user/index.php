<?php 
	if(isset($_COOKIE['user']))
	{
		session_start();
		$_SESSION['user'] = $_COOKIE['user'];
		header('location:index.php');
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/home.css?v=<?php echo time();?>">

	<title>index</title>
</head>
<body>
		
	<div id="container">
		<div id="left" class="all">
			<div id="intro" class="all">
				<div class="col-1">
					<h2>Mero Sahayatri</h2>
					<h3>A path details provider</h3>
					<br/>
					<p>
						Mero Sahayatri is create an e-information about Transportion systems and automate the process of searching for vehicles to reach in time.
					</p>
					<br/>
					<h4>Lalitpur ward No.1, patan dhoka, patan multiple campus, Nepal</h4>
					<br>
					<div id = "buttons">
						<button type="button"><a href="login.php">Login</a><img src="img/arrow.jpeg"></button>
						<button type="button"><a href="register.php">Register</a><img src="img/arrow.jpeg"></button>
					</div>
				</div>
				<div class="col-2">
				</div>
			</div>
		</div>
		<div id="right" class="all">
			<img src="img/concept.jpg"/>
		</div>
	</div>
	<script type="text/javascript" src="js/menu-width.js">
	</script>
</body>
</html>