<?php include 'header.php'; ?>
<h1 id="tab_title" class="title">Appointments</h1>
<script>
    title()
</script>
<?php
$conn = db_connect($_SESSION['validation']);
$sql = "select patient.pid, patient.lname, patient.fname, appointment.date, appointment.time, employee.job_title, employee.lname, employee.fname 
        from patient 
        join appointment on appointment.pid = patient.pid 
        join employee on employee.empid = appointment.empid;";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$field_names = [
    'Patient ID',
    'Patient Last Name',
    'Patient First Name',
    'Date',
    'Time',
    'Job Title',
    'Employee Last Name',
    'Employee First Name'
];
print_results($field_names, $result, $conn);
?>
<?php include 'footer.php'; ?>