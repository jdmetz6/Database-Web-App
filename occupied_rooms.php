<?php include 'header.php'; ?>
<h1 class="title">Rooms</h1>
<?php
$conn = db_connect($_SESSION['vali']);
$sql = 'select patient.pid, patient.fname, patient.lname, room.room_type, room.room_number 
    from patient 
    join assign_room ON patient.pid = assign_room.pid 
    join room ON assign_room.room_number = room.room_number;';
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$field_names = [
    'Patient ID',
    'Patient First Name',
    'Patient Last Name',
    'Room Type',
    'Room Number'
];

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
$result->free_result();
?>
<?php include 'footer.php'; ?>