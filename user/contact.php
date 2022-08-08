
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/contact.css?v=<?php echo time();?>">
	<link rel="stylesheet" type="text/css" href="css/all.css?v=<?php echo time();?>">
	<title>Contact Us</title>
</head>
<body>
	<?php
		require_once "function/check_session.php";
		require_once "function/nav.php";
	?>
	<div id="container">
		<div id="left">
			<img src="img/bus.jpg">
		</div>
		<div id="right">
			<div id="intro" class="all">
				<div id="about" class="all">
					<h2 class="about-body">Contact:</h2>
					<h4>Opening Hours</h4>
					<p class="about-body">Mon-Fri : 8am-9pm <br/>
					Sat and Sun : 6am-10pm</p>
					
					<br>
					<h4>Phone Number</h4>
					<a href="tel:+9779857642886">9857642886</a>
					<a href="tel:+9779805266925">9805266925</a>
					<br/><br/>
					<h4>Location</h4>
					<p class="about-body">Lalitpur ward No.1, patan dhoka, patan multiple campus, Nepal</p>
				</div>
			<div id="social-icon">
				<a href=".html"><img src="img/fb.jpeg"></a>
				<a href=".html"><img src="img/insta.jpeg"></a>
				<a href=".html"><img src="img/twitter.jpeg"></a>
				<a href=".html"><img src="img/email.jpeg"></a>
			</div>
		</div>
		</div>
	</div>
	<script type="text/javascript" src="js/menu-width.js">
	</script>
</body>
</html>
