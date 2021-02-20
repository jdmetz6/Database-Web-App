<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Appointments</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="menuBar">
        <button class="tablinks" onclick="window.location.href='employees.php';">Employees</button>
        <button class="tablinks" onclick="window.location.href='patients.php';">Patients</button>
        <button class="tablinks" onclick="window.location.href='appointments.php';">Appointments</button>
        <button class="tablinks" onclick="window.location.href='occupied_rooms.php';">Rooms</button>
        <form class="logout_button" method="POST">
            <button type="submit" name="logout" class="logout_button">Logout</button>
        </form>
        <p class="login_as">Logged in as: <?php echo '       ';
                                            print($_SESSION['user']); ?></p>
    </div>

    <h1 class="title">Appointments</h1>

    <?php
    include 'functions.php';
    $conn = db_connect($_SESSION['vali']);
    default_appointment_result($conn);
    logout_button();
    number_of_connections($conn);
    ?>
</body>

</html>