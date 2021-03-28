<?php
include ('database.php');
$delegateId = $_POST['delegateId'];
$amount = $_POST['amount'];
$date = $_POST['date'];

$result = $conn->query("INSERT INTO delegatetotalexpense (delegateId, amount, date) VALUES ($delegateId,$amount,'$date')");
if($result){
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense'</script>";
}else{
    print_r(mysqli_error($conn));
}