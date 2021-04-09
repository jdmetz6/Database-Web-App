<?php include 'header.php'; ?>
<h1 class="title">Appointments</h1>
<?php
$conn = db_connect($_SESSION['vali']);
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

echo '<div class="tabl_box">';
    echo '<table class=tabl>';
    echo '<tr class=column>';
    // Print Column Names
    foreach ($field_names as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';

    // Print Data
    $fieldNum = mysqli_num_fields($result);
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr class=row>";
        for ($x = 0; $x < $fieldNum; $x++) {
            echo "<td>" . $row[$x] . "</td>";
        }
        echo "</br>";
        echo "</tr>";
    }
    echo '</table>';
echo '</div>';
$result->free_result();
?>
<?php include 'footer.php'; ?>