<?php include "header.php"; ?>
<h1 class="title">Assigned Patients</h1>
<?php
$conn = db_connect($_SESSION['vali']);
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
    echo '<table class="tabl">';
    echo '<tr class=column>';
    // Print Column Names
    foreach ($field_names as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';

    // Print Data
    $fieldNum = mysqli_num_fields($result);
    while ($row = mysqli_fetch_array($result)) {
        $i = $row[0];
        echo "<tr class=row>";
        for ($x = 0; $x < $fieldNum; $x++) {
            echo "<td>" . $row[$x] . "</td>";
        }
        echo "</br>";
        echo "</tr>";
    }
    echo '</table>';
    $result->free_result();
} else {
    echo "<h2 class='no_result'>No Patients</h2>";
}
include "footer.php";
