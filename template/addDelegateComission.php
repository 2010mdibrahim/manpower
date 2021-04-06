<?php
include ('database.php');
$passportNum = $_POST['passportNum'];
$creationDate = $_POST['creationDate'];
$delegateExpenseAmount = $_POST['delegateExpenseAmount'];
$result = $conn->query("UPDATE passport set delegateComission = $delegateExpenseAmount where passportNum = '$passportNum' AND creationDate = '$creationDate'");
if($result){
    echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
}else{
    print_r(mysqli_error($conn));
}