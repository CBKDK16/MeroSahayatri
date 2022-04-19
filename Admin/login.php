<?php

if (isset($_POST['login'])){
	$err=[];

	//Validation Username

	if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username']))
	{
		$username= trim($_POST['username']);
		if (strlen($username) <8){
			$err['username'] = 'Enter valid length: 8 Character';
		}
	}
	else{
		$err['username'] = 'Enter Username';
	}
	//Validation Password
	if (isset($_POST['password']) && !empty($_POST['password'])){
		$password=$_POST['password'];
	}
	else{
		$err['password'] = 'Enter Password.';
	}
	if(count($err)==0)
	{
		if($_POST['username']=='manishkhadka' && $_POST['password']=='manish123')
		{
			header('location:dashboard.php');
		}
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
</head>
<body>
	<h1>Hello,</h1>
	<h2>Sign to Continue...</h2>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
		<div class="new">
			<div>
				<label>Username:</label>
				<input type="text" name="username" placeholder="Enter Your Username" value="<?php echo isset ($username)? $username:''; ?>">
				<?php if (isset($err['username']))
				{
					echo $err['username'];
				} ?>
			</div>
			<div>
				<label>Password:</label>
				<input type="Password" name="password" placeholder="Enter your Password">
				<?php if (isset($err['password']))
				{
					echo $err['password'];
				}
				?>
			</div>
			<div>
				<input type="checkbox" name="remember" value="remember">Remember me<br/>
			</div>
			<div>
				<button type="submit" name="login">Login</button>
			</div>
		</div>
		
	</form>

</body>
</html>