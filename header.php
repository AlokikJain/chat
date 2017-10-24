<!DOCTYPE html>

<html lang="en">

    <head>

        <!-- https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta -->
        <meta charset="utf-8"/>
        <meta content="initial-scale=1, width=device-width" name="viewport"/>

        <!-- documentation at http://getbootstrap.com/, alternative themes at https://www.bootstrapcdn.com/bootswatch/ -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

        <link href="styles.css" rel="stylesheet"/>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title><?= htmlspecialchars($title) ?></title>

    </head>

    <body>

        <div class="container">
			<!-- start of nav bar -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><span class="blue">home</span></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar">
                        <?php if(!empty($_SESSION['id'])): ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="logout.php">Log Out</a></li>
                            </ul>
                        <?php else: ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="register.php">Register</a></li>
                                <li><a href="login.php">Log In</a></li>
                            </ul>
                        <?php endif ?>
                    </div>
                </div>
            </nav>
			<!-- End of nav bar -->


            <main>

                <!-- Display message -->
                <?php
                    if(isset($_SESSION['message']))
                    {
                        printf("<div class='message %s'>%s</div>", $_SESSION['message']['type'], $_SESSION['message']['message']);
                        unset($_SESSION['message']);
                    }
                ?>