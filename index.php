<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hospital Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="images/logo.jpg" type="image/jpg" sizes="16x16">
</head>

<body>

    <?php
    //Change login credentials below to fit your environment.
    include 'functions.php';
    $login_username = "root";
    $login_password = "1121";
    $validation = FALSE;
    ?>

    <form class="logform" method="POST">
        <div class="login_container">
            <h2 class="login_page_title">Hospital Database Sign in</h2>
            <input class="login_input" type="text" placeholder="Username" name="username" require>
            <input class="login_input" type="password" placeholder="Password" name="user_password" require>
        </div>
        <div class="form_buttons">
            <button class="login_button" type="submit">Sign in</button>
        </div>
    </form>

    <?php
    // check credentials for login.
    if (isset($_POST['username']) && isset($_POST['user_password'])) {
        if ($_POST['username'] == $login_username && $_POST['user_password'] == $login_password) {
            $_SESSION['validation'] = $validation = TRUE;
            $_SESSION['username'] = "$login_username";
            header("Location: employees.php");
        } else {
            echo '<p class="wrong">Wrong Username/Password</p>';
        }
    }
    ?>
</body>

</html>