<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Delegate", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
$delegateId = $_POST['delegateId'];
$amount = $_POST['amount'];
$date = $_POST['date'];

$result = $conn->query("INSERT INTO delegatetotalexpense (delegateId, amount, date) VALUES ($delegateId,$amount,'$date')");
if($result){
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense'</script>";
}else{
    print_r(mysqli_error($conn));
}