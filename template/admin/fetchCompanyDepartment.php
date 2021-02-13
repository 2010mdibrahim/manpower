<?php
include ('../database.php');
if(isset($_POST['get_option'])) {
    $companyId = $_POST['get_option'];
    $qry = "select department.departmentId, department.departmentName from department 
                inner join hasdepartment on hasdepartment.departmentId = department.departmentId WHERE hasdepartment.companyId = $companyId";
    $result = mysqli_query($conn, $qry);
    while ($department = mysqli_fetch_assoc($result)) {
        $val = $department['departmentId'];
        echo "<option value='$val'>".$department['departmentName']."</option>";
    }
    exit;
}