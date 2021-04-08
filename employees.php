<?php include 'header.php'; ?>
<h1 class="title">Employee Information</h1>
<div class="new_delete_box">
    <div class="new_emp_box">
        <form class="new_emp" method="POST">
            <button type="submit" class="new_emp_button" name="new_emp_button">ADD NEW</button>
        </form>
    </div>
    <div class="delete_emp_box">
        <form class="delete_emp" method="POST">
            <button type="submit" class="delete_emp_button" name="delete_emp_button">DELETE</button>
        </form>
    </div>
</div>
<?php

$conn = db_connect($_SESSION['vali']);
new_emp_form($conn);
delete_emp_form($conn);

$sql = 'select * 
        from employee;';
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$field_names = [
    'ID',
    'First Name',
    'Last Name',
    'Birthday',
    'Gender',
    'Address',
    'Phone',
    'Job Title',
    'Salary',
    'Hire Date',
    'Patients'
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
    echo '<td><form class="assign" method="post" action="doctor_patient_assignment.php">';
    echo '<button class="list_button" type="submit" value="' . $i . '" name="empid">List</button>';
    echo '</form></td>';
    echo "</br>";
    echo "</tr>";
}
echo '</table>';
$result->free_result();
?>
<?php include 'footer.php'; ?>