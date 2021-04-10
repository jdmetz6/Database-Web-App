<?php include 'header.php'; ?>
<h1 id="tab_title" class="title">Patient Info.</h1>
<script>
    title()
</script>
<?php
$conn = db_connect($_SESSION['validation']);
$sql = 'select * 
        from patient;';
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$field_names = [
    'ID',
    'First Name',
    'Last Name',
    'Birthday',
    'Gender',
    'Address',
    'Phone',
    'Prescriptions'
];
print_results($field_names, $result, $conn);
?>
<?php include 'footer.php'; ?>