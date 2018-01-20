<?php
    require("layout.php");
    render("header", ["title"=>"Home"]);

    $_SESSION['id'] = '';
    $_SESSION['name'] = '';
    session_destroy();
    flash_message('logout','Successfully logged out');
    echo '<script>location.href="index.php";</script>';

    render("footer");
?>