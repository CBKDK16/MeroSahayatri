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
			$error['repassword'] = 'Enter pervious to confirm.';
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
<title>Register</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body> 
    <div class="data">
    	<div>
					<h2>
						User - Register
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
				<div>
					<form method= "post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype=
						"multipart/form-data">
						<table>
							<tr>
								<td>Name</td>
								<td>
									<input type="text" name="name" value="<?php echo $name?>"/>
								</td>
								<td> 
									<?php echo "<p class = 'error'>" . displayError($error,'name'). "</p>";?>
								</td>
							</tr>
							<tr>
								<td>Username</td>
								<td>
									<input type="text" name="username"  value="<?php echo $username?>"/>
								</td>
								<td> 
									<?php echo "<p class = 'error'>" . displayError($error,'username'). "</p>";?>
								</td>
							</tr>
							<tr>
								<td>Password</td>
								<td>
									<input type="text" name="password" value="<?php echo $password?>"/>
								</td>
								<td> 
									<?php echo "<p class = 'error'>" . displayError($error,'password'). "</p>";?>
								</td>
							</tr>
							<tr>
								<td>Confirm Password</td>
								<td>
									<input type="text" name="repassword" value="<?php echo $repassword?>"/>
								</td>
								<td> 
									<?php echo "<p class = 'error'>" . displayError($error,'repassword'). "</p>";?>
								</td>
							</tr>
							<tr>							
								<td>email</td>
								<td>
									<input type="email" name="email"  value="<?php echo $email?>"/>
								</td>
								<td> 
									<?php echo "<p class = 'error'>" . displayError($error,'email'). "</p>";?>
								</td>
							</tr>
							<tr>
								<td>Image</td>
								<td>
									<input type="file" name="image"  value="<?php echo $image?>"/>
								</td>
								<td> 
									<?php echo "<p class = 'error'>" . displayError($error,'image'). "</p>";?>
								</td>
							</tr>
							<tr>
								<td>Gender</td>
								<td>
									<input type="radio" name="gender" value="M">Male
									<input type="radio" name="gender" value="F">Female
									<input type="radio" name="gender" value="O">Other
								</td>
								<td> 
									<?php echo "<p class = 'error'>" . displayError($error,'gender'). "</p>";?>
								</td>
							</tr>
							<tr>
								<td>Country</td>
								<td>
									<select name="country">
										<option value="">Select Country</option>
										<option value="nepal">Nepal</option>
										<option value="china">China</option>
										<option value="india">India</option>
									</select>
								</td>
								<td> 
									<?php echo "<p class = 'error'>" . displayError($error,'country'). "</p>";?>
								</td>
							</tr>
							<tr>
								<td>Phone No.</td>
								<td>
									<input type="number" name="number" value="<?php echo $number?>"/>
								</td>
								<td> 
									<?php echo "<p class = 'error'>" . displayError($error,'number'). "</p>";?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="checkbox" name="termsandconditions"/>Terms and Conditions
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" name="btnregister" value="Register"/>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<a href="login.php">Already have an Account?</a>
								</td>
							</tr>
						</table>
					</form>
				</div>
     </div>
</body>

</html>
