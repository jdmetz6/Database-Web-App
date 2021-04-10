<?php include "header.php"; ?>
<h1 id="tab_title" class="title">Assigned Patients</h1>
<script>
    title()
</script>
<?php
$conn = db_connect($_SESSION['validation']);
$sql = "select patient.pid, patient.fname, patient.lname, appointment.date, appointment.time  
    from patient, appointment
    where  patient.pid=appointment.pid and appointment.empid = '" . $_POST['empid'] . "' ";


$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$field_names = [
    'Patient ID',
    'Fist Name',
    'Last name',
    'Date',
    'Time'
];
if (mysqli_num_rows($result) > 0) {
    print_results($field_names, $result, $conn);
} else {
    echo "<h2 class='no_result'>No Patients</h2>";
}
include "footer.php";
