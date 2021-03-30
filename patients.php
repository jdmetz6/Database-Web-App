<?php include 'header.php'; ?>
<h1 class="title">Patient Information</h1>
<?php
include 'functions.php';
$conn = db_connect($_SESSION['vali']);
default_patient_result($conn);
logout_button();
?>

</body>

</html>