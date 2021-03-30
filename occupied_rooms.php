<?php include 'header.php'; ?>
<h1 class="title">Rooms</h1>
<?php
include 'functions.php';
$conn = db_connect($_SESSION['vali']);
default_rooms_result($conn);
logout_button();
?>
</body>

</html>