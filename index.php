<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hospital Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'functions.php';
    $servername = "localhost";
    $username = "root";
    $password = "1121";
    $validation = FALSE;
    if (isset($_POST['user']) && isset($_POST['pass'])) {
        login($_POST['user'], $_POST['pass'], $servername, $username, $password, $validation);
    }
    ?>
    <h2 class="page_title">Hospital Database Login</h2>
    <form class="logform" method="POST">
        <div class="container">
            <label for="user"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="user" require>
            <label for="pass"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pass" require>
            <button class="login_button" type="submit">Submit</button>
        </div>
    </form>
</body>

</html>