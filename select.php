<?php 
session_start();
//session_destroy();
?>
<?php
$servername = "localhost";
$usern = "root";
$passw = "";
$dbname="chat";
$conn = new mysqli($servername, $usern, $passw,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql1="Select * from messages";
$check1=$conn->query($sql1);
if ($check1->num_rows > 0) {
    while($row = $check1->fetch_assoc()) {
	
    echo $row["username"]."  ";
	echo ":";
	echo $row["message"]."  "."<br>";
	}
}
?>
