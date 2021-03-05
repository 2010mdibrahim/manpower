<?php
include ('database.php');
$visaNo = $_POST['visaNo'];
$agentEmail = $_POST['agentEmail'];
$passportNum = $_POST['passportNum'];
$fullAmount = $_POST['fullAmount'];
$purpose = $_POST['purpose'];

if(isset($_POST['advance'])){
    $advance = $_POST['advance'];
}else{
    $advance = 0;
}
if(isset($_POST['paydate'])){
    $paydate = $_POST['paydate'];
}else{
    $paydate = '';
}
$comment = $_POST['comment'];
$paymentMethod = $_POST['paymentMethod'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");
$create_date = date("Y-m-d H:i:s");

$result = $conn->query("INSERT INTO candidateexpense(amount, purpose, payMode, passportNum, sponsorVisa, agentEmail, creationDate, updatedBy, updatedOn, comment) VALUES ($fullAmount, '$purpose', '$paymentMethod', '$passportNum', '$visaNo', '$agentEmail', '$create_date', '$admin', '$date', '$comment')");
$expenseId = mysqli_fetch_assoc($conn->query("SELECT max(expenseId) as expenseId from candidateexpense"));
$result = $conn->query("INSERT INTO advance(advanceAmount, payDate, expenseId, updatedBy, updatedOn) VALUES ($advance, '$paydate', ".$expenseId['expenseId'].", '$admin', '$date')");
if($result){
    echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
}else{
    echo mysqli_error($conn);
}

