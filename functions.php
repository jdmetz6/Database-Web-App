<?php

// Validate & Login 
function login($user, $pass, $servername, $username, $password, $validation)
{
    if ($username != $user || $password != $pass) {
        echo '<p class="wrong">Wrong Username/Password</p>';
    } else {
        $validation = TRUE;
        $_SESSION['serv'] = "$servername";
        $_SESSION['user'] = "$username";
        $_SESSION['pass'] = "$password";
        $_SESSION['vali'] = "$validation";
        header("Location: employees.php");
    }
    return 0;
}

function number_of_connections($conn)
{
    $sql = "show status where `variable_name` = 'Threads_connected';";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while ($row = mysqli_fetch_array($result)) {
        echo $row[0] . ": ";
        echo $row[1] . "<br>";
    }
    $result->free_result();
}

function logout_button()
{
    if (isset($_POST['logout'])) 
    {
        session_destroy();
        header("Location: index.php");
        $_SESSION['vali'] = FALSE;
    }
}

function db_connect($validation)
{
    if ($validation == FALSE || empty($validation)) 
    {
        header("Location: index.php");
        return 0;
    } else {
        $connection = new mysqli($_SESSION['serv'], $_SESSION['user'], $_SESSION['pass']);
    }
    // Check connection
    if ($connection->connect_error) {
        die("Failed: " . $connection->connect_error);
    } else {
        mysqli_query($connection, 'USE dbapp') or die(mysqli_error($connection));
    }
    return $connection;
}

