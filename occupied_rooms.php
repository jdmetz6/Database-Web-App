<?php include 'header.php'; ?>

<h1 id="tab_title" class="title">Rooms</h1>

<!-- Function call to change browser tab title. Definition is located in header.php file. -->
<script>
    title()
</script>

<?php
// Creating sql query.
$conn = db_connect($_SESSION['validation']);
$sql = 'select patient.pid, patient.fname, patient.lname, room.room_type, room.room_number 
        from patient 
        join assign_room ON patient.pid = assign_room.pid 
        join room ON assign_room.room_number = room.room_number;';
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// Creating column names for sql query results.
$field_names = [
    'Patient ID',
    'Patient First Name',
    'Patient Last Name',
    'Room Type',
    'Room Number'
];
print_results($field_names, $result, $conn);
?>
<?php include 'footer.php'; ?>