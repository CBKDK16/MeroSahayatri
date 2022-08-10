<?php 
	session_start();
	if(!$_SESSION['user'] || !$_SESSION['image_user'])
	{
		header('location:login.php?msg=1');
	}	
?>