function new_emp_form($connec)
{
    if (isset($_POST['new_emp_button'])) 
    {
        echo  '<form class="new_emp_form" method="POST">
                <div class="container">
                    <label for="id"><b>ID</b></label>
                    <input type="text" placeholder="Enter ID Number" name="id" value="" require>
                    <label for="fname"><b>Fist Name</b></label>
                    <input type="text" placeholder="Enter First Name" name="fname" value="" require>
                    <label for="lname"><b>Last Name</b></label>
                    <input type="text" placeholder="Enter Last Name" name="lname" value="" require>
                    <label for="bday"><b>Birthday</b></label>
                    <input type="text" placeholder="Enter Birthday" name="bday" value="" require>
                    <label for="sex"><b>Gender</b></label>
                    <input type="text" placeholder="Enter Gender" name="sex" value="" require>
                    <label for="address"><b>Address</b></label>
                    <input type="text" placeholder="Enter Address" name="address" value="" require>
                    <label for="phone"><b>Phone Number</b></label>
                    <input type="text" placeholder="Enter Phone Number" name="phone" value="" require>
                    <label for="title"><b>Job Title</b></label>
                    <input type="text" placeholder="Enter Job Title" name="title" value="" require>
                    <label for="salary"><b>Salary</b></label>
                    <input type="text" placeholder="Enter Salary" name="salary" value="" require>
                    <label for="hiredate"><b>Hire Date</b></label>
                    <input type="text" placeholder="Enter Hire Date" name="hiredate" value="" require>
                    <button class="add_emp_button" type="submit" name="new_emp_submit">Submit</button>
                </div>
            </form>';
    }

    if (isset($_POST['new_emp_submit'])) 
    {
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $bday = $_POST['bday'];
        $sex = $_POST['sex'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $title = $_POST['title'];
        $salary = $_POST['salary'];
        $hiredate = $_POST['hiredate'];

        $sql = $connec->prepare("INSERT INTO employee (empid, fname, lname, birthday, gender, address, phone, job_title, salary, hire_date) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");
        $sql->bind_param("ssssssssss", $id, $fname, $lname, $bday, $sex, $address, $phone, $title, $salary, $hiredate);
        $sql->execute();

        if (!mysqli_errno($connec) && !mysqli_error($connec)) {
            echo '<p class="success">Success!</p>';
        } else {
            echo mysqli_errno($connec) . ": " . mysqli_error($connec) . "\n";
        }
    }
}

function delete_emp_form($connec)
{
    if (isset($_POST['delete_emp_button'])) 
    {

        echo  '<form class="remove_emp_form" method="POST">
                    <div class="container">
                        <label for="id"><b>ID</b></label>
                        <input type="text" placeholder="Enter ID Number To Delete" name="delete_id" value="" require>
                        <button class="remove_emp_button" type="submit" name="remove_emp_submit">Submit</button>
                    </div>
                 </form>';
    }

    if (isset($_POST['remove_emp_submit'])) 
    {
        $id = $_POST['delete_id'];
        $sql = $connec->prepare("DELETE FROM employee WHERE empid=?;");
        $sql->bind_param("s",$id);
        $sql->execute();

        if (!mysqli_errno($connec) && !mysqli_error($connec)) {
            echo '<p class="success">Success!</p>';
        } else {
            echo mysqli_errno($connec) . ": " . mysqli_error($connec) . "\n";
        }
    }
}

function default_employee_result($connec)
{
    $sql = 'select * from employee;';
    $result = mysqli_query($connec, $sql) or die(mysqli_error($connec));
    $field_names = ['ID', 'First Name', 'Last Name', 'Birthday', 'Gender', 'Address', 'Phone', 'Job Title', 'Salary', 'Hire Date'];

    echo '<table class=tabl>';
    echo '<tr class=column>';
    // Print Column Names
    foreach ($field_names as $value) 
    {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';

    // Print Data
    $fieldNum = mysqli_num_fields($result);
    while ($row = mysqli_fetch_array($result)) 
    {
        echo "<tr class=row>";
        for ($x = 0; $x < $fieldNum; $x++) 
        {
            echo "<td>" . $row[$x] . "</td>";
        }
        echo "</br>";
        echo "</tr>";
    }
    echo '</table>';
    $result->free_result();
}

function default_patient_result($connec)
{
    $sql = 'select * from patient;';
    $result = mysqli_query($connec, $sql) or die(mysqli_error($connec));

    $field_names = [
        'ID',
        'First Name',
        'Last Name',
        'Birthday',
        'Gender',
        'Address',
        'Phone'
    ];

    echo '<table class=tabl>';
    echo '<tr class=column>';
    // Print Column Names
    foreach ($field_names as $value) 
    {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';

    // Print Data
    $fieldNum = mysqli_num_fields($result);
    while ($row = mysqli_fetch_array($result)) 
    {
        echo "<tr class=row>";
        for ($x = 0; $x < $fieldNum; $x++) 
        {
            echo "<td>" . $row[$x] . "</td>";
        }
        echo "</br>";
        echo "</tr>";
    }

    echo '</table>';
    $result->free_result();
}

function default_appointment_result($connec)
{
    $sql = "select patient.pid, patient.lname, patient.fname, appointment.date, appointment.time, employee.job_title, employee.lname, employee.fname 
    from patient 
    join appointment on appointment.pid = patient.pid 
    join employee on employee.empid = appointment.empid;";
    $result = mysqli_query($connec, $sql) or die(mysqli_error($connec));

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

    echo '<table class=tabl>';
    echo '<tr class=column>';
    // Print Column Names
    foreach ($field_names as $value) 
    {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';

    // Print Data
    $fieldNum = mysqli_num_fields($result);
    while ($row = mysqli_fetch_array($result)) 
    {
        echo "<tr class=row>";
        for ($x = 0; $x < $fieldNum; $x++) 
        {
            echo "<td>" . $row[$x] . "</td>";
        }
        echo "</br>";
        echo "</tr>";
    }
    echo '</table>';
    $result->free_result();
}

function default_rooms_result($connec)
{
    $sql = 'select patient.pid, patient.fname, patient.lname, room.room_type, room.room_number 
    from patient 
    join assign_room ON patient.pid = assign_room.pid 
    join room ON assign_room.room_number = room.room_number;';
    $result = mysqli_query($connec, $sql) or die(mysqli_error($connec));

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
    foreach ($field_names as $value) 
    {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';

    // Print Data
    $fieldNum = mysqli_num_fields($result);
    while ($row = mysqli_fetch_array($result)) 
    {
        echo "<tr class=row>";
        for ($x = 0; $x < $fieldNum; $x++) 
        {
            echo "<td>" . $row[$x] . "</td>";
        }
        echo "</br>";
        echo "</tr>";
    }
    echo '</table>';
    $result->free_result();
}
