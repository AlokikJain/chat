<?php require("layout.php"); ?>

<?php render("header", ["title"=>"Home"]); ?>

<?php

	// if the user hadn't login
	if(empty($_SESSION['id']))
	{
		echo "<script>location.href='login.php';</script>";
	}

	/**
	 * Display the chatbox
	 */

	require("dbconfig.php");

	// Create connection
	$conn = new mysqli($host, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	if(isset($_POST['reg']))
	{
		$sessionname=$_SESSION['name'];
		$message=$_POST['message'];
		$sql1="INSERT INTO messages (username,message) VALUES('".$sessionname."','".$message."')";
		if($conn->query($sql1)==true)
		{
			echo "message sent";
			echo "<br>";
		}
	}

?>

<script type="text/javascript" src="js/jquery-1.10.2.min.js" ></script>

<!-- Dispaly the message, just next line only -->
<p name="chatroom" class="chat" id="display"></p> 

<form onsubmit="return loaddata();" method="post">
    <fieldset>
    	<br>
        <div class="form-group">
            <input type="text" name="message" onkeyup="loaddata();" onfocus="loaddata();" placeholder="Enter Your Message" class="form-group"/>
        </div>

        <div class="form-group">
            <button class="btn btn-default" name="reg" type="submit">Send</button>
        </div>

    </fieldset>
</form>







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
},200);


</script>


<?php render("footer"); ?>
