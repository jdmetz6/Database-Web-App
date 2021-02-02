<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Patients</title>
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

    <h1 class="title">Patient Information</h1>

    <?php
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
            $sql = 'select * from patient;';
            $result = mysqli_query($connec, $sql) or die(mysqli_error($connec));
            return $result;
        }
        
        function print_result($result){
            $field_names = ['ID',
            'First Name',
            'Last Name',
            'Birthday',
            'Gender',
            'Address',
            'Phone'];

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
