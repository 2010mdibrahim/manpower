<?php
include ('database.php');
$email = $_POST["email"];
$pass = md5($_POST["pass"]);
$sections_arr = array();
$today = date('Y-m-d');
if( $email!="" && $pass!=""){
    $admin = mysqli_fetch_assoc($conn -> query("SELECT count(employeeId) as existsEmp, employee.employeeId from employee where employeeOfficeId = '$email' and empPass = '$pass'"));
    if($admin['existsEmp'] != 0){
        $sections_result = $conn -> query("SELECT sections.sectionName from sections INNER JOIN employeeaccesssection using (sectionId) where employeeaccesssection.employeeId = ".$admin['employeeId']);
        $_SESSION['email'] = $email;
        while($sections = mysqli_fetch_assoc($sections_result)){
            array_push($sections_arr, $sections['sectionName']);
        }
        $_SESSION['sections'] = $sections_arr;
        $result_completed = $conn->query("UPDATE processing set pending = 2 where processing.pending = 1 AND processing.pendingTill < '$today'");
        echo "<script>window.location='../index.php'</script>";
    }else{
        echo "<script>window.alert('You are not an admin');</script>";
        // echo "<script>window.location='../index.php'</script>";
        print_r($admin);
    }
}else{
    echo "<script>window.location='../index.php'</script>";
}