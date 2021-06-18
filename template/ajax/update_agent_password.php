<?php
include("../database.php");
$agent_email = $_POST['agent_email'];
$password = $_POST['password'];
$result = $conn->query("UPDATE agent set password = '$password' where agentEmail = '$agent_email'");
if($result){
    echo 'true';
}else{
    echo 'false';
}
