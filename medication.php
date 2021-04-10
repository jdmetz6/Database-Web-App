<?php include "header.php"; ?>
<h1 id="tab_title" class="title">Medication</h1>
<script>
    title()
</script>
<?php
$conn = db_connect($_SESSION['validation']);
$sql = "select * 
        from medication;";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$field_names = [
    'Name',
    'Price',
    'Count',
    'Description'
];
print_results($field_names, $result, $conn);
include "footer.php";
