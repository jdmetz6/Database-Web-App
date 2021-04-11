<?php include "header.php"; ?>

<h1 id="tab_title" class="title">Prescriptions</h1>

<!-- Function call to change browser tab title. Definition is located in header.php file. -->
<script>
    title()
</script>

<?php
// Creating sql query.
$conn = db_connect($_SESSION['validation']);
$sql = "select patient.pid, patient.fname, patient.lname, medication.medname, medication.description, employee.job_title, employee.fname, employee.lname 
        from patient 
        join prescriptions on prescriptions.pid = patient.pid 
        join medication on medication.medname = prescriptions.medname
        join employee on employee.empid = prescriptions.empid
        where patient.pid = '" . $_POST['pid'] . "' ";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// Creating columns names for sql query results.
$field_names = [
    'Patient First Name',
    'Patient Last Name',
    'Medication',
    'Description',
    'Prescribed By:',
    '',
    ''
];

// Notify user if there are no results from the query.
if (mysqli_num_rows($result) > 0) {
    print_results($field_names, $result, $conn);
} else {
    echo "<h2 class='no_result'>No Prescriptions Found</h2>";
}
?>
<?php include "footer.php"; ?>
