<?php require("layout.php"); ?>

<?php render("header", ["title"=>"Register"]); ?>

<?php

	// if someone is already logged in then redirect
	if (!empty($_SESSION['id'])){
		echo "<script>location.href='index.php';</script>";
	}

	// form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{

		// ensure user co-operated
		if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['re_password']))
		{
			/** entering the new user into database  */

			require("dbconfig.php");

			// connecting to the database
			try {
			    $conn = mysqli_connect($host, $username, $password, $dbname);
				//echo "Connected to $dbname at $host successfully.";
			} catch (PDOException $pe) {
				die("Could not connect to the database:" . $pe->getMessage());
			}

			// for any creepy thing  https://www.w3schools.com/php/php_form_validation.asp
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			$username = test_input($_POST["username"]);

			// ensuring both password are same
			if($_POST['password'] != $_POST['re_password']){
			    echo '<script language="javascript">window.alert("Password doesn\'t match")</script>';
			}

			// Querying the database
			$password = crypt($_POST["password"],50);

            // ensure its a unique username
			$sql = 'SELECT uname FROM users';
			if ($r=mysqli_query($conn, $sql)) {
            } else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    		echo "<script>location.href='index.php';</script>";
			}

			while($n = mysqli_fetch_assoc($r)){
		        if($n['uname'] == $username){
	    		     echo '<script language="javascript">';
                 	 echo 'window.alert("Username already exists...try other names")';
                	 echo '</script>';
	    		    }
	    	}

            // saving it to db  "SQL INJECTION PRONE!"
            $sql = 'INSERT INTO users (uname, hash) VALUES ("'.$username.'","' .$password.'")';
            if (mysqli_query($conn, $sql)) {
    			$last_id = mysqli_insert_id($conn);
			} else {
    			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

			// all goes well then
			mysqli_close($conn);
			$_SESSION['id'] = $last_id;
			$_SESSION['name'] = $username;
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
            <input class="form-control" name="re_password" placeholder="Confirm Password" type="password"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" name="login" type="submit">Register</button>
        </div>
    </fieldset>
</form>

<?php render("footer"); ?>