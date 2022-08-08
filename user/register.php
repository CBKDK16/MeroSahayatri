<?php
	if(isset($_COOKIE['username']))
	{
		session_start();
		$_SESSION['username'] = $_COOKIE['username'];
		header('location:dashboard.php');
	}						
	require 'function/constant.php';
	require 'function/validate.php';
	$error = [];
	$connection = mysqli_connect('localhost','root','','merosahayatri_db');
	
	$name = $username =$repassword = $password = $gender = $country = $phone = $image = $email = '';

	try{
		$sql_admin = "select username from user";
		$result = mysqli_query($connection,$sql_admin);
		$username_db = [];
		if(mysqli_num_rows($result)>0)
		{
			while ($row = mysqli_fetch_assoc($result)) {
				array_push($username_db,$row);
			}
		}

	}
	catch(Exception $e)
	{

	}
	if(isset($_POST['btnregister']))
	{
		//validate name
		if(requireValidation($_POST,'name'))
		{
			$name = $_POST['name'];
		}
		else
		{
			$error['name'] = 'Enter name';
		}

		//validate username
		if(requireValidation($_POST,'username'))
		{
			$username = $_POST['username'];
			$ulength = strlen($username);
			if($ulength<8)
			{
				$error['username'] = 'username should be minimum 8 character.';
			}
			
				foreach($username_db as $key => $user)
				{
					if($user['username'] == $username)
					{
						$error['username'] = "Username already taken";
					}
				}
			
		}
		else
		{
			$error['username'] = 'Username is required';
		}
		
		//validate password
		if(requireValidation($_POST,'password'))
		{
			$password = $_POST['password'];
			if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@*#$%]{8,12}$/',$password))
			{
				$error['password'] = "Password don't meet requiement!";
			}
		}
		else
		{
			$error['password'] = 'Password is required';
		}

		//validate repassword
		if(requireValidation($_POST,'repassword'))
		{
			$repassword = $_POST['repassword'];
			if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@*#$%]{8,15}$/',$repassword))
			{
				$error['repassword'] = "Password don't meet requiement!";
			}
		}
		else
		{
			$error['repassword'] = 'Password is required';
		}

		//validate email
		if(requireValidation($_POST,'email'))
		{
			$email = $_POST['email'];
			if(!preg_match("/^[\w.+\-]+@gmail\.com$/",$email))
			{
				$error['email'] = "Email in proper format.";
			}
		}
		else
		{
			$error['email'] = 'Enter email';
		}
		
		//validate image
		if(isset($_FILES['image']) && !empty($_FILES['image']['name']))
		{
			$img_name = $_FILES['image']['name'];
			$img_size = $_FILES['image']['size'];
			$tmp_name = $_FILES['image']['tmp_name'];
			$err = $_FILES['image']['error'];

			//error check
			if($err == 0)
			{
				if($img_size<125000)
				{
					$img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
					$img_ex_lc = strtolower($img_ex);

					$allowed_exs = array("jpg","jpeg","png");

					if(in_array($img_ex_lc,$allowed_exs)){
						$new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
						$img_upload_path = 'img/'.$new_img_name;
						move_uploaded_file($tmp_name,$img_upload_path);
					}
					else{
						$error['image'] = "You can't upload files of this type.";
					}

				}
				else{
					$error['image'] = "Sorry, your file is too large.";
				}
			}
			else{
				$error['image'] = "unknown error occurred!";
			}
		}
		else
		{
			$error['image'] = 'Choose image';
		}
		
		//validate gender
		if(requireValidation($_POST,'gender'))
		{
			$gender = $_POST['gender'];
		}
		else
		{
			$error['gender'] = 'Choose gender';
		}
		
		//validate country
		if(requireValidation($_POST,'country'))
		{
			$country = $_POST['country'];
		}
		else
		{
			$error['country'] = 'Select country';
		}
		
		//validate number
		if(requireValidation($_POST,'number'))
		{
			$number = $_POST['number'];
			if(!preg_match("/^([0-9]{10})$/",$number)){
				$error['number'] = "Invalid phone number.";
			}
		}
		else
		{
			$error['number'] = 'Phone number is required.';
		}
		
		if(count($error) == 0)
		{
			
			if($password != $repassword)
			{
				$error['password'] = "password don't match";
				$error['repassword'] = "password don't match";
			}
			else
			{
				try{
					$sql = "insert into user(name,username,email,password,gender,country,phone,image)values('$name','$username','$email',md5('".$password."'),'$gender','$country','$number','$new_img_name')";
					if(mysqli_query($connection,$sql))
					{
						$successmsg = "Register sucessfully";
						header("location:login.php?msg=3");
					}
				}
				catch(Exception $e)
				{
					die('Database error:- '.$e->getMessage());
				}
			}
		}
		else
		{
			$failed = "Please Fill up required fields.";
		}	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/register.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body> 
     <div id = "container-user">
     	<div id="info_ms">
     		<h2>Meroshayatri</h2>
     		<p>
     			Mero Sahayatri is create an e-information about Transportion systems and automate the process of searching for vehicles to reach in time.
     		</p>

     		<div id="login">
     			<a href="login.php">Already have an Account?</a>

     		</div>
     	</div>

     	<div id="register">
     		<div id="header">
     				<h2>
						User - Registeration
						<?php 
							if(isset($successmsg))
							{
								echo " - " .$successmsg;
							}
							else if (isset($failed)) {
								echo " - " . $failed;
							}
							else
							{
								
							}
						?>
					</h2>
     		</div>
     		<div id="register_form">
     		<form method= "post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype=
						"multipart/form-data">
				<!-- <fieldset>
				<legend>Register Form</legend> -->
				<div id="form_all">
		     		<div id="f_row" class="form">
		     			<div class="box">
							<label>Full Name</label>
							<input type="text" name="name" placeholder="Enter full name." value="<?php echo $name?>"/>
							<?php echo "<p class = 'error'>" . displayError($error,'name'). "</p>";?>
						</div>
						<div class="box">
							<label>Username</label>
							<input type="text" placeholder="Enter username" name="username" value="<?php echo $username?>"/>
							<?php echo "<p class = 'error'>" .displayError($error,'username'). "</p>";?>
						</div>
		     		</div>

		     		<div id="s_row" class="form">
		     			<div class="box">
		     				<label>Password</label>
		     				<input type="text" name="password" placeholder="eg:- Apple*123#" value="<?php echo $password?>"/>
							<?php echo "<p class = 'error'>" . displayError($error,'password'). "</p>";?>
		     			</div>
		     			<div class="box">
		     				<label>Confirm Password</label>
		     				<input type="text" name="repassword" placeholder="eg:- Apple*123#" value="<?php echo $repassword?>"/>
							<?php echo "<p class = 'error'>" . displayError($error,'repassword'). "</p>";?>
		     			</div>
		     		</div>
		     		
		     		<div id="t_row" class="form">
		     			<div class="box emails">
		     				<label>Email</label>
		     				<div class="email">
		   		  				<input type="email" placeholder="eg:. name1@gmail.com" name="email"  value="<?php echo $email?>"/>
								<?php echo "<p class = 'error'>" . displayError($error,'email'). "</p>";?>
							</div>
		     			</div>
		     		</div>
		     		
		     		<div id="f_row" class="form">
		     			<div class="box">
		     				<label>Image</label>
		     				<input type="file" name="image"  value="<?php echo $image?>"/>
							<?php echo "<p class = 'error'>" . displayError($error,'image'). "</p>";?>
		     			</div>
		     			<div class="box">
		     				<label>Phone no.</label>
		     				<input type="number" placeholder="98********" name="number" value="<?php echo $number?>"/>
							<?php echo "<p class = 'error'>" . displayError($error,'number'). "</p>";?>
		     			</div>
		     		</div>
		     		
		     		<div id="fi_row" class="form">
		     			<div class="box">
		     				<label>Gender</label>
		     				<div class="inline input">
			     				<input type="radio" name="gender" value="M">Male
								<input type="radio" name="gender" value="F">Female
								<input type="radio" name="gender" value="O">Other
							</div>
							<?php echo "<p class = 'error'>" . displayError($error,'gender'). "</p>";?>
		     			</div>
		     			<div class="box">
		     				<label>Country</label>
		     				<select name="country">
								<option value="">Select Country</option>
								<option value="nepal">Nepal</option>
								<option value="china">China</option>
								<option value="india">India</option>
							</select>
							<?php echo "<p class = 'error'>" . displayError($error,'country'). "</p>";?>
		     			</div>
		     		</div>
		     		
		     		<div id="si_row" class="form">
		     			
		     		</div>
		     		
		     		<div id="ei_row" class="form">
		     			<div class="box submit">
		     				<input type="submit" name="btnregister" value="Register"/>
		     			</div>
	     			</div>
				</div>
				</fieldset>
	     	</form>
     		
     	</div>
     </div>
</body>

</html>
