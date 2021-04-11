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
    //Change login credentials below to fit your environment.
    include 'functions.php';
    $login_username = "username";
    $login_password = "password";
    $validation = FALSE;
    ?>

    <h2 class="login_page_title">Hospital Database Login</h2>
    <form class="logform" method="POST">
        <div class="login_container">
            <label for="user"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" require>
            <label for="pass"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="user_password" require>
        </div>
        <div class="form_buttons">
            <button class="login_button" type="submit">Submit</button>
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