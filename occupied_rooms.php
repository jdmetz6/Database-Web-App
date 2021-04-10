<?php include 'header.php'; ?>
<h1 id="tab_title" class="title">Rooms</h1>
<script>
    title()
</script>
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
print_results($field_names, $result, $conn);
?>
<?php include 'footer.php'; ?>