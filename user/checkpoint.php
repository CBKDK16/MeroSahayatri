<?php
	$id = $_GET['id'];
	require_once 'function/check_session.php';
	require 'function/constant.php';
	require 'function/validate.php';
	$error = [];
	$checkpointlocation = '';
	try{
		//grab data from database of checkpoint_tbl
		$sql_checkpoint = "select * from checkpoint_tbl c1 Inner join location_tbl using(location_id) where route_id = $id";
		//execute query
		$result_checkpoint = mysqli_query($con,$sql_checkpoint);
		//check the no. of rows available in database
		$checkpoint = [];
		if(mysqli_num_rows($result_checkpoint)>0)
		{
			//Fetches one row of data from the result set and returns it as an associative array
			while($row_checkpoint = mysqli_fetch_assoc($result_checkpoint))
			{
				array_push($checkpoint,$row_checkpoint);
			}
		}
	}
	catch(Exception $e)
	{
		echo false;
	}
?>

<!DOCTYPE html>
<html>
<title>Checkpoint</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/all.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body> 
    <input type="checkbox" id="menu">
    <nav>
         <label>Mero Sahayatri</label>
        <ul>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>
         <label for="menu" class="menu-bar"> 
            <i class="fa fa-bars"></i> 
        </label>
    </nav>
    <div class="side-menu">
        <center> 
        	<img src="img/<?=$_SESSION['image']?>">
        <!-- <br><br>-->
            <h2>
                <?php
                    echo $_SESSION['username'];
                ?>
            </h2>
        </center>
         <?php require "function/menu.php";?>
    </div>
    <div class="data">
    	<div>
				<h2>Route - Checkpoint</h2>
			</div>
			<div id="addvehicleform">
					
					<div id="table_list">
						<table border="1px">
							<tr>
								<td>S.N</td>
								<td>Name</td>
								<td>Longitude </td>
								<td>Latitude</td>
								<td>Action</td>
							</tr>
							<?php foreach ($checkpoint as $key => $cp) {?>
							<tr>
								<td>
									<?php echo $key+1?>
								</td>
								<td>
									<?php echo $cp['Name']?>
								</td>
								<td>
									<?php echo $cp['Longitute']?>
								</td>
								<td>
									<?php echo $cp['Latitude']?>
								</td>
								<td>
									<a href="delete_checkpoint.php?id=<?php echo $cp['CHECKPOINT_id']?>">Delete</a>
								</td>
							</tr>
							<?php }?>
						</table>
					</div>
				</form>	
     </div>
</body>

</html>