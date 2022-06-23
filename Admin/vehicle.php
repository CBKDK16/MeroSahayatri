<?php
	print_r($_POST);
	//to validate data in vehicle 
	include 'function/validate.php';
	require_once 'function/constant.php';
	$error = [];
	$name = $type = $fromlocation = $tolocation =  $fare = $timeinterval = $available = '';
	if(isset($_POST['addvehicle']))
	{
		if(requireValidation($_POST,'type'))
		{
			$type = $_POST['type'];
		}
		else
		{
			$error['type'] = 'Please Select type';
		}


		//from 

		if(requireValidation($_POST,'fromlocation'))
		{
			$fromlocation = $_POST['fromlocation'];
		}
		else
		{
			$error['fromlocation'] = "Enter location";
		}


		//to

		if(requireValidation($_POST,'tolocation'))
		{
			$tolocation = $_POST['tolocation'];
		}
		else
		{
			$error['tolocation'] = "Enter location";
		}


		//Details
		if(requireValidation($_POST,'fare'))
		{
			$fare = $_POST['fare'];
		}
		else
		{
			$error['fare'] = 'Enter fare.';
		}
		if(requireValidation($_POST,'timeinterval'))
		{
			$timeinterval = $_POST['timeinterval'];
		}
		else
		{
			$error['timeinterval'] = 'Enter timeinterval';
		}
		if(requireValidation($_POST,'available'))
		{
			$available = $_POST['available'];
		}
		else
		{
			$error['available'] = 'Enter available time';
		}


		if(count($error) == 0)
		{
			//insert into database 
			try
			{
				$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
				$sql = "insert into routes_tbl(Vehicle_id,From_id,To_id,Fare,duration,Available)values('$type','$fromlocation','$tolocation','$fare','$timeinterval','$available')";
				if(mysqli_query($connection,$sql))
				{
					$successmsg = 'Vehicle Added Sucessfully';
				}

			}
			catch(Exception $e)
			{
				die('Database error :- ' . $e->getMessage());
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<title>Dashboard</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body> 
    <input type="checkbox" id="menu">
    <nav>
         <label>Mero Sahayatri</label>
        <ul>
            <li>
                <a href="#">Logout</a>
            </li>
        </ul>
         <label for="menu" class="menu-bar"> 
            <i class="fa fa-bars"></i> 
        </label>
    </nav>
    <div class="side-menu">
        <center> <img src="car.jpg">
        <!-- <br><br>-->
            <h2>Admin Page</h2>
        </center>
        <!-- <br>-->
         <?php require "function/menu.php";?>
    </div>
    <div class="data">
    	<div>
				<h2>
					Vehicle
					<?php if(isset($successmsg))
					{
						echo "  -  " .$successmsg ;
					}
					?>
				</h2>
			</div>
			<div id="addvehicleform">
				<?php require_once 'function/add.php' ?>
				<br/>
				<input type="submit" value="Add" name="addvehicle"/>
				</form>
			</div>
     </div>
</body>

</html>

//purano
<!-- <!doctype html>
<html>
	<head>
		<title>Vehicles</title>

		<style>
			*{
				color: rosybrown;
			}
			#back{
				/*background-image: url('img/background.jpg');*/
				height: 750px;
			}
			a{
				color: #fff;
			}
			h1{
				color: #fff;
			}
			div{
				margin: 5px 0px 0px 10px;
			}
			.background
			{
				width: 100%;

				position: fixed;
				bottom: 0;
				left: 0;
				height: 100%;
				z-index: -1;
			}

			
			#addvehicleform{
				margin: 30px;
				color: green;
				background-color:lightgreen ;
			}
		</style>
		<script src="js/jquery.js">
		</script>
		<script type="text/javascript">
			function addMore()
			{
				$('.add:last').clone().insertAfter(".add:last");
			}
			function deleteRow()
			{
				$('.add').each(function(index,item){
					jQuery(':checkbox',this).each(
						function(){
							if($(this).is(':checked'))
							{
								$(item).remove();
							}
						});
				});
			}

			$(document).ready(function(){
				$('#location').change(function(){
					var location = $(this).val();
					$.ajax({
						url:'get_location_list.php',
						data:{'Location_id':location},
						method:'post',
						dataType:'text',
						success:function(response)
						{
							$('#longitude').html(response);
						}
					});
				});
			})
		</script>
	</head>
	<body>
		<img class ="background" src="img/background.jpg"/>
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
				<h2>
					Vehicle
					<?php if(isset($successmsg))
					{
						echo "  -  " .$successmsg ;
					}
					?>
				</h2>
			</div>
			<div id="addvehicleform">
				<?php require_once 'function/add.php' ?>
				<br/>
				<input type="submit" value="Add" name="addvehicle"/>
				</form>
			</div>
		</div>
	</body>
</html> -->