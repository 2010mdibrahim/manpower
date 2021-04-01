<?php
include ('database.php');
$officeId = $_POST['officeId'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$delegateTotalExpenseId = $_POST['delegateTotalExpenseId'];
$result = $conn->query("INSERT INTO delegatetotalexpenseoffice(delegateTotalExpenseId, officeId, amount, date) VALUES ($delegateTotalExpenseId,$officeId,$amount,'$date')");
if($result){
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense&dei=".base64_encode($delegateTotalExpenseId)."'</script>";
}else{
    print_r(mysqli_error($conn));
}