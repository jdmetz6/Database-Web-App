<?php
session_start();
include 'functions.php';
logout_button();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title id="title">Hospital</title>
    <!-- Function to change browser tab title for each page. -->
    <script>
        function title() {
            document.getElementById("title").innerHTML = document.getElementById("tab_title").innerText;
        }
    </script>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" href="images/logo.jpg" type="image/jpg" sizes="16x16">
</head>

<body>
    <!-- Menu bar for top of page. -->
    <div class="menuBar">
        <div class="logo_box">
            <a href="employees.php"><img class="logo" src="images/logo.jpg" alt="heart"></a>
        </div>
        <div class="tabs">
            <button class="tablinks" onclick="window.location.href='employees.php';">Employees</button>
            <button class="tablinks" onclick="window.location.href='patients.php';">Patients</button>
            <button class="tablinks" onclick="window.location.href='appointments.php';">Appointments</button>
            <button class="tablinks" onclick="window.location.href='occupied_rooms.php';">Rooms</button>
            <button class="tablinks" onclick="window.location.href='medication.php';">Medication</button>
        </div>
        <div class="login_as">
            <p>Signed in as: <?php echo '       ';
                                print($_SESSION['username']); ?></p>
        </div>
        <div class="help">
            <a class="help_link" href="https://github.com/jdmetz6/Database-Web-App/wiki" target="_blank"> Help</a>
        </div>
        <form method="POST">
            <button class="log_out_button" type="submit" name="logout">Sign out</button>
        </form>
    </div>