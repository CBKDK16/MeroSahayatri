<?php
	require_once "function/check_session.php";
	$users =[];
	require_once 'function/constant.php';
	$connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$select = "SELECT * from user";
	$result = mysqli_query($connection,$select);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			array_push($users,$row);
		}
	}
?>
<!DOCTYPE html>
<html>
<title>Users</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/all.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body> 
    <input type="checkbox" id="menu">
    <nav>
         <label id="header">Mero Sahayatri - Admin</label>
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
        <center> <img src="img/<?=$_SESSION['image']?>">
        <!-- <br><br>-->
            <h2>
            	<?php echo $_SESSION['username'];?>
            </h2>
        </center>
        <!-- <br>-->
         <?php require "function/menu.php";?>
    </div>
    <div class="data">
    	<div>
				<h2>Users</h2>
			</div>
			<div>
				<table border="1px">
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Gender</th>
						<th>Phone no.</th>
						<th>Country</th>
						<th>Action</th>
					</tr>
					<?php foreach($users as $key => $user) {?>
					<tr align="center">
						<td><?php echo $key+1?></td>
						<td align="left">
							<img src="../user/img/<?=$user['image']?>" width="50px">

							<?php echo $user['name']?>
							
						</td>
						<td><?php echo $user['username']?></td>
						<td><?php echo $user['email']?></td>
						<td><?php echo $user['gender']?></td>
						<td><?php echo $user['phone']?></td>
						<td><?php echo $user['country']?></td>
						<td>
							<?php 
								$action = $user['status'];
								if($action == 1)
								{
									echo "<p><a href='action.php?id=".$user['id']."&status=0'>Enable</a></p>";
								}
								else
								{
									echo "<a href='action.php?id=".$user['id']."&status=1'>Diable</a>";
								}
							?>
							
						</td>
					</tr>
				<?php }?>
				</table>
			</div>
     </div>
</body>

</html>
