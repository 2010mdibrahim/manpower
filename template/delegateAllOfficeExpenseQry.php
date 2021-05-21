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
if(isset($_POST['officeId'])){
    $officeId = $_POST['officeId']; 
}else{
    $officeId = 'self'; 
}
$creationDate = date('Y-m-d H:i:s');
$result = $conn->query("INSERT INTO account_maheer(particular, date, debit, credit, dollar_rate_debit) VALUES ('$officeId','$date', $amount, 0, $rate)");
if($result){
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense'</script>";
}else{
    print_r(mysqli_error($conn));
}