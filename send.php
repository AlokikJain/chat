<?php
session_start();
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
$sessionname=$_SESSION['name'];
$message=$_POST['name1'];
$sql1="INSERT INTO messages (username,message) VALUES('".$sessionname."','".$message."')";
$conn->query($sql1);
?>