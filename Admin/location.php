<?php
print_r($_POST);
	require 'function/validate.php';
	require 'function/constant.php';
	$error = [];
	$location = $longitude = $latitude ='';
	if(isset($_POST['addLocation']))
	{
		if(requireValidation($_POST,'location'))
		{
			$location = $_POST['location'];
		}
		else
		{
			$error['location'] = 'Enter location.';
		}

		if(requireValidation($_POST,'longitude'))
		{
			$longitude = $_POST['longitude'];
		}
		else
		{
			$error['longitude'] = 'Enter longitude';
		}

		if(requireValidation($_POST,'latitude'))
		{
			$latitude = $_POST['latitude'];
		}
		else
		{
			$error['latitude'] = 'Enter latitude';
		}

		//database connection
		if(count($error) == 0)
		{
			echo 'manish';
			try
			{
				$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
				$sql = "insert into location_tbl(Name,latitude,longitute)
				values('$name','$latitude','$longitude')";

				//query execution
				if(mysqli_query($connection,$sql))
				{
					$successmsg="location add successfully";
				}
			}
			catch(Exception $e)
			{
				die('Database error:- '.$e->getMessage());
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Vehicles</title>
		<style>
			*{
				
				box-sizing;border-box;
			}
			body{
				overflow: hidden;
				color: white;
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
			
		</style>
		<script type="text/javascript" src="js/jquery.js"></script>
		<!-- <script type="text/javascript">
			function addMore()
			{
				$(".clonelocation:last").clone().insertAfter(".clonelocation:last");
			}
			function deleteRow()
			{
				$(".clonelocation").each(function(index,item)
				{
					jQuery(':checkbox',this).each(function()
					{
						if($(this).is(':checked'))
						{
							$(item).remove();
						}
					});
				});
			}
		</script> -->
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
				<?php if(isset($successmsg)){?>
					<p class = "success" ><?php echo $successmsg ?></p>
				<?php }?>
			</div>
			<div>
				<div>
					<h2>Location</h2>
				</div>
				<hr/>
				<div style="background:grey;">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
						<div class="clonelocation">
							<div>
								<input type="checkbox" name="check"/>
							</div>
							<div>
								<label for="location">Location</label>
								<input type="text" name="name" value="<?php echo $location ?>"/>
								<?php echo displayError($error,'location'); ?>
							</div>
							<div>
								<label for="longitude">Longitude</label>
								<input type="text" name="longitude" value="<?php echo $longitude ?>"/>
								<?php echo displayError($error,'longitude');?>
							</div>
							<div>
								<label for="latitude">Latitude</label>
								<input type="text" name="latitude" value="<?php echo $latitude ?>"/>
								<?php echo displayError($error,'latitude');?>
							</div>
						</div>
						<div>
							<input type="button" name="add_item" value="Add More " onclick="addMore()"/>
							<input type="button" name="add_item" value="Delete" onclick="deleteRow()"/>
						</div>
						<div>
							<input type="submit" value="ADD" name="addLocation"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>