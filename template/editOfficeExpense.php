<?php
include ('database.php');
$delegateTotalExpenseOfficeId = $_POST['delegateTotalExpenseOfficeId'];
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if($alter == 'delete'){
    $result = $conn->query("DELETE from delegateTotalExpenseOffice where delegateTotalExpenseOfficeId = $delegateTotalExpenseOfficeId");
}else{
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $result = $conn->query("UPDATE delegateTotalExpenseOffice set amount = $amount, date = '$date' where delegateTotalExpenseOfficeId = $delegateTotalExpenseOfficeId");
}
if($result){
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense'</script>";
}else{
    print_r(mysqli_error($conn));
}