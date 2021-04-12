<?php include 'header.php'; ?>

<h1 id="tab_title" class="title">Employee Info.</h1>

<!-- Function call to change browser tab title. Definition is located in header.php file. -->
<script>
    title()
</script>

<!-- Add and delete employee buttons -->
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
// Creating sql query.
$conn = db_connect($_SESSION['validation']);

new_emp_form($conn);
delete_emp_form($conn);

$sql = 'select * 
        from employee;';
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// Creating column names for sql query results.
$field_names = [
    'Employee ID',
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

print_results($field_names, $result, $conn);
?>
<?php include 'footer.php'; ?>