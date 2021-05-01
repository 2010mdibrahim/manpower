<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Candidate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$passportNum = $_POST['passportNum'];
$creationDate = $_POST['creationDate'];
$delegateExpenseAmount = $_POST['delegateExpenseAmount'];
$dollarRate = $_POST['dollarRate'];
print_r($dollarRate);
$result = $conn->query("UPDATE passport set delegateComission = $delegateExpenseAmount, dollarRate = $dollarRate where passportNum = '$passportNum' AND creationDate = '$creationDate'");
if($result){
    echo "<script> window.location.href='../index.php?page=visaList'</script>";
}else{
    print_r(mysqli_error($conn));
}