<?php
include ('database.php');
$delegateId = $_POST['delegateId'];
$candidateNumber = $_POST['candidateNumber'];
$amount = $_POST['amount'];
$paydate = $_POST['paydate'];
$payMode = $_POST['payMode'];
$comment = $_POST['comment'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");

$result = $conn->query("INSERT into delegateexpense (delegateId, candidateNumber, amount, payDate, comment, updatedBy, updatedOn) values ($delegateId, $candidateNumber, $amount, '$paydate', '$comment', '$admin', '$date')");

if($result){
    echo "<script> window.location.href='../index.php?page=dlel&dl=".base64_encode($delegateId)."'</script>";
}else{
    echo 'error';
}