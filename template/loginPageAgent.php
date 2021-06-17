<?php
include ('database.php');
$email = $_POST["email"];
$pass = md5($_POST["pass"]);
$sections_arr = array();
if( $email!="" && $pass!=""){
    $admin = mysqli_fetch_assoc($conn -> query("SELECT count(id) as exist_agent from agent where agentEmail = '$email' and `password` = '$pass'"));
    if($admin['exist_agent'] != 0){
        unset($_SESSION['agent_failed_login']);
        $_SESSION['agent_email'] = $email;
        // Auto send to pending list
        $notification_count = mysqli_fetch_assoc($conn->query("SELECT count(id) as noitfication_count from notifications where seen = 'no' AND employee_id = ".$admin['employeeId']));
        $_SESSION['notification_count'] = $notification_count['noitfication_count'];
        echo "<script>window.location='../index.php'</script>";
    }else{
        $_SESSION['agent_failed_login'] = true;
        echo "<script>window.location='../index.php'</script>";
    }
}else{
    echo "<script>window.location='../index.php?page=login_agent'</script>";
}