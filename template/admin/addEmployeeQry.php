<?php
include ('../database.php');
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if($alter == 'delete'){
    $employeeId = $_POST['employeeId'];
    $qry = "delete from employee where employeeId = $employeeId";
    $result = mysqli_query($conn, $qry);
    if($result){
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../../index.php?page=employeeList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else{
    $employeeName = $_POST['employeeName'];
    $departmentId = $_POST['departmentId'];
    $salaryId = $_POST['salaryId'];
    $companyId = $_POST['companyId'];
    $designationId = $_POST['designationId'];
    $dob = $_POST['dob'];
    $doj = $_POST['doj'];
    $dol = $_POST['dol'];
    $admin = $_SESSION['email'];
    $date = date("T-m-d");

    if($alter == 'update'){
        $employeeId = $_POST['employeeId'];
        $qry = "update employee set employeeName = '$employeeName', departmentId = $departmentId, designationId = $designationId
                  , DOJ = '$doj', DOB = '$dob', DOL = '$dol', salary = $salaryId, updatedBy = '$admin', updatedOn = '$date' where employeeId = $employeeId";
        $result = mysqli_query($conn, $qry);
        if($result){
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../../index.php?page=employeeList'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
        }
    }else{
        $qry = "INSERT INTO employee(employeeName, companyId, departmentId, designationId, DOJ, DOB, DOL, salary, status, updatedBy, updatedOn)
            VALUES ('$employeeName',$companyId, $departmentId, $designationId, '$doj', '$dob','$dol',$salaryId,1,'$admin','$date')";
        $result = mysqli_query($conn, $qry);
        if($result){
            echo "<script>window.alert('Added')</script>";
            echo "<script> window.location.href='../../index.php?page=employeeList'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
            echo "<script> window.location.href='../../index.php?page=addEmployee'</script>";
        }
    }
}


