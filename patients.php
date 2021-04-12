<?php include 'header.php'; ?>

<h1 id="tab_title" class="title">Patient Info.</h1>

<!-- Function call to change browser tab title. Definition is located in header.php file. -->
<script>
    title()
</script>

<?php
// Creating sql query.
$conn = db_connect($_SESSION['validation']);
$sql = 'select * 
        from patient;';
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// Creating column names for sql query results.
$field_names = [
    'Patient ID',
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