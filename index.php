<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hospital Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
        $servername = "localhost";
        $username = "jdm";
        $password = "1121";
        $validation = FALSE;
        
        // Validate & Login 
        function login($user, $pass, $username, $password, $validation)
        {
            if ($username != $user || $password != $pass)
            { 
                echo '<p class="wrong">Wrong Username/Password</p>';
            } else {
                $validation = TRUE;
                $_SESSION['user'] = "$username";
                $_SESSION['pass'] = "$password";
                $_SESSION['vali'] = "$validation";
                header("Location: employees.php");
            }
            return 0;
        }
        //check if username and password are set
        function check_auth_set($user, $pass, $username, $password, $validation)
        {
            if (isset($user) && isset($pass))
            {
                login($user, $pass, $username, $password, $validation);
            }
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
    <?php
        check_auth_set($_POST['user'], $_POST['pass'], $username, $password, $validation);
    ?>

</body>

</html>
