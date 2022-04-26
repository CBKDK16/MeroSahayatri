<?php
print_r($_POST);
$conn=new mysqli("localhost","root","","college");
if ($conn) {
	//echo "successfullly connected<br>";
}
else
	echo "Error in connection<br>";
$sql="SELECT * FROM Student";
$result=$conn->query($sql);
$json=array();
if ($result->num_rows>0) {
	while ($row=$result->fetch_array()) {
		$json["data"][]=array("roll"=>$row["Roll"],"name"=>$row["Name"],"address"=>$row["Address"]);
	}
}
echo json_encode($json);
$conn->close();

?>
