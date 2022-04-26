<?php
if(isset($_POST['add']))
{
	$err=[];

	if(isset($_POST['vname']) && !empty($_POST['vname']) && trim($_POST['vname']))
	{
		$vname=trim($_POST['vname']);
	}
	else
	{
		$err['vname']='Enter vehicle type';

	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vehicle Type</title>
</head>
<body>
	<h2>Dashboard users</h2>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<div class="vehicle">
			<label>Vehicle Type</label>
			<br>
			<input type="text" name="vname" value="<?php echo isset ($vname)? $vname:''; ?>">

			<?php if(isset($err['vname']))
			{
				echo $err['vname'];
			}
			?>
		</div>
			<br>
			<button type="submit" value="add">Add</button>
		</div>
	</form>
</body>
</html>