<?php include 'header.php'; ?>
<h1 class="title">Appointments</h1>
<?php
include 'functions.php';
$conn = db_connect($_SESSION['vali']);
default_appointment_result($conn);
logout_button();
?>
</body>

</html>