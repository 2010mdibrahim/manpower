<?php
include ('database.php');
$employeeId = $_POST['employeeId'];
$old_password = md5($_POST['old_password']);
$new_password = md5($_POST['new_password']);
$new_password_confirm = md5($_POST['new_password_confirm']);
$old_pass_confirm = mysqli_fetch_assoc($conn->query("SELECT employeeId from employee where employeeId = $employeeId AND empPass = '$old_password'"));
if(!is_null($old_pass_confirm)){
    if($new_password == $new_password_confirm){
        $result = $conn->query("UPDATE employee set empPass = '$new_password'");
        echo 'allOk';
    }else{
        echo 'notEqual';
    }
}else{
    echo 'noMatch';
}