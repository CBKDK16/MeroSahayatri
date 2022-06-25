<?php 
	session_start();
	if(!$_SESSION['username'] && !$_SESSION['image'])
	{
		header('location:login.php?msg=1');
	}	
?>