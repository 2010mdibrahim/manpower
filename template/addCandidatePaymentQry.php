<?php
include ('database.php');
$visaNo = $_POST['visaNo'];
$agentEmail = $_POST['agentEmail'];
$passportNum = $_POST['passportNum'];
$fullAmount = $_POST['fullAmount'];
$purpose = $_POST['purpose'];
$advance = $_POST['advance'];
$paydate = $_POST['paydate'];
$comment = $_POST['comment'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");
$create_date = date("Y-m-d H:i:s");

$result = $conn->query("INSERT INTO candidateexpense(amount, advance, payDate, purpose, passportNum, visaNo, agentEmail, creationDate, updatedBy, updatedOn, comment) VALUES ($fullAmount, $advance, '$paydate', '$purpose', '$passportNum', '$visaNo', '$agentEmail', '$create_date', '$admin', '$date', '$comment')");

