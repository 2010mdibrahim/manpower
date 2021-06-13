<?php
include ('database.php');
$email = $_POST["email"];
$pass = md5($_POST["pass"]);
$sections_arr = array();
$today = date('Y-m-d');
if( $email!="" && $pass!=""){
    $admin = mysqli_fetch_assoc($conn -> query("SELECT count(employeeId) as existsEmp, employee.employeeId from employee where employeeOfficeId = '$email' and empPass = '$pass'"));
    if($admin['existsEmp'] != 0){
        unset($_SESSION['failed_login']);
        $sections_result = $conn -> query("SELECT sections.sectionName from sections INNER JOIN employeeaccesssection using (sectionId) where employeeaccesssection.employeeId = ".$admin['employeeId']);
        $_SESSION['email'] = $email;
        $_SESSION['employee_id'] = $admin['employeeId'];
        while($sections = mysqli_fetch_assoc($sections_result)){
            array_push($sections_arr, $sections['sectionName']);
        }
        $_SESSION['sections'] = $sections_arr;
        // Auto send to pending list
        $result_completed = $conn->query("UPDATE processing set pending = 2 where processing.pending = 1 AND processing.pendingTill < '$today'");
        $notification_count = mysqli_fetch_assoc($conn->query("SELECT count(id) as noitfication_count from notifications where seen = 'no' AND employee_id = ".$admin['employeeId']));
        $_SESSION['notification_count'] = $notification_count['noitfication_count'];
        echo "<script>window.location='../index.php'</script>";
    }else{
        $_SESSION['failed_login'] = true;
        echo "<script>window.location='../index.php'</script>";
    }
}else{
    echo "<script>window.location='../index.php'</script>";
}