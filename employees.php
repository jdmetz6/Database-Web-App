<?php session_start();?>
<!DOCTYPE html>
<html>
;oaiujdfoiahfo;iahgf;iauhfi;uaqhgiuahfqeeruarhgiquhgipurhgiqeurhgiu
<head>
    <meta charset="utf-8">
    <title>Employee</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    
    <div class="menuBar">
        <button class="tablinks" onclick="window.location.href='employees.php';">Employees</button>
        <button class="tablinks" onclick="window.location.href='patients.php';">Patients</button>
        <button class="tablinks" onclick="window.location.href='appointments.php';">Appointments</button>
        <button class="tablinks" onclick="window.location.href='occupied_rooms.php';">Rooms</button>
        <form class="logout_button" method="POST">
            <button type="submit" name="logout" class="logout_button">Logout</button>
        </form>
        <p class="login_as">Logged in as: <?php echo '       '; print($_SESSION['user']);?></p>
    </div>
    
    <h1 class="title">Employee Information</h1>
    <div class="new_delete_box">
        <div class="new_emp_box">
            <form class="new_emp" method="POST">
                <button type="submit" class="new_emp_button" name="new_emp_button">ADD NEW</button> 
            </form>
        </div>
        <div class="delete_emp_box">
            <form class="delete_emp" method="POST">
                <button type="submit" class="delete_emp_button" name="delete_emp_button">Delete</button> 
            </form>
        </div>
    </div>
    
    <?php
        function new_emp_form($connec){
            $id=$_POST['id'];
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $bday=$_POST['bday'];
            $sex=$_POST['sex'];
            $address=$_POST['address'];
            $phone=$_POST['phone'];
            $title=$_POST['title'];
            $salary=$_POST['salary'];
            $hiredate=$_POST['hiredate'];

            if(isset($_POST['new_emp_button'])){
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
            if(isset($_POST['new_emp_submit'])){
                $sql ="INSERT INTO employee VALUES ( '$id', '$fname', '$lname', '$bday', '$sex', '$address', '$phone', '$title', '$salary', '$hiredate' );";
                mysqli_query($connec, $sql) or die(mysqli_error($connec));
                
                if (!mysqli_errno($connec) && !mysqli_error($connec)){
                    echo '<p class="success">Success!</p>';
                } else {
                    echo mysqli_errno($connec) . ": " . mysqli_error($connec). "\n";
                }
            } 
        }

        function delete_emp_form($connec){
            $id=$_POST['delete_id'];

            if(isset($_POST['delete_emp_button'])){
                echo  '<form class="remove_emp_form" method="POST">
                            <div class="container">
                                <label for="id"><b>ID</b></label>
                                <input type="text" placeholder="Enter ID Number To Delete" name="delete_id" value="" require>
                                <button class="remove_emp_button" type="submit" name="remove_emp_submit">Submit</button>
                            </div>
                         </form>';
                    
            }
            if(isset($_POST['remove_emp_submit'])){
                
                $sql = "DELETE FROM employee WHERE empid=$id;";
                mysqli_query($connec, $sql) or die(mysqli_error($connec));  
                
                if (!mysqli_errno($connec) && !mysqli_error($connec)){
                    echo '<p class="success">Success!</p>';
                } else {
                    echo mysqli_errno($connec) . ": " . mysqli_error($connec). "\n";
                }
            } 
        }

        function check_validation($validation)
        {
            if ($validation == FALSE || empty($validation))
            {
                header("Location: index.php");
            }
        }

        function logout_button(){
            if (isset($_POST['logout'])){
                session_destroy();
                header("Location: index.php");
                $_SESSION['vali'] = FALSE;
            }
        }

        function db_connect(){
            $connection = new mysqli($_SESSION['serv'], $_SESSION['user'], $_SESSION['pass']);
            // Check connection
            if ($connection->connect_error) 
            {
                die("Failed: " . $connection->connect_error);
            }
            return $connection;
        }
        
        function select_db($connec){
            $sql = 'USE dbapp;';
            $result = mysqli_query($connec, $sql) or die(mysqli_error($connec));
        }

        function query($connec){
            $sql = 'select * from employee;';
            $result = mysqli_query($connec, $sql) or die(mysqli_error($connec));
            return $result;
        }
        
        function print_result($result){
            $field_names = ['ID','First Name','Last Name','Birthday','Gender','Address','Phone','Job Title','Salary','Hire Date'];

            echo '<table class=tabl>';
                echo '<tr class=column>';
                    // Print Column Names
                    foreach ($field_names as $value){
                        echo '<td>'.$value.'</td>';
                    }
                echo '</tr>';
               
                // Print Data
                $fieldNum = mysqli_num_fields($result);
                while( $row = mysqli_fetch_array($result))
                {
                    echo "<tr class=row>";
                    for ($x = 0; $x < $fieldNum; $x++)
                    {
                        echo "<td>".$row[$x]."</td>";
                    }
                    echo "</br>";
                    echo "</tr>";
                } 
           echo '</table>';
           $result -> free_result();
        }

        check_validation($_SESSION['vali']);
        $conn = db_connect();
        select_db($conn);  
        new_emp_form($conn);
        delete_emp_form($conn);
        $result = query($conn);    
        print_result($result);
        logout_button();


        // other testing////    
        $sql = "show status where `variable_name` = 'Threads_connected';";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while($row = mysqli_fetch_array($result)) 
        {
            echo $row[0].": ";
            echo $row[1]."<br>";    
        }
        $result -> free_result();
        
       
        ////////   
        ?>
</body>

</html>
