<?php
// Function for logout button in the top menu bar 
function logout_button()
{
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: index.php");
        $_SESSION['validation'] = FALSE;
    }
}

// Connect to the database. Change credentials to fit your environment.
function db_connect($validation)
{
    $db_host_name = "localhost";
    $db_username = "username";
    $db_user_password = "password";
    $db_name = "dbname";

    if ($validation == FALSE || empty($validation)) {
        header("Location: index.php");
        return 0;
    } else {
        $conn = new mysqli($db_host_name, $db_username, $db_user_password, $db_name);
    }
    // Check database connection.
    if ($conn->connect_error) {
        die("Failed: " . $conn->connect_error);
    }
    return $conn;
}

// Pop up form for adding an employee in the employee page
function new_emp_form($connec)
{
    if (isset($_POST['new_emp_button'])) {
        echo  '<form class="new_emp_form" method="POST">
                <h2 class="add_employee_form_title">Add New Employee</h2>
                <div class="container1">
                    <div class="container_left">
                        <input class="new_employee_input" type="text" placeholder="ID Number" name="id" value="" require>
                        <input class="new_employee_input" type="text" placeholder="First Name" name="fname" value="" require>
                        <input class="new_employee_input" type="text" placeholder="Last Name" name="lname" value="" require>
                        <input class="new_employee_input" type="text" placeholder="Birthday" name="bday" value="" require>
                        <input class="new_employee_input" type="text" placeholder="Gender" name="sex" value="" require>
                    </div>
                    <div class="container_right">    
                        <input class="new_employee_input" type="text" placeholder="Address" name="address" value="" require>
                        <input class="new_employee_input" type="text" placeholder="Phone Number" name="phone" value="" require>
                        <input class="new_employee_input" type="text" placeholder="Job Title" name="title" value="" require>
                        <input class="new_employee_input" type="text" placeholder="Salary" name="salary" value="" require>
                        <input class="new_employee_input" type="text" placeholder="Hire Date" name="hiredate" value="" require>
                    </div>  
                </div>
                <div class="form_buttons">
                    <button class="submit_add_emp_button" type="submit" action="employees.php" name="new_emp_submit">Submit</button>
                    <button class="cancel_emp_button" action="employees.php">Cancel</button>
                </div>
            </form>';
    }

    if (isset($_POST['new_emp_submit'])) {
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

        // Creating sql query to insert new employee information.
        $sql = $connec->prepare("INSERT INTO employee (empid, fname, lname, birthday, gender, address, phone, job_title, salary, hire_date) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");
        $sql->bind_param("isssssssss", $id, $fname, $lname, $bday, $sex, $address, $phone, $title, $salary, $hiredate);
        $sql->execute();

        if (!mysqli_errno($connec) && !mysqli_error($connec)) {
            echo '<p class="success">Success!</p>';
        } else {
            echo mysqli_errno($connec) . ": " . mysqli_error($connec) . "\n";
        }
    }
}

// Pop up form for deleting an employee in the employee page.
function delete_emp_form($connec)
{
    if (isset($_POST['delete_emp_button'])) {
        echo  '<form class="remove_emp_form" method="POST">
                    <h2 class="delete_employee_form_title">Delete Employee</h2>
                    <div class="container1">
                        <input class="delete_employee_input" type="text" placeholder="Enter ID Number" name="delete_id" value="" require>
                    </div>
                    <div class="form_buttons">
                        <button class="submit_delete_emp_button" type="submit" action="employees.php" name="remove_emp_submit">Submit</button>
                        <button class="cancel_emp_button" action="employees.php">Cancel</button>
                    </div>
                </form>';
    }

    if (isset($_POST['remove_emp_submit'])) {
        // Creating sql query to delete employee.
        $id = $_POST['delete_id'];
        $sql = $connec->prepare("DELETE FROM employee WHERE empid=?;");
        $sql->bind_param("i", $id);
        $sql->execute();

        if (!mysqli_errno($connec) && !mysqli_error($connec)) {
            echo '<p class="success">Success!</p>';
        } else {
            echo mysqli_errno($connec) . ": " . mysqli_error($connec) . "\n";
        }
    }
}

// Print sql query results in a table.
function print_results($field_names, $result, $conn)
{
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
    $index = 0;

    if ("prescriptions.php" == basename($_SERVER['PHP_SELF'])) {
        $index = 1;
    }

    while ($row = mysqli_fetch_array($result)) {
        $id = $row[0];
        echo "<tr class=row>";

        for ($x = $index; $x < $fieldNum; $x++) {
            echo "<td>" . $row[$x] . "</td>";
        }

        // if statements below to print buttons when sql query is made on pages specified in "action =" area of form tags. 
        if ("employees.php" == basename($_SERVER['PHP_SELF'])) {
            echo '<td><form class="assign" method="post" action="doctor_patient_assignment.php">';
            echo '<button class="list_button" type="submit" value="' . $id . '" name="empid">List</button>';
            echo '</form></td>';
        }

        if ("patients.php" == basename($_SERVER['PHP_SELF'])) {
            echo '<td><form class="assign" method="post" action="prescriptions.php">';
            echo '<button class="list_button" type="submit" value="' . $id . '" name="pid">List</button>';
            echo '</form></td>';
        }

        echo "</br>";
        echo "</tr>";
    }

    echo '</table>';
    echo '</div>';

    $result->free_result();
    $conn->close();
}
