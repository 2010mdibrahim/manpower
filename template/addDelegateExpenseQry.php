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
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if(isset($_POST['delegateExpenseId'])){
    $delegateExpenseId = $_POST['delegateExpenseId'];
}else{
    $delegateExpenseId = '';
}
$delegateId = $_POST['delegateId'];
if($alter == 'delete'){
    $result = $conn->query("DELETE from delegateExpense where delegateExpenseId = $delegateExpenseId");
}else{
    $candidateNumber = $_POST['candidateNumber'];
    $amount = $_POST['amount'];
    $paydate = $_POST['paydate'];
    $payMode = $_POST['payMode'];
    $comment = $_POST['comment'];
    $admin = $_SESSION['email'];
    $date = date("Y-m-d");

    $result = $conn->query("INSERT into delegateexpense (delegateId, candidateNumber, amount, payDate, comment, updatedBy, updatedOn) values ($delegateId, $candidateNumber, $amount, '$paydate', '$comment', '$admin', '$date')");
}

if($result){
    echo "<script> window.location.href='../index.php?page=dlel&dl=".base64_encode($delegateId)."'</script>";
}else{
    echo 'error';
}