<?php
$name=$_POST['name'];
$address=$_POST['address'];
$conn=new mysqli("localhost","root","","college");
if ($conn->connect_error) {
	die("Connection failed:".$conn->connect_error);
}
$sql="INSERT INTO student(name,address) VALUES ('$name','$address')";
$result=$conn->query($sql);

if ($result>0) 
	echo "Data insert successfully";
else
	echo "Error in insertion data";

$conn->close();
?>
