<?php
include ('database.php');
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$delegateTotalExpenseId = $_POST['delegateTotalExpenseId'];
if($alter == 'delete'){    
    $result = $conn->query("DELETE from delegatetotalexpense where delegateTotalExpenseId = $delegateTotalExpenseId");
}else{
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $result = $conn->query("UPDATE delegatetotalexpense set amount = $amount, date = '$date' where delegateTotalExpenseId = $delegateTotalExpenseId");
}

if($result){
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense'</script>";
}else{
    print_r(mysqli_error($conn));
}