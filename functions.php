
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

function logout_button()
{
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: index.php");
        $_SESSION['vali'] = FALSE;
    }
}

function db_connect($validation)
{
    if ($validation == FALSE || empty($validation)) {
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
    if (isset($_POST['new_emp_button'])) {
        echo  '<form class="new_emp_form" method="POST">
                <div class="container1">
                    <div class="container2">
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
                    </div>
                    <div class="container2">    
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
                    </div>  
                </div>
                <div class="form_buttons">
                    <button class="submit_add_emp_button" type="submit" name="new_emp_submit">Submit</button>
                    <button class="cancel_emp_button" action="employee.php">Cancel</button>
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

function delete_emp_form($connec)
{
    if (isset($_POST['delete_emp_button'])) {

        echo  '<form class="remove_emp_form" method="POST">
                    <div class="container1">
                    <div class="container2">
                        <label for="id"><b>ID</b></label>
                        <input type="text" placeholder="Enter ID Number To Delete" name="delete_id" value="" require>
                    </div>
                    </div>
                    
                    <div class="form_buttons">
                        <button class="submit_delete_emp_button" type="submit" name="remove_emp_submit">Submit</button>
                        <button class="cancel_emp_button" action="employee.php">Cancel</button>
                    </div>
                </form>';
    }

    if (isset($_POST['remove_emp_submit'])) {
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
