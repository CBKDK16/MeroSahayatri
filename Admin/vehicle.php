<?php
	require 'function/validate.php';
	$error = [];
	$name = $type = $fromlocation =$fromlongitude = $fromlatitude = $tolocation = $tolongitude = $tolatitude = $fare = $timeinterval = $available = '';
	if(isset($_POST['addvehicle']))
	{
		//vechicle
		if(requireValidation($_POST,'name'))
		{
			$name = $_POST['name'];
		}
		else
		{
			$error['name'] = 'Please enter name';
		}

		if(requireValidation($_POST,'type'))
		{
			$type = $_POST['type'];
		}
		else
		{

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

		if(requireValidation($_POST,'fromlongitude'))
		{
			$fromlongitude = $_POST['fromlongitude'];
		}
		else
		{
			$error['fromlongitude'] = 'Enter Longitude';
		}

		if(requireValidation($_POST,'fromlatitude'))
		{
			$fromlatitude = $_POST['fromlatitude'];
		}
		else
		{
			$error['fromlatitude'] = 'Enter Longitude';
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

		if(requireValidation($_POST,'tolongitude'))
		{
			$tolongitude = $_POST['tolongitude'];
		}
		else
		{
			$error['tolongitude'] = 'Enter Longitude';
		}

		if(requireValidation($_POST,'tolatitude'))
		{
			$tolatitude = $_POST['tolatitude'];
		}
		else
		{
			$error['tolatitude'] = 'Enter Longitude';
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
	}
?>
<!doctype html>
<html>
	<head>
		<title>Vehicles</title>
		<style>
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
				background-color:#fff ;
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
				<h2>Vehicle</h2>
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