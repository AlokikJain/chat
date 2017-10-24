<?php 
session_start();
?>
<?php
if(isset($_POST['logout']))
{
session_destroy();
header("Location:k.php");
}
if(!isset($_SESSION['name']))
{
header("Location:k.php");
}
/*
$servername = "localhost";
$usern = "root";
$passw = "";
$dbname="chat";
$conn = new mysqli($servername, $usern, $passw,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sessionname=$_SESSION['name'];
$message=$_POST['message'];
$sql1="INSERT INTO messages (username,message) VALUES('".$sessionname."','".$message."')";
if($conn->query($sql1)==true)
{
	echo "message sent";
	echo "<br>";

}*/
?>
<html>
<head>
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>

<style>
.chat
{
background-color:#CCC;
width:100%;
height:400px;
overflow:scroll;
}
.message
{
background-color:#0F6;
width:100%;
height:100px;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 580px ;
    border: none;
    cursor: pointer;
    width: 10%;
}

button:hover {
    opacity: 0.8;
}

</style>
<script type="text/javascript" src="js/jquery-1.10.2.min.js" ></script>
</head>
<body background="pexels-photo-110854.jpeg">
<form method="post">
<button  name="logout" class="logout" >Logout</button>
</form>
<p name="chatroom" class="chat" id="display"></p>
<form method="POST" >
<br>
<input type="text" id="message1" name="message" onKeyUp="loaddata();" onFocus="loaddata();" placeholder="Enter Your Message" class="message"/>
<br>
<button type="submit" id="button" name="reg" style="float:centre" onClick="my()">SEND</button>
</form>

<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script>

function my()
{
var name = document.getElementById("message1").value;
var dataString = 'name1='+name;
$.ajax({
type: "POST",
url: "send.php",
data: dataString,
cache: false,
});
return false;
}
</script>
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  $('#display').animate({
  scrollTop: $('#display').get(0).scrollHeight}, 2000);
});

window.addEventListener("online",function(){loaddata();});

window.addEventListener("focus",function(){loaddata();});

window.addEventListener("mouseover",function(){loaddata();});

function loaddata()
{
	
  $.ajax({
  type: 'post',
  url: 'select.php',
  data: {
  },
  success: function (response) {
   $( '#display' ).html(response);
  }
  });
}

setInterval(function(){
	$.ajax({
			url:'select.php',
			data:{ajaxget:true},
			method:'post',
			success:function(data){
				$('#result').html(response);
			}
	})
},1000);


</script>
</body>
</html>