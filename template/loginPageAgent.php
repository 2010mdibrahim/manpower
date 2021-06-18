<?php
include ('database.php');
$email = $_POST["email"];
$pass = $_POST["pass"];
$sections_arr = array();
if( $email!="" && $pass!=""){
    $admin = mysqli_fetch_assoc($conn -> query("SELECT count(id) as exist_agent, agentName from agent where agentEmail = '$email' and `password` = '$pass'"));
    if($admin['exist_agent'] != 0){
        unset($_SESSION['agent_failed_login']);
        $_SESSION['agent_email'] = $email;
        $_SESSION['agentName'] = $admin['agentName'];
        // Auto send to pending list
        echo "<script>window.location='../index.php?page=agent_dashboard'</script>";
    }else{
        $_SESSION['agent_failed_login'] = true;
        // echo "<script>window.location='../index.php?page=agent_login'</script>";
    }
}else{
    // echo "<script>window.location='../index.php?page=agent_login'</script>";
}