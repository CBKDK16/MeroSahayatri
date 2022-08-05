<?php
require "function/constant.php";
$connection =mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$message = [];
if(isset($_COOKIE['username']))
{
	session_start();
	$_SESSION['username'] = $_COOKIE['username'];
	header('location:dashboard.php');
}
try{
	$admins = [];
	$sql = "select * from admin";
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			array_push($admins,$row);
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
		foreach($admins as $key => $admin)
		{
			if($_POST['username']==$admin['username'])
			{
				if( $en_password==$admin['PASSWORD'])
				{
					session_start();
					//store extra data into session
					$_SESSION['username'] =$username;
					$_SESSION['image'] = $admin['image'];

					//check remember
					if(isset($_POST['remember']))
					{
						//setcookie to store cookie value
						setcookie('username',$username,time() + (7*24*60*60));
					}
					//redirect to defined page
					header('location:dashboard.php');
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
	$message['msg'] = 'Please login to continue to dashboard.';
}
if(isset($_GET['msg']) && $_GET['msg'] == 2)
{
	$message['logout'] = 'Logout success.';
}
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/logincss.css?v=<?php echo time() ?>"/>
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
				
			</div>
			
		</form>
	</div>
</body>
</html>