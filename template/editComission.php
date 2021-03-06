<?php
include ('database.php');
$passportNum = $_POST['passportNum'];
$comissionId = $_POST['comissionId'];
$amount = $_POST['amount'];
$result = $conn->query("UPDATE agentcomission set amount = $amount where comissionId = $comissionId");
if($result){
    echo "<script> window.location.href='../index.php?page=ce&pn=".base64_encode($passportNum)."'</script>";
}else{
    echo mysqli_error($conn);
}