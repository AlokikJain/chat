<?php  session_start(); 
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
if(isset($_POST['login']))
{
$usr=$_POST['user'];	
$pass=$_POST["word"];
}
$usr=$_POST['user'];
$_SESSION['name']=$usr;
$sql1="Select username from login where username='".$usr."'";
$sql2="Select password from login where username='".$usr."'";
$check1=$conn->query($sql1);
if ($check1->num_rows > 0) {
    while($row = $check1->fetch_assoc()) {
    $c1=$row["username"];
		}
}
$check2=$conn->query($sql2);
if ($check2->num_rows > 0) {
    while($row2 = $check2->fetch_assoc()) {
    $c2=$row2["password"];
		}
}
if(isset($_POST['reg']))
{
	header("Location:Register.php");
}
if(isset($_POST['login']))   
{
   //$usr = $_POST['user'];
   //  $password = $_POST['word'];
if(!empty($usr)&&!empty($pass)){
      if($usr==$c1&&$pass==$c2)  
         {                                   
		 
          $_SESSION['use']=true;
		  echo "accepted";
       
        }
		
        else
        {
			echo '<script language="javascript">';
            echo 'window.alert("Inavalid Username Or Password")';
             echo '</script>';
        }
}
}
if(isset($_SESSION['use']))  
 {
    header("Location:chatbox.php"); 
 }
?>
<html>
<head>
<title> Login Page </title>
</head>
<body style="background-image:url(pexels-photo-110854.jpeg)">

<h2 style="color:#FFF">Login Form</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST">
<div class="imgcontainer">
    <img src="User-icon.png" alt="Avatar" class="avatar">
  </div>
  <div class="container">
<input type="text" name="user" placeholder="UserName"/>
<br>
<input type="text" name="word" placeholder="Password"/>
<br>
<button name="login" >Login</button>
<button name="reg" onClick="window.location.href='Register.php'" >Register</button>
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


img.avatar:hover {
    width: 25%;
    border-radius: 25%;
	opacity:0.7;

}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 580px;
    border: none;
    cursor: pointer;
    width: 10%;
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
    margin: 18px 0 5px 0;
}

img.avatar {
    width: 25%;
    border-radius: 25%;
}

.container {
    padding: 16px;
	color:#FFF
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