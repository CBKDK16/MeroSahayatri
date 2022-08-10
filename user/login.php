<?php
session_start();
if (isset($_SESSION['user'])) {
	header('location:home.php');
}
require "function/constant.php";
$connection =mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$message = [];
if(isset($_COOKIE['user']))
{
	session_start();
	$_SESSION['user'] = $_COOKIE['user'];
	header('location:home.php');
}
try{
	$users = [];
	$sql = "select * from user";
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			array_push($users,$row);
		}
	}
}
catch(Exception $e)
{

}
if (isset($_POST['login'])){
	$err=[];

	//Validation Username

	if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username']))
	{
		$username= $_POST['username'];
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
		$pass = $_POST['password'];
		$en_password = md5($pass);
		foreach($users as $key => $user)
		{
			if($_POST['username']==$user['username'])
			{
				if( $en_password==$user['PASSWORD'])
				{
					if($user['status'] == 1)
					{
						session_start();
						//store extra data into session
						$_SESSION['user'] =$username;
						$_SESSION['image_user'] = $user['image'];

						//check remember
						if(isset($_POST['remember']))
						{
							//setcookie to store cookie value
							setcookie('username',$username,time() + (7*24*60*60));
						}
						//redirect to defined page
						header('location:home.php');
					}
					else{
						$message['disable'] ="Your account is Deactived.</br>";
					}
				}
				else{
					$error['password'] = "Invalid Password.";
				}
				
			}
			else
			{
				$error['username'] = "Invalid username.";
			}
		}
		$message['login'] = "Login failed!";
		
	}
}

if(isset($_GET['msg']) && $_GET['msg'] == 1)
{
	$message['msg'] = 'Please login to continue to dashboard';
}
if(isset($_GET['msg']) && $_GET['msg'] == 2)
{
	$message['logout'] = 'Logout success';
}
if(isset($_GET['msg']) && $_GET['msg'] == 3)
{
	$message['register'] = 'Register successful';
}
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/logincss.css?v=<?php echo time();?>"/>
</head>
<body>
	<div id = "block">
		<h1 align="center">Hello,</h1>
		<h2 align="center">Sign to Continue...</h2>
		<div align="center">
					<?php 
						if(isset($message))
						{
							foreach($message as $value){
								echo $value;
							}
							
						}
					?>
		</div>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<div class="new">
				<div class="input">
					<label>Username:</label>
					<input type="text" name="username" placeholder="Enter Your Username" value="<?php echo isset ($username)? $username:''; ?>">
					<?php if (isset($err['username']))
					{
						echo $err['username'];
					} ?>
				</div>
				<div class="input">
					<label>Password:</label>
					<input type="Password" name="password" placeholder="Enter your Password">
					<?php if (isset($err['password']))
					{
						echo $err['password'];
					}
					?>
				</div>
				<div id= "remember">
					<input type="checkbox" name="remember" value="remember">Remember me<br/>
				</div>
				<div>
					<button type="submit" name="login">Login</button>
				</div>
				<a href="register.php" align="">Create a new account.</a>
			</div>
			
		</form>

	</div>
</body>
</html>