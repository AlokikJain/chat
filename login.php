<?php require("layout.php"); ?>

<?php render("header", ["title"=>"Login"]); ?>

<?php

	// if someone is already logged in then redirect
	if (!empty($_SESSION['id'])){
		flash_message('OOPS!','Already logged in');
		echo "<script>location.href='index.php';</script>";
	}

	// for the form's data processing
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// ensure user co-operated
		if(!empty($_POST['username'])&&!empty($_POST['password']))
		{
			/** ensure user is there in database  */

			require("dbconfig.php");

			// Create connection
			$conn = new mysqli($host, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			// for any creepy thing  https://www.w3schools.com/php/php_form_validation.asp
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			$username = test_input($_POST["username"]);

			// Querying the database
			$username = $username;
			$password = crypt($_POST["password"], 50);

			$sql = 'SELECT * FROM users where uname = "'.$username. '" AND hash = "'.$password.'"';
			$result = $conn->query($sql);

			// if the data is fake
			$data = $result->fetch_assoc();
			if (empty($data)){
				echo '<script language="javascript">';
            	echo 'window.alert("Invalid Username Or Password")';
            	echo '</script>';
			}

			// all goes well then
			$_SESSION['id'] = $data['id'];
			$_SESSION['name'] = $data['uname'];
			echo "<script>location.href='index.php';</script>";
		}
		// if something goes invalid
        else
        {
			echo '<script language="javascript">';
            echo 'window.alert("Invalid Username Or Password")';
            echo '</script>';
        }
	}
?>

<!-- html for the login form  -->
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="username" placeholder="Username" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="password" placeholder="Password" type="password"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" name="login" type="submit">Log In</button>
        </div>
		<div class="form-group">
            <br> or a new user <a href="register.php">Register</a>?
        </div>
    </fieldset>
</form>

<?php render("footer"); ?>