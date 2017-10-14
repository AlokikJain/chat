<?php
session_start();
session_destroy();
?>
<?php 
if(isset($_POST['reg']))
{
$user=$_POST['username'];
$pass=$_POST['password'];
}
$servername = "localhost";
$usern = "root";
$passw = "";	
$dbname="chat";
$conn = new mysqli($servername, $usern, $passw,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(!empty($user)&&!empty($pass))
{
$sql1="INSERT INTO login (username,password) VALUES('".$user."','".$pass."')";
if($conn->query($sql1)==TRUE)
{
if(true)
{
	echo '<script language="javascript">';
echo 'alert("USER ID CREATED")';
echo '</script>';
}
else
{	
echo '<script language="javascript">';
echo 'alert("USERNAME EXIST")';
echo '</script>';
}
}
}
?>
<html>
<body style="background-image:url(pexels-photo-110854.jpeg)">

<h2 style="color:#FFF">Register</h2>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
<div class="imgcontainer">
    <img src="User-icon.png" alt="Avatar" class="avatar">
  </div>
<div class="container">
<input type="text" name="username" placeholder="UserName"  required/>
<br>
<input type="text" name="password" placeholder="Password" required />
<br>
<button name="reg" >Register</button>
</div>
</form>
</body>
</html>
<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 40%;
    padding: 12px 20px;
    margin: 8px 400px;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    background-color:#0CC;

}

input[type=text]:hover, input[type=password]:hover {
    width: 40%;
    padding: 12px 20px;
    margin: 8px 400px;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    background-color:#0F9;

}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 580px ;
    border: none;
    cursor: pointer;
    width: 10%;
	float:centre;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 18px 0 10px 0;
}

img.avatar {
    width: 25%;
    border-radius: 25%;
}

img.avatar:hover {
    width: 25%;
    border-radius: 25%;
	opacity:0.7;

}

.container {
    padding: 16px;
	color:#FFF;
	float:centre;
	alignment-adjust:central;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>