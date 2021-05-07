<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Delegate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$delegateId = $_POST['delegateId'];
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
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense&dei=".base64_encode($_POST['delegateId'])."'</script>";
}else{
    print_r(mysqli_error($conn));
}