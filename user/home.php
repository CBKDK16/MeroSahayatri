<?php
	require_once 'function/check_session.php';
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/home.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="css/all.css?v=<?php echo time();?>">


	<title>index</title>
</head>
<body>
	<?php
		require_once "function/nav.php";
	?>
	<div id="container">
		<div id="left" class="all">
			<div id="intro" class="all">
				<div class="col-1">
					<h2>Mero Sahayatri</h2>
					<h3>A path details provider</h3>
					<br>
					<button type="button"><a href="about.php">Learn More</a><img src="img/arrow.jpeg"></button> 
				</div>
				<div class="col-2">
				</div>
			</div>
		</div>
		<div id="right" class="all">
			<img src="img/Map.jpg"/>
		</div>
	</div>
	<script type="text/javascript" src="js/menu-width.js">
	</script>
</body>
</html>