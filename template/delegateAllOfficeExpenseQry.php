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
$date = $_POST['date'];
if(isset($_POST['rate'])){
    $rate = $_POST['rate'];
}else{
    $rate = 1; // for taka
}
if(isset($_POST['amount'])){
    $amount = $_POST['amount']; // in dollar
}else{
    $amount = $_POST['amountBDT']; // in taka
}
if(isset($_POST['type'])){
    $type = $_POST['type']; 
}else{
    $type = 'NULL'; 
}
if(isset($_POST['officeId'])){
    $officeId = $_POST['officeId']; 
}else{
    $officeId = 'NULL'; 
}
$currancy = $_POST['currancy'];
$creationDate = date('Y-m-d H:i:s');
$result = $conn->query("INSERT INTO delegatetotalexpense (delegateId, amount, date, rate, type, officeId, currancy, creationDate) VALUES ($delegateId,$amount,'$date', $rate, '$type', '$officeId', '$currancy', '$creationDate')");
if($result){
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense'</script>";
}else{
    print_r(mysqli_error($conn));
}