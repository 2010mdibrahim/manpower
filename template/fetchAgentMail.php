<?php
include ('database.php');
if(isset($_POST['get_option'])){
    $agentEmail = $_POST['get_option'];
    $result = mysqli_fetch_assoc($conn -> query("select count(agentEmail) as countEmail from agent where agentEmail = '$agentEmail'"));
    if($result['countEmail'] > 0){
        echo 'exists';
    }else{
        echo 'notExists';
    }
}
