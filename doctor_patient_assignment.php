<?php include "header.php"; ?>

<h1 id="tab_title" class="title">Assigned Patients</h1>

<!-- Function call to change browser tab title. Definition is located in header.php file. -->
<script>
    title()
</script>

<?php
// Creating sql query.
$conn = db_connect($_SESSION['validation']);
$sql = "select patient.pid, patient.fname, patient.lname, appointment.date, appointment.time  
    from patient, appointment
    where  patient.pid=appointment.pid and appointment.empid = '" . $_POST['empid'] . "' ";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// Creating columns names for sql query results.
$field_names = [
    'Patient ID',
    'Fist Name',
    'Last name',
    'Date',
    'Time'
];

// Notify user if there are no results from the query.
if (mysqli_num_rows($result) > 0) {
    print_results($field_names, $result, $conn);
} else {
    echo "<h2 class='no_result'>No Patients</h2>";
}
?>
<?php include "footer.php"; ?>