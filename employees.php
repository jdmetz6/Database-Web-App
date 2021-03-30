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
            <button type="submit" class="delete_emp_button" name="delete_emp_button">Delete</button>
        </form>
    </div>
</div>

<?php
include 'functions.php';
$conn = db_connect($_SESSION['vali']);
new_emp_form($conn);
delete_emp_form($conn);
logout_button();
default_employee_result($conn);
?>
</body>

</html>