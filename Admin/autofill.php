<?php

$name = $_GET['name'];
$return = mysql_query("SELECT * FROM users WHERE username = '$name' LIMIT 1");
$rows = mysql_fetch_array($return);
$formattedData = json_encode($rows);
print $formattedData;
	?>