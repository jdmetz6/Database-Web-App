<?php include "header.php"; ?>
<h1 class="title">Prescribed Medication</h1>
<?php
$conn = db_connect($_SESSION['vali']);
$sql = "select patient.pid, patient.fname, patient.lname, medication.medname, medication.description, employee.job_title, employee.fname, employee.lname 
        from patient 
        join prescriptions on prescriptions.pid = patient.pid 
        join medication on medication.medname = prescriptions.medname
        join employee on employee.empid = prescriptions.empid
        where patient.pid = '" . $_POST['pid'] . "' ";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$field_names = [
    'Patient First Name',
    'Patient Last Name',
    'Medication',
    'Description',
    'Prescribed By:',
    '',
    ''
];
if (mysqli_num_rows($result) > 0) 
{
    echo "<table class=tabl>";
    echo "<tr class=column>";
    // Print Column Names
    foreach ($field_names as $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";

    // Print Data
    $fieldNum = mysqli_num_fields($result);
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr class=row>";
        for ($x = 1; $x < $fieldNum; $x++) {
            echo "<td>" . $row[$x] . "</td>";
        }
        echo "</br>";
        echo "</tr>";
    }
    echo "</table>";
    $result->free_result();
} else {
    echo "<h2 class='no_med'>No Medication Found</h2>";
}
include "footer.php";
