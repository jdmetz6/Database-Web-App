<?php include 'header.php'; ?>
<h1 class="title">Patient Information</h1>
<?php
$conn = db_connect($_SESSION['vali']);
$sql = 'select * from patient;';
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$field_names = [
    'ID',
    'First Name',
    'Last Name',
    'Birthday',
    'Gender',
    'Address',
    'Phone',
    'Medications'
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
    $i = $row[0];
    echo "<tr class=row>";
    for ($x = 0; $x < $fieldNum; $x++) {
        echo "<td>" . $row[$x] . "</td>";
    }
    echo '<td><form class="med" method="post" action="medication.php">';
    echo '<button class="med_button" type="submit" value="' . $i . '" name="pid">Check</button>';
    echo '</form></td>';
    echo '</br>';
    echo '</tr>';
}
echo '</table>';
$result->free_result();
?>
<?php include 'footer.php'; ?>