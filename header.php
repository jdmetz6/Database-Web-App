<?php session_start();
include 'functions.php';
logout_button();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="menuBar">
        <button class="tablinks" onclick="window.location.href='employees.php';">Employees</button>
        <button class="tablinks" onclick="window.location.href='patients.php';">Patients</button>
        <button class="tablinks" onclick="window.location.href='appointments.php';">Appointments</button>
        <button class="tablinks" onclick="window.location.href='occupied_rooms.php';">Rooms</button>
        <form class="logout_box" method="POST">
            <button class="logout_button" type="submit" name="logout">Logout</button>
        </form>
        <p class="login_as">Logged in as: <?php echo '       ';
                                            print($_SESSION['user']); ?></p>
        <a class="help" href="https://github.com/jdmetz6/Database-Web-App/wiki" target="_blank"> Help</a>
    </div>