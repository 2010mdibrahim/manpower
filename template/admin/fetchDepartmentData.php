<?php
include ('../database.php');
if(isset($_POST['get_option'])){
    $companyId = $_POST['get_option'];
    $qry = "select departmentId, departmentName from department where departmentId not in 
              (select department.departmentId from department 
                  inner join hasdepartment on hasdepartment.departmentId = department.departmentId where hasdepartment.companyId = $companyId)";
    $result = mysqli_query($conn,$qry);
    while($department = mysqli_fetch_assoc($result)){
        $departmentId = $department['departmentId'];
        echo "<option value=$departmentId>".$department['departmentName']."</option>";
    }
    exit;
}
